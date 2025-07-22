<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\AccountStaff;
use App\AccountStore;
use App\Member;
use App\Model\Point;
use App\Model\Campaign;
use App\Model\GetCoupon;
use App\Model\InvitationBalance;

use Carbon\Carbon;
use Auth;
use Validator;

class AdminStoreController extends Controller
{
    public function __construct(){
        $this->middleware('auth:admin-store');
    }

    public function dashboard(Request $request) {
        $NUM_PAGE = 10;
        $members = Member::where('invitation', NULL)->paginate($NUM_PAGE);
        $page = $request->input('page');
        $page = ($page != null)?$page:1;
        return view('backend/adminStore/dashboard')->with('NUM_PAGE',$NUM_PAGE)
                                                   ->with('page',$page)
                                                   ->with('members',$members);
    }

    public function searchMemberList(Request $request) {
        $NUM_PAGE = 20;
        $search = $request->get('search');
        $members = Member::where('tel',$search)->where('invitation', NULL)->paginate($NUM_PAGE);
        $count = count($members);
            if($count == 0) {
                $search = '0';
            }
        $page = $request->input('page');
        $page = ($page != null)?$page:1;
        return view('backend/adminStore/dashboard')->with('NUM_PAGE',$NUM_PAGE)
                                                   ->with('page',$page)
                                                   ->with('members',$members)
                                                   ->with('search',$search);
    }

    public function memberProfile(Request $request, $id) {
        $NUM_PAGE = 20;
        $member = Member::findOrFail($id);
        $points = Point::where('member_id',$id)->paginate($NUM_PAGE);
        $page = $request->input('page');
        $page = ($page != null)?$page:1;
        return view('backend/adminStore/member/member-profile')->with('NUM_PAGE',$NUM_PAGE)
                                                               ->with('page',$page)
                                                               ->with('member',$member)
                                                               ->with('points',$points);
    }

    public function addpoint(Request $request) {
        $search = 'No Search';
        return view('backend/adminStore/member/addpoint')->with('search',$search);
    }

    public function addPointPost(Request $request) {
        $validator = Validator::make($request->all(), $this->rules_addPoint(), $this->messages_addPoint());
        if($validator->passes()) {
            $pointData = $request->except('file');
            $point = Point::create($pointData);

            if ($request->hasFile('file')) {
                $files = $request->file('file');
                $file_names = [];

                foreach ($files as $file) {
                    $filename = md5($file->getClientOriginalName() . time()) . "_o." . $file->getClientOriginalExtension();
                    $file->move('files/bill/', $filename);
                    $file_names[] = $filename;
                }

                $point->file = json_encode($file_names);
                $point->save();
            }

            $request->session()->flash('alert-success', 'เพิ่มคะแนนสะสมสำเร็จ');
            return back();
        }else{
            $request->session()->flash('alert-danger', 'เพิ่มคะแนนสะสมไม่สำเร็จ กรุณาตรวจสอบข้อมูลอีกครั้ง');
            return back()->withErrors($validator)->withInput();   
        }
    }

    public function searchMember(Request $request) {
        $search = $request->get('search');
        $members = Member::where('tel',$search)->get();
        $count = count($members);
            if($count == 0) {
                $search = '0';
            }
        return view('backend/adminStore/member/addpoint')->with('members',$members)
                                                         ->with('search',$search);
    }

    public function accountStaff(Request $request) {
        $NUM_PAGE = 15;
        $store_id = Auth::guard('admin-store')->id();
        $account_staffs = AccountStaff::where('store_id',$store_id)->paginate($NUM_PAGE);
        $page = $request->input('page');
        $page = ($page != null)?$page:1;
        return view('backend/adminStore/account-staff/dashboard')->with('NUM_PAGE',$NUM_PAGE)
                                                                 ->with('page',$page)
                                                                 ->with('account_staffs',$account_staffs);
    }

    public function createAccountStaff() {
        return view('backend/adminStore/account-staff/create-account');
    }

    public function createAccountStaffPost(Request $request) {
        $validator = Validator::make($request->all(), $this->rules_createAccountStaff(), $this->messages_createAccountStaff());
        if($validator->passes()) {
            $account_staff = $request->all();
            $account_staff['password'] = bcrypt($account_staff['password_name']);
            $account_staff = AccountStaff::create($account_staff);

            $request->session()->flash('alert-success', 'สร้างบัญชีพนักงานสำเร็จ');
            return redirect()->action('Backend\AdminStoreController@accountStaff');
        }else{
            $request->session()->flash('alert-danger', 'สร้างบัญชีพนักงานไม่สำเร็จ กรุณาตรวจสอบข้อมูลอีกครั้ง');
            return back()->withErrors($validator)->withInput();   
        }
    }

    public function searchMemberCoupon(Request $request) {
        return view('backend/adminStore/coupon/search-member');
    }

    public function coupon($id) {
        $search = 'No Search';
        $coupons = GetCoupon::where('member_id',$id)
                            ->join('campaigns', 'campaigns.id', '=', 'get_coupons.coupon_id')
                            ->select('campaigns.*', 'get_coupons.*','campaigns.status as status_coupon','get_coupons.status as status_get_coupon')
                            ->orderBy('get_coupons.id','desc')->get();
        $member_id = $id;
        return view('backend/adminStore/coupon/coupon-index')->with('search',$search)
                                                             ->with('member_id',$member_id)
                                                             ->with('coupons',$coupons);
    }

    public function searchCoupon(Request $request) {
        $member_id = $request->get('member_id');
        $search = $request->get('code');

        $coupons = GetCoupon::where('member_id',$member_id)
                            ->join('campaigns', 'campaigns.id', '=', 'get_coupons.coupon_id')
                            ->where('campaigns.code', '=', $search)
                            ->select('campaigns.*', 'get_coupons.*','campaigns.status as status_coupon','get_coupons.status as status_get_coupon')
                            ->orderBy('get_coupons.id','desc')->get();

        return view('backend/adminStore/coupon/coupon-index')->with('coupons',$coupons)
                                                             ->with('search',$search)
                                                             ->with('member_id',$member_id);
    }

    public function searchMemberCouponPost(Request $request) {
        $search = $request->get('search');
        $members = Member::where('tel',$search)->get();
        $count = count($members);
            if($count == 0) {
                $search = '0';
            }
        return view('backend/adminStore/coupon/coupon')->with('members',$members)
                                                       ->with('search',$search);
    }

    public function useCoupon(Request $request, $id) {
        $member_id = GetCoupon::where('id',$id)->value('member_id');
        $get_coupon = GetCoupon::findOrFail($id);
        $get_coupon->status = 'ใช้งานแล้ว';
        $get_coupon->save();
        $request->session()->flash('alert-success', 'ใช้คูปองสำเร็จ');
        return back();
    }

    // Edo Invitation Only
    public function manageInvitationBalance() {
        $search = 'No Search';
        return view('backend/adminStore/invitation/manage-invitation-balance')->with('search',$search);
    }

    public function searchInvitation(Request $request) {
        $search = $request->get('search');
        $members = Member::where('invitation', '!=', '')
                         ->where('tel',$search)->get();
        $count = count($members);
            if($count == 0) {
                $search = '0';
            }
        
        $member_id = Member::where('tel',$search)->value('id');
        $NUM_PAGE = 20;
        $page = $request->input('page');
        $page = ($page != null)?$page:1;
        return view('backend/adminStore/invitation/manage-invitation-balance')->with('members',$members)
                                                                              ->with('search',$search)
                                                                              ->with('NUM_PAGE',$NUM_PAGE)
                                                                              ->with('page',$page);
    }

    public function deleteBalancePost(Request $request) {
        $validator = Validator::make($request->all(), $this->rules_deteleBalance(), $this->messages_deteleBalance());
        if($validator->passes()) {
            $invitation_balance = new InvitationBalance;
            $invitation_balance->member_id = $request->get('member_id');
            $invitation_balance->store_id = $request->get('store_id');
            $invitation_balance->type = $request->get('type');
            $invitation_balance->balance = $request->get('balance');
            $invitation_balance->bill_number = $request->get('bill_number');
            $invitation_balance->date = Carbon::now()->format('d/m/Y');

            if($request->hasFile('file')) {
                $files = $request->file('file');
                $file_names = [];

                foreach ($files as $file) {
                    $filename = md5($file->getClientOriginalName() . time()) . "_o." . $file->getClientOriginalExtension();
                    $file->move('files/bill/', $filename);
                    $file_names[] = $filename;
                }
                $invitation_balance->file = json_encode($file_names);
            }

            $invitation_balance->save();
            $request->session()->flash('alert-success','ปรับลดยอดเงินสำเร็จ');
            return redirect()->action('Backend\AdminStoreController@manageInvitationBalance');

        } else{
            $request->session()->flash('alert-danger', 'ปรับลดยอดเงินไม่สำเร็จ กรุณาตรวจสอบข้อมูลอีกครั้ง !!');
            return back()->withErrors($validator)->withInput();   
        }
    }

    public function rules_deteleBalance() {
        return [
            'balance' => 'required|numeric',
            'bill_number' => 'required',
            'file.*' => 'mimes:jpg,jpeg,png|max:2048',
            'file' => 'required|array|min:1',
        ];
    }

    public function messages_deteleBalance() {
        return [
            'balance.required' => 'กรุณากรอกจำนวนเงินที่ต้องการปรับลด',
            'balance.numeric' => 'กรุณากรอกจำนวนเงินที่เป็นตัวเลขเท่านั้น',
            'bill_number.required' => 'กรุณากรอกหมายเลขบิล',
        ];
    }

    public function rules_createAccountStaff() {
        return [
            'name' => 'required',
            'username' => 'required|unique:account_staffs',
            'password_name' => 'required',
            'password_confirmation' => 'required',
        ];
    }

    public function messages_createAccountStaff() {
        return [
            'name.required' => 'กรุณากรอกชื่อ',
            'username.required' => 'กรุณากรอกชื่อเข้าใช้งาน',
            'username.unique' => 'ชื่อเข้าใช้งานมีผู้ใช้แล้ว',
            'password_name.required' => 'กรุณากรอกรหัสผ่าน',
            'password_confirmation.required' => 'กรุณายืนยันรหัสผ่าน',
        ];
    }

    public function rules_addPoint() {
        return [
            'bill_number' => 'required|unique:points',
            'price' => 'required',
            'file' => 'nullable|array',
            'file.*' => 'mimes:jpg,jpeg,png|max:2048',
        ];
    }

    public function messages_addPoint() {
        return [
            'bill_number.required' => 'กรุณากรอกหมายเลขบิล',
            'bill_number.unique' => 'หมายเลขบิลซ้ำ',
            'price.required' => 'กรุณากรอกจำนวนเงิน',
        ];
    }
}
