<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Member;
use App\Model\RedeemReward;
use App\Model\GetCoupon;
use App\Model\Point;
use App\Model\RedeemPoint;
use App\Model\InvitationBalance;
use App\Model\SpecialmemberBalance;
use App\PartnerShop;
use Auth;
use Validator;
class MembersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:member');
    }
    
    public function profile(Request $request) {
        $member = Member::where('id',Auth::guard('member')->id())->orderBy('id','desc')->first();
        $partners = PartnerShop::groupBy('name')->orderBy('id','desc')->get(); 
        $member_id = Auth::guard('member')->user()->id;

         // หักคะแนนจากการแลกของรางวัล
         $redeem_rewards = RedeemReward::where('member_id',$member_id)
                                       ->join('reward_points', 'redeem_rewards.point_id', '=', 'reward_points.id')
                                       ->select('reward_points.*', 'redeem_rewards.*')->get();

        // คะแนนสะสม
        $points = Point::where('member_id',$member_id)->get();

        // หักคะแนนแลกสิทธิ์ร้านค้าพันธมิตร
        $redeem_points = RedeemPoint::where('member_id',$member_id)
                                    ->join('partner_shop_points', 'redeem_points.point_id', '=', 'partner_shop_points.id')
                                    ->where('redeem_points.updated_at','>','2022-02-01 00:00:00')
                                    ->select('partner_shop_points.*','redeem_points.*')->orderBy('partner_shop_points.id','desc')->get();

        // ประวัติการใช้บริการ
        $NUM_PAGE = 20;
        $balances = InvitationBalance::where('member_id',$member_id)->paginate($NUM_PAGE);
        $specialmember_balances = SpecialmemberBalance::where('member_id',$member_id)->paginate($NUM_PAGE);
        $page = $request->input('page');
        $page = ($page != null)?$page:1;

        return view('frontend/member/account/profile')->with('member',$member)
                                                      ->with('partners',$partners)
                                                      ->with('redeem_rewards',$redeem_rewards)
                                                      ->with('points',$points)
                                                      ->with('redeem_points',$redeem_points)
                                                      ->with('balances',$balances)
                                                      ->with('specialmember_balances',$specialmember_balances)
                                                      ->with('NUM_PAGE',$NUM_PAGE)
                                                      ->with('page',$page);
    }

    public function telChange(){
        $member = Auth::guard('member')->user();
        return view('frontend/member/account/tel-change')->with('member',$member);
    }

    public function telUpdate(Request $request) {
        $validator = Validator::make($request->all(), $this->rules_tel_change(), $this->messages_tel_change());
        if($validator->passes()) {
            $id = $request->get('id');
            $member = Member::findOrFail($id);
            $member->update($request->all());
        }else{
            $request->session()->flash('alert-danger', 'เบอร์โทรศัพท์ไม่ถูกต้องหรือมีการลงทะเบียนแล้ว');
            return redirect('member/tel-change')->withErrors($validator)->withInput();   
        }
    	return redirect()->action('Frontend\\MembersController@profile');
        
    }

    public function profileChange(){
        $member = Auth::guard('member')->user();
        return view('frontend/member/account/profile-change')->with('member',$member);
    }

    public function profileUpdate(Request $request) {
        $id = $request->get('id');
        
    	$member = Member::findOrFail($id);
        $member->update($request->all());

    	return redirect()->action('Frontend\\MembersController@profile');
    }

    public function coupon() {
        $member_id = Auth::guard('member')->user()->id;
        $coupons = GetCoupon::where('member_id',$member_id)->where('status','ยังไม่ใช้งาน')->get();
        return view('frontend/member/coupon/coupon')->with('coupons',$coupons);
    }

    public function invitationFileDetail($id) {
        $balance = InvitationBalance::findOrFail($id);
        return view('frontend/member/account/file-detail')->with('balance',$balance);
    }

    public function specialmemberFileDetail($id) {
        $balance = SpecialmemberBalance::findOrFail($id);
        return view('frontend/member/account/file-detail')->with('balance',$balance);
    }

    public function rules_tel_change() {
        return [
            'tel' => 'required|unique:members',
        ];
    }

    public function messages_tel_change() {
        return [
            'tel.required' => 'กรุณากรอกเบอร์โทรศัพท์',
            'tel.unique' => 'เบอร์โทรศัพท์ใช้ในการลงทะเบียนแล้ว',
        ];
    }  
}
