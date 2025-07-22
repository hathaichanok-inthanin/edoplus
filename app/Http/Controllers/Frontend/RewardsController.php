<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\model\Reward;
use App\model\RedeemReward;
use App\model\RedeemPoint;
use App\model\Point;
use App\model\RewardPoint;
use App\Member;
use Auth;
use Carbon\Carbon;

class RewardsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:member');
    }
    
    public function redeemPoint(Request $request){
        $NUM_PAGE = 20;
        $member_id = Auth::guard('member')->user()->id;
        $redeem_points = RedeemReward::where('member_id', $member_id)->paginate($NUM_PAGE);
        $page = $request->input('page');
        $page = ($page != null)?$page:1;
        return view('frontend/member/account/redeem-point')->with('redeem_points',$redeem_points)
                                                           ->with('NUM_PAGE',$NUM_PAGE)
                                                           ->with('page',$page);
    }

    public function rewardRedeem($id) {
        $reward = Reward::findOrFail($id);
        
        $member_id = Auth::guard('member')->user()->id;
        $member = Member::findOrFail($member_id);

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

        return view('frontend/member/reward/reward-redeem')->with('member',$member)
                                                          ->with('dateNow',$dateNow)
                                                          ->with('points',$points)
                                                          ->with('reward',$reward)
                                                          ->with('redeem_rewards',$redeem_rewards)
                                                          ->with('redeem_points',$redeem_points);
    }

    public function rewardSuccess(Request $request) {
        $member_id = Auth::guard('member')->user()->id;
        $reward_point_id = RewardPoint::where('reward_id',$request->get('id'))->orderBy('id','desc')->value('id');
        $reward_id = RewardPoint::where('id', $reward_point_id)->value('reward_id');
        $reward = Reward::findOrFail($reward_id);
                  
        $dateNow = Carbon::now()->format('d/m/Y');

            $redeem_reward = new RedeemReward;
            $redeem_reward->member_id = $member_id;
            $redeem_reward->reward_id = $request->get('id');
            $redeem_reward->point_id = $reward_point_id;
            $redeem_reward->date = $dateNow;
            $redeem_reward->status = "รอดำเนินการ";
            $redeem_reward->save();

        // หักคะแนนจากการแลกของรางวัล
        $redeem_rewards = RedeemReward::where('member_id',$member_id)
                                      ->join('reward_points', 'redeem_rewards.point_id', '=', 'reward_points.id')
                                      ->select('reward_points.*', 'redeem_rewards.*')->get();

        // คะแนนสะสม
        $points = Point::where('member_id',$member_id)->get();

        // หักคะแนนแลกสิทธิ์ร้านค้าพันธมิตร
        $redeem_points = RedeemPoint::where('member_id',$member_id)
                                     ->join('partner_shop_points', 'redeem_points.point_id', '=', 'partner_shop_points.id')
                                     ->select('partner_shop_points.*','redeem_points.*')->orderBy('partner_shop_points.id','desc')->get();

        
        
        // ส่งแจ้งเตือนเข้า Mail
        // $details = [
        //     'reward_id' => $reward_id,
        // ];

        // \Mail::to('wara.ardkaew@gmail.com')->send(new \App\Mail\RewardMail($details));
        // \Mail::to('ping.inthanin@gmail.com')->send(new \App\Mail\RewardMail($details));
        
        return view('frontend/member/reward/reward-success')->with('points',$points)
                                                            ->with('redeem_points',$redeem_points)
                                                            ->with('points',$points)
                                                            ->with('redeem_points',$redeem_points)
                                                            ->with('reward_point_id',$reward_point_id)
                                                            ->with('redeem_rewards',$redeem_rewards)
                                                            ->with('reward',$reward);
      }
}
