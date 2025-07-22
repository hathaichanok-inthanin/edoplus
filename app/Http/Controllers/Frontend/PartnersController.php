<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Model\PartnerShopPromotion;
use App\Model\RedeemPoint;
use App\Model\PartnerShopPoint;
use App\Model\RedeemReward;
use App\Model\Point;
use App\PartnerShop;

use Auth;
use Carbon\Carbon;

class PartnersController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:member');
    }

    public function allianceRedeem($id) {  
        $partner_promotion = PartnerShopPromotion::findOrFail($id);
        $point_id = PartnerShopPoint::where('partner_id',$partner_promotion->id)->value('id');
        $member_id = Auth::guard('member')->user()->id;

        // หักคะแนนจากการแลกของรางวัล
        $redeem_rewards = RedeemReward::where('member_id',$member_id)
                                      ->join('reward_points', 'redeem_rewards.point_id', '=', 'reward_points.id')
                                      ->select('reward_points.*', 'redeem_rewards.*')->get();

        // คะแนนสะสม
        $points = Point::where('member_id',$member_id)->get();

        $dateNow = Carbon::now()->format('d/m/Y');

        // หักคะแนนแลกสิทธิ์ร้านค้าพันธมิตร
        $redeem_points = RedeemPoint::where('member_id',$member_id)
                                     ->join('partner_shop_points', 'redeem_points.point_id', '=', 'partner_shop_points.id')
                                     ->select('partner_shop_points.*','redeem_points.*')->orderBy('partner_shop_points.id','desc')->get();

        return view('frontend/member/alliance/alliance-redeem')->with('points',$points)
                                                               ->with('dateNow',$dateNow)
                                                               ->with('partner_promotion',$partner_promotion)
                                                               ->with('redeem_rewards',$redeem_rewards)
                                                               ->with('redeem_points',$redeem_points)
                                                               ->with('point_id',$point_id);
    }

    public function allianceSuccess(Request $request) { 
        $partner_promotion_id = $request->get('id'); 
        $partner_promotion = PartnerShopPromotion::findOrFail($partner_promotion_id);
        $partner_id = PartnerShopPromotion::where('id',$partner_promotion_id)->value('partner_id');
        $point_id = PartnerShopPoint::where('partner_id',$partner_promotion_id)->value('id');
        $member_id = Auth::guard('member')->user()->id;
        $date = Carbon::now()->format('d/m/Y');
        $code = str_random(8);

        $redeem_point = new RedeemPoint;
        $redeem_point->member_id = $member_id;
        $redeem_point->partner_id = $partner_id;
        $redeem_point->point_id = $point_id;
        $redeem_point->promotion_id = $partner_promotion_id;
        $redeem_point->date = $date;
        $redeem_point->code = $code;
        $redeem_point->status = "ยังไม่ใช้งาน";
        $redeem_point->save(); 

        // หักคะแนนจากการแลกของรางวัล
        $redeem_rewards = RedeemReward::where('member_id',$member_id)
                                      ->join('reward_points', 'redeem_rewards.point_id', '=', 'reward_points.id')
                                      ->select('reward_points.*', 'redeem_rewards.*')->get();

        // คะแนนสะสม
        $points = Point::where('member_id',$member_id)->get();

        $dateNow = Carbon::now()->format('d/m/Y');

        // หักคะแนนแลกสิทธิ์ร้านค้าพันธมิตร
        $redeem_points = RedeemPoint::where('member_id',$member_id)
                                     ->join('partner_shop_points', 'redeem_points.point_id', '=', 'partner_shop_points.id')
                                     ->select('partner_shop_points.*','redeem_points.*')->orderBy('partner_shop_points.id','desc')->get();

        return view('frontend/member/alliance/alliance-success')->with('dateNow',$dateNow)
                                                                ->with('points',$points)
                                                                ->with('redeem_rewards',$redeem_rewards)
                                                                ->with('redeem_points',$redeem_points)
                                                                ->with('point_id',$point_id)
                                                                ->with('partner_promotion',$partner_promotion);
    }
}
