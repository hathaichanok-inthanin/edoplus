<?php

namespace App\Http\Controllers\AuthStaff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\AccountStaff;
use Validator;

class LoginController extends Controller
{
    public function __construct(){
        $this->middleware('guest:staff')->except('logout');
    }

    public function showLoginForm(){
        return view('authStaff.login');
    }

    public function login(Request $request)
    {
      $validator = Validator::make($request->all(), $this->rules_AuthStaff(), $this->messages_AuthStaff());
        if($validator->passes()) {
          $credential = [
            'username' => $request->username,
            'password' =>$request->password
          ];

          $staff_name = $request->username;
          $staff_status = AccountStaff::where('username',$staff_name)->value('status');

          if($staff_status == "เปิด") {
            if(Auth::guard('staff')->attempt($credential, $request->member)){
              return redirect()->intended(route('staff.home'));
            }else{
              $request->session()->flash('alert-danger', 'เข้าสู่ระบบไม่สำเร็จ กรุณาตรวจสอบข้อมูลอีกครั้ง !!');
              return back()->withErrors($validator)->withInput();
            }
          } else {
            $request->session()->flash('alert-danger', 'เข้าสู่ระบบไม่สำเร็จ ผู้ใช้ถูกปิดการใช้งาน !!');
            return back()->withErrors($validator)->withInput();
          }
        } else{
            $request->session()->flash('alert-danger', 'เข้าสู่ระบบไม่สำเร็จ กรุณาตรวจสอบข้อมูลอีกครั้ง !!');
            return back()->withErrors($validator)->withInput();
        }
    }
    
    protected function validateLogin(Request $request){
        $this->validate($request, [
            $this->username() => 'required|string',
            'password' => 'required|string',
        ]);
    }

    public function logout(Request $request){
        Auth::guard('staff')->logout();
        $request->session()->flush();
        $request->session()->regenerate();
        return redirect()->guest(route( 'staff.login' ));
    }

    public function rules_AuthStaff() {
        return [
          'username' => 'required',
          'password' => 'required|min:6',
        ];
    }

    public function messages_AuthStaff() {
        return [
          'username.required' => "กรุณากรอกชื่อผู้ใช้",
          'password.required' => "กรุณากรอกรหัสผ่าน",
          'password.min' => "กรุณากรอกรหัสผ่านอย่างน้อย 6 ตัวอักษร",
        ];
    }
}
