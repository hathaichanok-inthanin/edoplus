<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Member;
use App\Model\Campaign;
use App\Model\RedeemPoint;

use Auth;
use Carbon\Carbon;

class PartnerController extends Controller
{
    public function __construct(){
        $this->middleware('auth:partner');
    }

    public function searchMember(Request $request) {
        $search = $request->get('search');
        $members = Member::where('tel',$search)->get();
        $count = count($members);
            if($count == 0) {
                $search = '0';
            }
        return view('backend/partner/dashboard')->with('members',$members)
                                                ->with('search',$search);
    }

    public function coupon() {
        $search = 'No Search';
        return view('backend/partner/coupon/coupon')->with('search',$search);
    }

    public function searchCoupon(Request $request) {
        $search = $request->get('code');
        $coupons = Campaign::where('code',$request->get('code'))->get();
        $count = count($coupons);
            if($count == 0) {
                $search = '0';
            }
        return view('backend/partner/coupon/coupon')->with('coupons',$coupons)
                                                    ->with('search',$search);
    }

    public function reportPartner(Request $request) {
        $NUM_PAGE = 20;
        $partner_id = Auth::guard('partner')->user()->id;
        $redeem_points = RedeemPoint::where('partner_id',$partner_id)->orderBy('id','desc')->paginate($NUM_PAGE);
        $page = $request->input('page');
        $page = ($page != null)?$page:1;
        return view('backend/partner/report')->with('NUM_PAGE',$NUM_PAGE)
                                             ->with('page',$page)
                                             ->with('redeem_points',$redeem_points);
    }

    public function updateStatusAlliance($id) {
        $redeem_point = RedeemPoint::findOrFail($id);
        return view('backend/partner/update-status-alliance')->with('redeem_point',$redeem_point);
    }

    public function updateStatusAlliancePost(Request $request) {
        $id = $request->get('id');
        
        $redeem_point = RedeemPoint::findOrFail($id);
        $redeem_point->status = "ใช้งานแล้ว";
        $redeem_point->date_update = Carbon::now()->format('d/m/Y');
        $redeem_point->update();

        if($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = md5(($image->getClientOriginalName(). time()) . time()) . "_o." . $image->getClientOriginalExtension();
            $image->move('images/partnerRedeemPoint/', $filename);
            $path = 'images/'.$filename;
            $redeem_point = RedeemPoint::findOrFail($id);
            $redeem_point->image = $filename; 
            $redeem_point->save();
        }

        return redirect()->action('Backend\PartnerController@reportPartner');
    }
}
