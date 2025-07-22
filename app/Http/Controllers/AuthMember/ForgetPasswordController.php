<?php

namespace App\Http\Controllers\AuthMember;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;
use Hash;

use App\Member;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;

class ForgetPasswordController extends Controller
{
    public function index(){
        return view('authMember/passwords/forget');
    }

    public function forgetPassword(Request $request){
        $card_id = $request->get('card_id');
        $tel = $request->get('tel');

        $count_member = Member::where('card_id',$card_id)
                              ->where('tel',$tel)
                              ->count();
        if($count_member == 1) {
            return View::make('authMember/passwords/forget-confirm')->with('card_id', $card_id)
                                                                ->with('tel',$tel);
        } else {
            $request->session()->flash('alert-danger', 'หมายเลขบัตรประชาชน หรือเบอร์โทรศัพท์ไม่ถูกต้อง');
            return redirect()->action('AuthMember\ForgetPasswordController@index');
        }
        
    }

    public function updatePassword(Request $request) {
        $this->validate($request, [
            'password' => 'required|confirmed',
        ]);
        $card_id = $request->get('card_id');
        $tel = $request->get('tel');
        
        $id = Member::where('card_id',$card_id)
                    ->where('tel',$tel)
                    ->value('id');
                    
        if($id != null) {
            $member = Member::findOrFail($id);
            $member->password = Hash::make($request->get('password'));
            $member->save();
            Auth::guard('member')->logout();

            $request->session()->flash('alert-success', 'ตั้งรหัสผ่านใหม่สำเร็จ กรุณาเข้าสู่ระบบ');
            return redirect()->action('AuthMember\LoginController@ShowLoginForm');
        }
        $request->session()->flash('alert-danger', 'ตั้งรหัสผ่านใหม่ไม่สำเร็จ');
        return redirect()->action('AuthMember\ForgetPasswordController@index');
    }
    
}
