<?php

namespace App\Http\Controllers\AuthPartner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\PartnerShop;
use Validator;

class LoginController extends Controller
{
    public function __construct(){
        $this->middleware('guest:partner')->except('logout');
    }

    public function showLoginForm(){
        return view('authPartner.login');
    }

    public function login(Request $request)
    {
      $validator = Validator::make($request->all(), $this->rules_AuthPartner(), $this->messages_AuthPartner());
        if($validator->passes()) {
          $credential = [
            'tel' => $request->tel,
            'password' => $request->tel,
          ];

          $tel = $request->tel;
          $status = PartnerShop::where('tel',$tel)->value('status');
          
          if($status == "เปิด") {
            if(Auth::guard('partner')->attempt($credential, $request->member)){
              return redirect()->intended(route('partner.home'));
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
            'tel' => 'required|string',
        ]);
    }

    public function logout(Request $request){
        Auth::guard('partner')->logout();
        $request->session()->flush();
        $request->session()->regenerate();
        return redirect()->guest(route( 'partner.login' ));
    }

    public function rules_AuthPartner() {
        return [
          'tel' => 'required',
        ];
    }

    public function messages_AuthPartner() {
        return [
          'tel.required' => "กรุณากรอกรหัสผ่าน",
        ];
    }
}
