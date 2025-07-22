<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Model\GetCoupon;
use Carbon\Carbon;
use Auth;

class CouponsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:member');
    }

    public function getCoupon($id) {
        $member_id = Auth::guard('member')->user()->id;
        $date_get_coupon = Carbon::now()->format('d/m/Y');
        $coupon = new GetCoupon;
        $coupon->member_id = $member_id;
        $coupon->coupon_id = $id;
        $coupon->date_get_coupon = $date_get_coupon;
        $coupon->status = "ยังไม่ใช้งาน";
        $coupon->save();
        $message = "กดรับคูปองสำเร็จ สามารถตรวจสอบคูปองของคุณได้ที่ เมนู บัญชีสมาชิก";
        return redirect()->back()->with( 'Message', $message );
    }
}
