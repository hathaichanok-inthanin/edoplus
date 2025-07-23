<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use App\Model\Reward;
use App\Model\Campaign;
use App\Model\Article;
use App\Model\PartnerShopPromotion;
use App\PartnerShop;
use App\AccountStore;
use App\Member;
use App\Model\Benefit;


use Validator;
use Carbon\Carbon;

class SystemController extends Controller
{
    public function registerMember(Request $request) {
        return view('frontend/member/register');
    }

    public function registerMemberPost(Request $request) {
        $validator = Validator::make($request->all(), $this->rules_register(), $this->messages_register());
        if($validator->passes()) {
            // ข้อมูลของตาราง members
            $random = rand(1111111111111111,9999999999999999);  
            $serialnumber = wordwrap($random , 4 , '-' , true );

            $card_id = $request->get('card_id');
            $title = $request->get('title');
            $name = $request->get('name');
            $surname = $request->get('surname');
            $bday = $request->get('bday');
            $tel = $request->get('tel');
            $status = $request->get('status');
            // $password_str = str_replace('-', '', $request->get('tel'));
            $password = $request->get('password');
            $date = Carbon::now()->format('d/m/Y');

            $member = new Member;
            $member->serialnumber = $serialnumber;
            $member->card_id = $card_id;
            $member->title = $title;
            $member->name = $name;
            $member->surname = $surname;
            $member->bday = $bday;
            $member->tel = $tel;
            $member->date = $date;
            $member->status = $status;
            // $member->password = bcrypt($password_str);
            $member->password = bcrypt($password);
            $member->save();

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

            $request->session()->flash('alert-success', 'ลงทะเบียนสมัครสมาชิกสำเร็จ');
            return redirect('/member/profile');
        }
        else{
                $request->session()->flash('alert-danger', 'สมัครสมาชิกไม่สำเร็จ กรุณากรอกข้อมูลให้ถูกต้องครบถ้วน');
                return redirect('/register-member')->withErrors($validator)->withInput();   
            }
    }

    public function index() {
        $rewards = Reward::where('status','กำลังใช้งาน')->paginate('3');
        $articles = Article::where('status','เปิด')->paginate('3');
        $partners = PartnerShop::groupBy('name')->orderBy('id','desc')->get(); 
        $account_stores = AccountStore::groupBy('store_name')->orderBy('id','asc')->get(); 
        $partner_promotions = PartnerShop::join('partner_shop_promotions', 'partner_shops.id', '=', 'partner_shop_promotions.partner_id')
                                         ->where('partner_shops.status','=','เปิด')
                                         ->where('partner_shop_promotions.status','=','เปิด')
                                         ->select('partner_shops.*','partner_shop_promotions.*')->paginate('6');
        return view('frontend/index')->with('rewards',$rewards)
                                     ->with('articles',$articles)
                                     ->with('partners',$partners)
                                     ->with('account_stores',$account_stores)
                                     ->with('partner_promotions',$partner_promotions);
    }

    public function condition() {
        return view('frontend/system/condition');
    }

    public function article() {
        $articles = Article::where('status','เปิด')->get();
        return view('frontend/system/article/article')->with('articles',$articles);
    }

    public function articleDetail($id) {
        $article = Article::findOrFail($id);
        return view('frontend/system/article/article-detail')->with('article',$article);
    }

    public function privilege() {
        $coupons = Campaign::where('status','กำลังจัดแคมเปญ')->get();
        return view('frontend/system/privilege')->with('coupons',$coupons);
    }

    public function privilegeDetail($id) {
        $coupon = Campaign::findOrFail($id);
        return view('frontend/system/privilege-detail')->with('coupon',$coupon);
    }

    public function reward() {
        $rewards = Reward::where('status','กำลังใช้งาน')->get();
        return view('frontend/system/reward')->with('rewards',$rewards);
    }

    public function rewardDetail($id) {
        $reward = Reward::findOrFail($id);
        return view('frontend/system/reward-detail')->with('reward',$reward);
    }


    public function alliance() {
        $partner_promotions = PartnerShop::join('partner_shop_promotions', 'partner_shops.id', '=', 'partner_shop_promotions.partner_id')
                                         ->where('partner_shops.status','=','เปิด')
                                         ->where('partner_shop_promotions.status','=','เปิด')
                                         ->select('partner_shops.*','partner_shop_promotions.*')->paginate('6');
        $partners = PartnerShop::groupBy('name')->orderBy('id','desc')->get(); 
        $account_stores = AccountStore::groupBy('store_name')->orderBy('id','asc')->get(); 
        return view('frontend/system/alliance/index')->with('partners',$partners)
                                                     ->with('partner_promotions',$partner_promotions)
                                                     ->with('account_stores',$account_stores);
    }

    public function allianceFoodAndDrink() {
        $partners = PartnerShop::join('partner_shop_promotions', 'partner_shops.id', '=', 'partner_shop_promotions.partner_id')
                               ->where('partner_shops.status','=','เปิด')
                               ->where('partner_shop_promotions.status','=','เปิด')
                               ->where('partner_shops.type','=','Food And Drink')
                               ->select('partner_shops.*','partner_shop_promotions.*')->get();
        return view('frontend/system/alliance/foodanddrink')->with('partners',$partners);
    }

    public function allianceLifeStyle() {
        $partners = PartnerShop::join('partner_shop_promotions', 'partner_shops.id', '=', 'partner_shop_promotions.partner_id')
                               ->where('partner_shops.status','=','เปิด')
                               ->where('partner_shop_promotions.status','=','เปิด')
                               ->where('partner_shops.type','=','Life Style')
                               ->select('partner_shops.*','partner_shop_promotions.*')->get();
        return view('frontend/system/alliance/lifestyle')->with('partners',$partners);
    }

    public function allianceTravel() {
        $partners = PartnerShop::join('partner_shop_promotions', 'partner_shops.id', '=', 'partner_shop_promotions.partner_id')
                               ->where('partner_shops.status','=','เปิด')
                               ->where('partner_shop_promotions.status','=','เปิด')
                               ->where('partner_shops.type','=','Travel')
                               ->select('partner_shops.*','partner_shop_promotions.*')->get();
        return view('frontend/system/alliance/travel')->with('partners',$partners);
    }

    public function allianceCarService() {
        $partners = PartnerShop::join('partner_shop_promotions', 'partner_shops.id', '=', 'partner_shop_promotions.partner_id')
                               ->where('partner_shops.status','=','เปิด')
                               ->where('partner_shop_promotions.status','=','เปิด')
                               ->where('partner_shops.type','=','Car Service')
                               ->select('partner_shops.*','partner_shop_promotions.*')->get();
        return view('frontend/system/alliance/carservice')->with('partners',$partners);
    }

    public function allianceDetail($id) {
        $promotion = PartnerShopPromotion::findOrFail($id);
        $partner_promotions = PartnerShop::join('partner_shop_promotions', 'partner_shops.id', '=', 'partner_shop_promotions.partner_id')
                                         ->where('partner_shops.status','=','เปิด')
                                         ->where('partner_shop_promotions.status','=','เปิด')
                                         ->select('partner_shops.*','partner_shop_promotions.*')->paginate('6');
        return view('frontend/system/alliance/alliance-detail')->with('promotion',$promotion)
                                                               ->with('partner_promotions',$partner_promotions);
    }

    public function contactUs() {
        return view('frontend/system/contact-us');
    }

    public function aboutUs() {
        $account_stores = AccountStore::groupBy('store_name')->orderBy('id','asc')->get(); 
        $partners = PartnerShop::groupBy('name')->orderBy('id','desc')->get(); 
        return view('frontend/system/about-us')->with('account_stores',$account_stores)
                                               ->with('partners',$partners);
    }

    public function helpCenter() {
        $account_stores = AccountStore::groupBy('store_name')->orderBy('id','asc')->get(); 
        $partners = PartnerShop::groupBy('name')->orderBy('id','desc')->get(); 
        return view('frontend/system/help-center')->with('account_stores',$account_stores)
                                                  ->with('partners',$partners);
    }

    public function benefitDetail($id) {
        $benefit = Benefit::findOrFail($id);
        return view('frontend/system/benefit-detail')->with('benefit',$benefit);
    }

    public function rules_register() {
        return [
            'serialnumber' => 'unique:members',
            // 'card_id' => 'unique:members',
            'name' => 'required',
            'surname' => 'required',
            'bday' => 'required',
            'tel' => 'required|unique:members',
        ];
    }

    public function messages_register() {
        return [
            // 'serialnumber.unique' => 'หมายเลขสมาชิกใช้ในการลงทะเบียนแล้ว',
            // 'card_id.required' => 'กรุณากรอกหมายเลขบัตรประชาชน',
            'card_id.unique' => 'หมายเลขบัตรประชาชนใช้ในการลงทะเบียนแล้ว',
            'name.required' => 'กรุณากรอกชื่อ',
            'surname.required' => 'กรุณากรอกนามสกุล',
            'bday.required' => 'กรุณากรอกวันเดือนปีเกิด',
            'tel.required' => 'กรุณากรอกเบอร์โทรศัพท์',
            'tel.unique' => 'เบอร์โทรศัพท์ใช้ในการลงทะเบียนแล้ว',
        ];
    }  
}
