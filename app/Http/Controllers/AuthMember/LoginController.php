<?php

namespace App\Http\Controllers\AuthMember;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Member;
use Validator;

class LoginController extends Controller
{
    public function __construct(){
        $this->middleware('guest:member')->except('logout');
    }

    public function showLoginForm(){
        return view('authMember.login');
    }

    public function login(Request $request)
    {
        $tel = $request->get('tel');
        $member = Member::where('tel',$tel)->get();

            $member = Member::where('tel',$tel)->get();
            $this->validate($request, [
              'tel' => 'required|exists:members',
            ],[
              'tel.required' => "กรุณากรอกหมายเลขโทรศัพท์",
              'tel.exists' => "หมายเลขโทรศัพท์ไม่ถูกต้อง",
            ]);
    
            $credential = [
              'tel' => $request->tel,
              'password' => $request->password,
            ];
  
            if(Auth::guard('member')->attempt($credential, $request->member)){
              return redirect()->intended(route('member.home'));
            } 
            $request->session()->flash('alert-danger', 'หมายเลขโทรศัพท์หรือรหัสผ่านไม่ถูกต้อง');
            return redirect()->back()->withInput($request->only('tel','remember'));
    }
    
    protected function validateLogin(Request $request){
        $this->validate($request, [
            $this->username() => 'required|string',
            'password' => 'required|string',
        ]);
    }

    public function logout(Request $request){
        Auth::guard('member')->logout();
        $request->session()->flush();
        $request->session()->regenerate();
        return redirect()->guest(route( 'member.login' ));
    }

    public function rules_AuthMember() {
        return [
          'username' => 'required',
          'password' => 'required|min:6',
        ];
    }

    public function messages_AuthMember() {
        return [
          'username.required' => "กรุณากรอกชื่อผู้ใช้",
          'password.required' => "กรุณากรอกรหัสผ่าน",
          'password.min' => "กรุณากรอกรหัสผ่านอย่างน้อย 6 ตัวอักษร",
        ];
    }
}
