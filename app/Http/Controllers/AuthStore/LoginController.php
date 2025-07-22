<?php

namespace App\Http\Controllers\AuthStore;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\AccountStore;
use Validator;

class LoginController extends Controller
{
    public function __construct(){
        $this->middleware('guest:admin-store')->except('logout');
    }

    public function showLoginForm(){
        return view('authStore.login');
    }

    public function login(Request $request)
    {
      $validator = Validator::make($request->all(), $this->rules_AuthStore(), $this->messages_AuthStore());
        if($validator->passes()) {
          $credential = [
            'username' => $request->username,
            'password' =>$request->password
          ];

          $admin_store_name = $request->username;
          $admin_store_status = AccountStore::where('username',$admin_store_name)->value('status');

          if($admin_store_status == "เปิด") {
            if(Auth::guard('admin-store')->attempt($credential, $request->member)){
              return redirect()->intended(route('admin-store.home'));
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
        Auth::guard('admin-store')->logout();
        $request->session()->flush();
        $request->session()->regenerate();
        return redirect()->guest(route( 'admin-store.login' ));
    }

    public function rules_AuthStore() {
        return [
          'username' => 'required',
          'password' => 'required|min:6',
        ];
    }

    public function messages_AuthStore() {
        return [
          'username.required' => "กรุณากรอกชื่อผู้ใช้",
          'password.required' => "กรุณากรอกรหัสผ่าน",
          'password.min' => "กรุณากรอกรหัสผ่านอย่างน้อย 6 ตัวอักษร",
        ];
    }
}
