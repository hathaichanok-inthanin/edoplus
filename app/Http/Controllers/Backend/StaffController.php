<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Member;
use App\Model\Point;
use App\Model\Campaign;
use App\Model\GetCoupon;
use App\Model\InvitationBalance;

use Validator;
use Carbon\Carbon;

class StaffController extends Controller
{
    public function __construct(){
        $this->middleware('auth:staff');
    }

    public function dashboard(Request $request) {
        $NUM_PAGE = 10;
        $members = Member::where('invitation', NULL)->paginate($NUM_PAGE);
        $page = $request->input('page');
        $page = ($page != null)?$page:1;
        return view('backend/staff/dashboard')->with('NUM_PAGE',$NUM_PAGE)
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
        return view('backend/staff/dashboard')->with('NUM_PAGE',$NUM_PAGE)
                                                   ->with('page',$page)
                                                   ->with('members',$members)
                                                   ->with('search',$search);
    }

    public function memberProfile(Request $request, $id) {
        $member = Member::findOrFail($id);
        return view('backend/staff/member/member-profile')->with('member',$member);
    }

    public function addpoint(Request $request) {
        $search = 'No Search';
        return view('backend/staff/member/addpoint')->with('search',$search);
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
        } else{
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
        return view('backend/staff/member/addpoint')->with('members',$members)
                                                    ->with('search',$search);
    }

    public function registerMember(Request $request) {
        return view('backend/staff/member/register');
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
            $password = $request->get('tel');
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
            $member->password = $password;
            $member->save();

            $request->session()->flash('alert-success', 'ลงทะเบียนสมัครสมาชิกสำเร็จ');
            return back();
        }
        else{
                $request->session()->flash('alert-danger', 'สมัครสมาชิกไม่สำเร็จ กรุณากรอกข้อมูลให้ถูกต้องครบถ้วน');
                return redirect('/staff/register-member')->withErrors($validator)->withInput();   
            }
    }

    public function searchMemberCoupon(Request $request) {
        return view('backend/staff/coupon/search-member');
    }

    public function coupon($id) {
        $search = 'No Search';
        $coupons = GetCoupon::where('member_id',$id)
                            ->join('campaigns', 'campaigns.id', '=', 'get_coupons.coupon_id')
                            ->select('campaigns.*', 'get_coupons.*','campaigns.status as status_coupon','get_coupons.status as status_get_coupon')
                            ->orderBy('get_coupons.id','desc')->get();
        $member_id = $id;
        return view('backend/staff/coupon/coupon-index')->with('search',$search)
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

        return view('backend/staff/coupon/coupon-index')->with('coupons',$coupons)
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
        return view('backend/staff/coupon/coupon')->with('members',$members)
                                                  ->with('search',$search);
    }

    public function useCoupon(Request $request, $id) {
        $dateNow = Carbon::now()->format('d/m/Y');
        $member_id = GetCoupon::where('id',$id)->value('member_id');
        $get_coupon = GetCoupon::findOrFail($id);
        $get_coupon->status = 'ใช้งานแล้ว';
        $get_coupon->date_use_coupon = $dateNow;
        $get_coupon->save();
        $request->session()->flash('alert-success', 'ใช้คูปองสำเร็จ');
        return back();
    }

    // Edo Invitation Only
    public function manageInvitationBalance() {
        $search = 'No Search';
        $balances = 'No';
        return view('backend/staff/invitation/manage-invitation-balance')->with('search',$search)
                                                                         ->with('balances',$balances);
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
        $balances = InvitationBalance::where('member_id',$member_id)->paginate($NUM_PAGE);
        $page = $request->input('page');
        $page = ($page != null)?$page:1;
        return view('backend/staff/invitation/manage-invitation-balance')->with('members',$members)
                                                                         ->with('search',$search)
                                                                         ->with('balances',$balances)
                                                                         ->with('NUM_PAGE',$NUM_PAGE)
                                                                         ->with('page',$page);
    }

    public function deleteBalancePost(Request $request) {
        $validator = Validator::make($request->all(), $this->rules_deteleBalance(), $this->messages_deteleBalance());
        if($validator->passes()) {
            $invitation_balance = new InvitationBalance;
            $invitation_balance->branch_id = $request->get('branch_id');
            $invitation_balance->member_id = $request->get('member_id');
            $invitation_balance->staff_id = $request->get('staff_id');
            $invitation_balance->type = $request->get('type');
            $invitation_balance->balance = $request->get('balance');
            $invitation_balance->bill_number = $request->get('bill_number');
            $invitation_balance->date = Carbon::now()->format('d/m/Y');
            $invitation_balance->service_date = $request->get('service_date');

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
            return redirect()->action('Backend\StaffController@manageInvitationBalance');

        } else{
            $request->session()->flash('alert-danger', 'ปรับลดยอดเงินไม่สำเร็จ กรุณาตรวจสอบข้อมูลอีกครั้ง !!');
            return back()->withErrors($validator)->withInput();   
        }
    }

    public function invitationFileDetail($id) {
        $balance = InvitationBalance::findOrFail($id);
        return view('backend/staff/invitation/file-detail')->with('balance',$balance);
    }

    public function rules_deteleBalance() {
        return [
            'balance' => 'required|numeric',
            'bill_number' => 'required',
            'file.*' => 'mimes:jpg,jpeg,png',
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

    public function rules_register() {
        return [
            'serialnumber' => 'unique:members',
            'card_id' => 'required|unique:members',
            'name' => 'required',
            'surname' => 'required',
            'bday' => 'required',
            'tel' => 'required|unique:members',
            'address' => 'required',
            'district' => 'required',
            'amphoe' => 'required',
            'province' => 'required',
            'zipcode' => 'required',
        ];
    }

    public function messages_register() {
        return [
            'serialnumber.unique' => 'หมายเลขสมาชิกใช้ในการลงทะเบียนแล้ว',
            'card_id.required' => 'กรุณากรอกหมายเลขบัตรประชาชน',
            'card_id.unique' => 'หมายเลขบัตรประชาชนใช้ในการลงทะเบียนแล้ว',
            'name.required' => 'กรุณากรอกชื่อ',
            'surname.required' => 'กรุณากรอกนามสกุล',
            'bday.required' => 'กรุณากรอกวันเดือนปีเกิด',
            'tel.required' => 'กรุณากรอกเบอร์โทรศัพท์',
            'tel.unique' => 'เบอร์โทรศัพท์ใช้ในการลงทะเบียนแล้ว',
            'address.required' => 'กรุณากรอกที่อยู่',
            'district.required' => 'กรุณากรอกตำบล',
            'amphoe.required' => 'กรุณากรอกอำเภอ',
            'province.required' => 'กรุณากรอกจังหวัด',
            'zipcode.required' => 'กรุณากรอกรหัสไปรษณีย์',
        ];
    }  

    public function rules_addPoint() {
        return [
            'bill_number' => 'required|unique:points',
            'price' => 'required',
            'file' => 'nullable|array',
            'file.*' => 'mimes:jpg,jpeg,png',
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
