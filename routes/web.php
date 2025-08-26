<?php
Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('config:cache');
    return 'DONE';
});

Route::get('/','Frontend\SystemController@index');
Route::get('/condition','Frontend\SystemController@condition');
Route::get('/allarticle','Frontend\SystemController@article');
Route::get('/article/{id}/{title}','Frontend\SystemController@articleDetail');
Route::get('/privilege','Frontend\SystemController@privilege');
Route::get('/privilege/{id}/{name}','Frontend\SystemController@privilegeDetail');
Route::get('/rewards','Frontend\SystemController@reward');
Route::get('/reward-detail/{id}','Frontend\SystemController@rewardDetail');
Route::get('/alliance','Frontend\SystemController@alliance');
Route::get('/alliance-foodanddrink','Frontend\SystemController@allianceFoodAndDrink');
Route::get('/alliance-lifestyle','Frontend\SystemController@allianceLifeStyle');
Route::get('/alliance-travel','Frontend\SystemController@allianceTravel');
Route::get('/alliance-carservice','Frontend\SystemController@allianceCarService');
Route::get('/alliance/{id}/{name}','Frontend\SystemController@allianceDetail');
Route::get('/contact-us','Frontend\SystemController@contactUs');
Route::get('/about-us','Frontend\SystemController@aboutUs');
Route::get('/help-center','Frontend\SystemController@helpCenter');
Route::get('/benefit-detail/{id}','Frontend\SystemController@benefitDetail');

// สมัครสมาชิกใหม่
Route::get('register-member','Frontend\SystemController@registerMember'); //หน้าสมัครสมาชิกใหม่
Route::post('register-member','Frontend\SystemController@registerMemberPost'); //สมัครสมาชิกใหม่

Route::group(['prefix' => 'member'], function(){
    // ข้อมูลการเข้าสู่ระบบของ member
    Route::get('login','AuthMember\LoginController@ShowLoginForm')->name('member.login');
    Route::post('login','AuthMember\LoginController@login')->name('member.login.submit');
    Route::post('logout', 'AuthMember\LoginController@logout')->name('member.logout');

    // เปลี่ยนรหัสผ่าน
    Route::get('/change-password', 'AuthMember\ChangePasswordController@index')->name('password.change');
    Route::post('/change-password', 'AuthMember\ChangePasswordController@changePassword')->name('password.update');

    // ลืมรหัสผ่าน
    Route::get('/forget-password', 'AuthMember\ForgetPasswordController@index')->name('password.forget');
    Route::post('/forget-password', 'AuthMember\ForgetPasswordController@forgetPassword')->name('password.forget.form');
    Route::post('/update-password', 'AuthMember\ForgetPasswordController@updatePassword')->name('password.updateForget');

    Route::get('/tel-change','Frontend\MembersController@telChange');
    Route::post('/tel-update','Frontend\MembersController@telUpdate');

    Route::get('/profile-change','Frontend\MembersController@profileChange');
    Route::post('/profile-update','Frontend\MembersController@profileUpdate');

    Route::get('/profile','Frontend\MembersController@profile')->name('member.home');
    Route::get('/invitation-file-detail/{id}','Frontend\MembersController@invitationFileDetail'); //ดูรายละเอียดหลักฐานการใช้บริการ

    // แลกของรางวัล
    Route::get('/reward-redeem/{id}','Frontend\RewardsController@rewardRedeem');
    Route::get('/redeem-point','Frontend\RewardsController@redeemPoint');
    Route::post('/reward-success','Frontend\RewardsController@rewardSuccess');

    // คูปอง
    Route::get('/get-coupon/{id}','Frontend\CouponsController@getCoupon');
    Route::get('/coupon','Frontend\MembersController@coupon');

    // พันธมิตรในเครือ
    Route::get('/alliance-redeem/{id}','Frontend\PartnersController@allianceRedeem');
    Route::post('/alliance-success','Frontend\PartnersController@allianceSuccess');
});

// Super Admin
Route::group(['prefix' => '/'], function(){
    // ข้อมูลการลงทะเบียนและเข้าสู่ระบบของ super admin
    Route::get('register','AuthAdmin\RegisterController@ShowRegisterForm');
    Route::post('register','AuthAdmin\RegisterController@register');

    Route::get('login','AuthAdmin\LoginController@ShowLoginForm')->name('admin.login');
    Route::post('login','AuthAdmin\LoginController@login')->name('admin.login.submit');
    Route::post('logout', 'AuthAdmin\LoginController@logout')->name('admin.logout');

    Route::get('dashboard','Backend\AdminController@dashboard')->name('admin.home'); //หน้า dashboard

    // ข้อมูลสมาชิก
    Route::get('member/list','Backend\AdminController@memberList')->name('member-list'); //หน้าข้อมูลสมาชิกทั้งหมด
    Route::get('member/list/status-on','Backend\AdminController@memberListOn'); //หน้าข้อมูลสมาชิกที่เปิดใช้งาน
    Route::get('member/list/status-off','Backend\AdminController@memberListOff'); //หน้าข้อมูลสมาชิกที่ปิดใช้งาน
    Route::get('search-member-list','Backend\AdminController@searchMemberList'); //ค้นหาข้อมูลสมาชิก
    Route::get('search-member-tier','Backend\AdminController@searchMemberTier'); //ค้นหาข้อมูลสมาชิกตามระดับ
    Route::get('member/profile/{id}','Backend\AdminController@memberProfile'); //หน้าโปรไฟล์สมาชิก
    Route::get('editProfile/{id}','Backend\AdminController@editProfile'); //หน้าแก้ไขโปรไฟล์สมาชิก
    Route::post('editProfile','Backend\AdminController@editProfilePost'); //แก้ไขโปรไฟล์สมาชิก
    Route::get('export-report-member', 'Backend\AdminController@exportReportMember')->name('export-member');

    // ข้อมูลบัญชีร้านค้า
    Route::get('account-store','Backend\AdminController@accountStore'); //หน้าข้อมูลบัญชีร้านค้า
    Route::get('account-store/{store_name}','Backend\AdminController@accountStoreName'); //หน้าข้อมูลบัญชีร้านค้าแต่ละร้าน
    Route::get('create-account-store','Backend\AdminController@createAccountStore'); //หน้าสร้างบัญชีร้านค้า
    Route::post('create-account-store','Backend\AdminController@createAccountStorePost'); //สร้างบัญชีร้านค้า
    Route::get('edit-account-store/{id}','Backend\AdminController@editAccountStore'); //แก้ไขบัญชีร้านค้า
    Route::post('update-account-store','Backend\AdminController@updateAccountStore'); //อัพเดตบัญชีร้านค้า

    // ข้อมูลบัญชีพนักงาน
    Route::get('create-account-staff/{store_name}/{branch}','Backend\AdminController@createAccountStaff'); //หน้าสร้างบัญชีพนักงาน
    Route::post('create-account-staff','Backend\AdminController@createAccountStaffPost'); //สร้างบัญชีพนักงาน
    Route::get('account-staff/{store_name}/{branch}','Backend\AdminController@accountStaff'); //หน้าข้อมูลบัญชีพนักงานแต่ละร้าน
    Route::get('edit-account-staff/{id}','Backend\AdminController@editAccountStaff'); //หน้าแก้ไขบัญชีพนักงาน
    Route::post('edit-account-staff','Backend\AdminController@editAccountStaffPost'); //แก้ไขบัญชีพนักงาน
    
    // ข้อมูลคะแนนสะสม
    Route::get('addpoint','Backend\AdminController@addpoint'); //หน้าเพิ่มคะแนนสะสม
    Route::post('addpoint','Backend\AdminController@addPointPost'); //เพิ่มคะแนนสะสม
    Route::post('deletepoint','Backend\AdminController@deletePointPost'); //ปรับลดยอดเงิน
    Route::post('editPoint','Backend\AdminController@editPoint'); //แก้ไขคะแนนสะสม
    Route::get('search-member','Backend\AdminController@searchMember'); //หน้าค้นหาข้อมูล เพิ่มคะแนนสะสม

    // ข้อมูลระดับสมาชิก
    Route::get('tier','Backend\AdminController@tier'); //ระดับสมาชิก
    Route::post('addtier','Backend\AdminController@addTierPost'); //เพิ่มระดับสมาชิก
    Route::get('tier-delete/{id}','Backend\AdminController@tierDelete'); //ลบระดับสมาชิก
    Route::get('edit-tier/{id}','Backend\AdminController@editTier'); //แก้ไขระดับสมาชิก
    Route::post('update-tier','Backend\AdminController@updateTier'); //อัพเดตระดับสมาชิก

    // จัดการของรางวัล   
    Route::get('create-reward','Backend\AdminController@createReward'); //หน้าสร้างของรางวัล
    Route::post('create-reward','Backend\AdminController@createRewardPost'); //เพิ่มของรางวัล
    Route::get('reward','Backend\AdminController@reward'); //หน้าของรางวัลทั้งหมด
    Route::get('reward-on','Backend\AdminController@rewardOn'); //หน้าของรางวัลกำลังใช้งาน
    Route::get('reward-notActive','Backend\AdminController@rewardNotActive'); //หน้าของรางวัลยังไม่ใช้งาน
    Route::get('reward-pause','Backend\AdminController@rewardPause'); //หน้าของรางวัลพักการใช้งาน
    Route::get('reward-off','Backend\AdminController@rewardOff'); //หน้าของรางวัลปิดการใช้งาน
    Route::get('reward-delete/{id}','Backend\AdminController@rewardDelete'); //ลบของรางวัล
    Route::get('reward-edit/{id}','Backend\AdminController@rewardEdit'); //แก้ไขของรางวัล
    Route::post('update-reward','Backend\AdminController@updateReward'); //อัพเดตของรางวัล

    // การแลกของรางวัล
    Route::get('redeem-reward','Backend\AdminController@redeemReward'); //การแลกของรางวัล
    Route::post('confirm-redeem-reward','Backend\AdminController@confirmRedeemReward'); //คอนเฟิร์มสถานะการแลกของรางวัล

    // จัดการคูปอง
    Route::get('create-campaign','Backend\AdminController@createCampaign'); //หน้าสร้างคูปอง
    Route::post('create-campaign','Backend\AdminController@createCampaignPost'); //สร้างคูปอง
    Route::get('campaign','Backend\AdminController@campaign'); //หน้าคูปองทั้งหมด
    Route::get('campaign-on','Backend\AdminController@campaignOn'); //หน้ากำลังจัดแคมเปญ
    Route::get('campaign-notActive','Backend\AdminController@campaignNotActive'); //หน้ายังไม่เริ่มแคมเปญ
    Route::get('campaign-pause','Backend\AdminController@campaignPause'); //หน้าแคมเปญถูกพัก
    Route::get('campaign-off','Backend\AdminController@campaignOff'); //หน้าสิ้นสุดแคมเปญ
    Route::get('campaign-edit/{id}','Backend\AdminController@campaignEdit'); //แก้ไขแคมเปญ
    Route::post('update-campaign','Backend\AdminController@updateCampaign'); //อัพเดตแคมเปญ
    Route::get('campaign-delete/{id}','Backend\AdminController@campaignDelete'); //ลบแคมเปญ

    // สิทธิประโยชน์สมาชิก
    Route::get('benefit','Backend\AdminController@benefit');
    Route::get('create-benefit','Backend\AdminController@createBenefit');
    Route::post('create-benefit','Backend\AdminController@createBenefitPost');
    Route::get('benefit-edit/{id}','Backend\AdminController@benefitEdit');
    Route::post('update-benefit','Backend\AdminController@updateBenefit');
    Route::get('benefit-delete/{id}','Backend\AdminController@benefitDelete');

    // พันธมิตรในเครือ
    Route::get('partner','Backend\AdminController@partner'); //หน้าพันธมิตรในเครือทั้งหมด
    Route::get('partner-off','Backend\AdminController@partnerOff'); //หน้าปิดการใช้งานพันธมิตร
    Route::get('create-partner','Backend\AdminController@createPartner'); //หน้าสร้างพันธมิตร
    Route::post('create-partner','Backend\AdminController@createPartnerPost'); //สร้างพันธมิตร
    Route::get('partner-edit/{id}','Backend\AdminController@partnerEdit'); //แก้ไขพันธมิตร
    Route::post('update-partner','Backend\AdminController@updatePartner'); //อัพเดตพันธมิตร
    Route::get('partner-add-promotion/{id}','Backend\AdminController@partnerAddPromotion'); //หน้าเพิ่มโปรโมชั่น
    Route::post('partner-add-promotion','Backend\AdminController@partnerAddPromotionPost'); //เพิ่มโปรโมชั่น
    Route::get('partner-promotion/{id}','Backend\AdminController@partnerPromotion'); //หน้าโปรโมชั่น
    Route::get('delete-promotion/{id}','Backend\AdminController@deletePromotion'); //ลบโปรโมชั่น
    Route::get('promotion-edit/{id}','Backend\AdminController@promotionEdit'); //แก้ไขโปรโมชั่น
    Route::post('update-promotion','Backend\AdminController@updatePromotion'); //อัพเดตโปรโมชั่น

    // รายงานข้อมูลร้านค้าพันธมิตร
    Route::get('report-partner','Backend\AdminController@reportPartner');
    Route::get('export-report-partner', 'Backend\AdminController@exportReportPartner')->name('export');

    // บทความ ข่าวสาร
    Route::get('article','Backend\AdminController@article'); 
    Route::get('create-article','Backend\AdminController@createArticle'); 
    Route::post('create-article','Backend\AdminController@createArticlePost'); 
    Route::get('delete-article/{id}','Backend\AdminController@deleteArticle'); //ลบบทความ
    Route::get('article-edit/{id}','Backend\AdminController@articleEdit'); //แก้ไขบทความ
    Route::post('update-article','Backend\AdminController@updateArticle'); //อัพเดตบทความ

    // Media
    Route::get('media','Backend\AdminController@media'); 
    // รูปภาพสไลด์หน้าหลัก
    Route::get('upload-slide-image','Backend\AdminController@uploadSlideImage'); 
    Route::post('upload-slide-image','Backend\AdminController@uploadSlideImagePost'); 
    Route::get('slide-image-delete/{id}','Backend\AdminController@slideImageDelete');
    Route::get('slide-image-edit/{id}','Backend\AdminController@slideImageEdit');
    Route::post('update-slide-image','Backend\AdminController@updateSlideImage');
    
    // รูปภาพเนื้อหาบทความ
    Route::get('upload-article-image','Backend\AdminController@uploadArticleImage'); 
    Route::post('upload-article-image','Backend\AdminController@uploadArticleImagePost'); 
    Route::get('article-image-delete/{id}','Backend\AdminController@ArticleImageDelete');
    Route::get('article-image-edit/{id}','Backend\AdminController@ArticleImageEdit');
    Route::post('update-article-image','Backend\AdminController@updateArticleImage');

    // รายงานสรุป
    Route::get('report/point','Backend\AdminController@reportPoint'); //ประวัติการจัดการพอยท์
    Route::post('report/export-point', 'Backend\AdminController@exportReportPoint'); //ส่งออกข้อมูลประวัติการจัดการพอยท์
    Route::get('report/birthMonth','Backend\AdminController@reportBirthMonth'); //ข้อมูลเดือนเกิด
    Route::post('report/export-birthMonth', 'Backend\AdminController@exportReportBirthMonth'); //ส่งออกข้อมูลเดือนเกิด
    Route::get('report/member','Backend\AdminController@reportMember'); //ข้อมูลสมาชิกทั้งหมด
    Route::post('report/export-member', 'Backend\AdminController@exportReportAllMember'); //ส่งออกข้อมูลสมาชิกทั้งหมด

    // Edo Invitation Only
    Route::get('invitation/member','Backend\AdminController@invitationMember'); //ข้อมูลสมาชิก Edo Invitation Only
    Route::get('search-member-invitation','Backend\AdminController@searchMemberInvitation'); //ค้นหาข้อมูลสมาชิก
    Route::get('invitation/manage-balance','Backend\AdminController@manageInvitationBalance'); //จัดการยอดเงิน
    Route::get('search-invitation','Backend\AdminController@searchInvitation');
    Route::get('add-balance/{id}','Backend\AdminController@addBalance'); //เพิ่มยอดเงิน
    Route::post('add-balance','Backend\AdminController@addBalancePost'); //เพิ่มยอดเงิน
    Route::post('delete-balance','Backend\AdminController@deleteBalancePost'); //ลบยอดเงิน
    Route::get('invitation-file-detail/{id}','Backend\AdminController@invitationFileDetail'); //ดูรายละเอียดหลักฐานการใช้บริการ
});

// Admin ร้านค้า
Route::group(['prefix' => 'admin'], function(){
    // ข้อมูลการเข้าสู่ระบบของ admin ร้านค้า
    Route::get('/login','AuthStore\LoginController@ShowLoginForm')->name('admin-store.login');
    Route::post('/login','AuthStore\LoginController@login')->name('admin-store.login.submit');
    Route::post('/logout', 'AuthStore\LoginController@logout')->name('admin-store.logout');   

    Route::get('dashboard','Backend\AdminStoreController@dashboard')->name('admin-store.home'); //หน้า dashboard

    // ข้อมูลสมาชิก
    Route::get('search-member-list','Backend\AdminStoreController@searchMemberList'); //ค้นหาข้อมูลสมาชิก
    Route::get('member/profile/{id}','Backend\AdminStoreController@memberProfile'); //หน้าโปรไฟล์สมาชิก
    Route::get('edit-profile/{id}','Backend\AdminStoreController@editProfile'); //หน้าแก้ไขโปรไฟล์สมาชิก
    Route::post('edit-profile','Backend\AdminStoreController@editProfilePost'); //แก้ไขโปรไฟล์สมาชิก

    // ข้อมูลคะแนนสะสม
    Route::get('addpoint','Backend\AdminStoreController@addpoint'); //หน้าเพิ่มคะแนนสะสม
    Route::post('addpoint','Backend\AdminStoreController@addPointPost'); //เพิ่มคะแนนสะสม
    Route::get('search-member','Backend\AdminStoreController@searchMember'); //หน้าค้นหาข้อมูล เพิ่มคะแนนสะสม

    // ข้อมูลบัญชีพนักงาน
    Route::get('account-staff','Backend\AdminStoreController@accountStaff'); //หน้าข้อมูลบัญชีพนักงาน
    Route::get('create-account-staff','Backend\AdminStoreController@createAccountStaff'); //หน้าสร้างบัญชีพนักงาน
    Route::post('create-account-staff','Backend\AdminStoreController@createAccountStaffPost'); //สร้างบัญชีพนักงาน

    // จัดการคูปอง
    Route::get('search-member-coupon','Backend\AdminStoreController@searchMemberCoupon'); //หน้าค้นหาคูปอง
    Route::get('search-member-coupon-post','Backend\AdminStoreController@searchMemberCouponPost'); //หน้าค้นหาข้อมูล ใช้คูปอง
    Route::get('coupon/{id}','Backend\AdminStoreController@coupon'); 
    Route::get('search-coupon','Backend\AdminStoreController@searchCoupon');
    Route::get('use-coupon/{id}','Backend\AdminStoreController@useCoupon'); //กดใช้งานคูปอง

    // Edo Invitation Only
    Route::get('invitation/manage-balance','Backend\AdminStoreController@manageInvitationBalance'); //จัดการยอดเงิน
    Route::get('search-invitation','Backend\AdminStoreController@searchInvitation');
    Route::post('delete-balance','Backend\AdminStoreController@deleteBalancePost'); //ลบยอดเงิน
    Route::get('invitation-file-detail/{id}','Backend\AdminStoreController@invitationFileDetail'); //ดูรายละเอียดหลักฐานการใช้บริการ
});

// Staff พนักงาน
Route::group(['prefix' => 'staff'], function(){
    // ข้อมูลการเข้าสู่ระบบของพนักงาน
    Route::get('/login','AuthStaff\LoginController@ShowLoginForm')->name('staff.login');
    Route::post('/login','AuthStaff\LoginController@login')->name('staff.login.submit');
    Route::post('/logout', 'AuthStaff\LoginController@logout')->name('staff.logout');

    Route::get('dashboard','Backend\StaffController@dashboard')->name('staff.home'); //หน้า dashboard

    // ข้อมูลสมาชิก
    Route::get('search-member-list','Backend\StaffController@searchMemberList'); //ค้นหาข้อมูลสมาชิก
    Route::get('member/profile/{id}','Backend\StaffController@memberProfile'); //หน้าโปรไฟล์สมาชิก

    // ข้อมูลคะแนนสะสม
    Route::get('addpoint','Backend\StaffController@addpoint'); //หน้าเพิ่มคะแนนสะสม
    Route::post('addpoint','Backend\StaffController@addPointPost'); //เพิ่มคะแนนสะสม
    Route::get('search-member','Backend\StaffController@searchMember'); //หน้าค้นหาข้อมูล เพิ่มคะแนนสะสม
    
    // สมัครสมาชิกใหม่
    Route::get('register-member','Backend\StaffController@registerMember'); //หน้าสมัครสมาชิกใหม่
    Route::post('register-member','Backend\StaffController@registerMemberPost'); //สมัครสมาชิกใหม่

    // จัดการคูปอง
    Route::get('search-member-coupon','Backend\StaffController@searchMemberCoupon'); //หน้าค้นหาคูปอง
    Route::get('search-member-coupon-post','Backend\StaffController@searchMemberCouponPost'); //หน้าค้นหาข้อมูล ใช้คูปอง
    Route::get('coupon/{id}','Backend\StaffController@coupon'); 
    Route::get('search-coupon','Backend\StaffController@searchCoupon');
    Route::get('use-coupon/{id}','Backend\StaffController@useCoupon'); //กดใช้งานคูปอง

    // Edo Invitation Only
    Route::get('invitation/manage-balance','Backend\StaffController@manageInvitationBalance'); //จัดการยอดเงิน
    Route::get('search-invitation','Backend\StaffController@searchInvitation');
    Route::post('delete-balance','Backend\StaffController@deleteBalancePost'); //ลบยอดเงิน
    Route::get('invitation-file-detail/{id}','Backend\StaffController@invitationFileDetail'); //ดูรายละเอียดหลักฐานการใช้บริการ
});


// Partner เครือข่ายพันธมิตร
Route::group(['prefix' => 'partner'], function(){
    // ข้อมูลการเข้าสู่ระบบของพันธมิตร
    Route::get('/login','AuthPartner\LoginController@ShowLoginForm')->name('partner.login');
    Route::post('/login','AuthPartner\LoginController@login')->name('partner.login.submit');
    Route::post('/logout', 'AuthPartner\LoginController@logout')->name('partner.logout');

    Route::get('search-member','Backend\PartnerController@searchMember'); //หน้าค้นหาข้อมูลสมาชิก
    Route::get('report-partner','Backend\PartnerController@reportPartner')->name('partner.home'); //หน้ารายงานข้อมูลการใช้
    Route::get('update-status-alliance/{id}','Backend\PartnerController@updateStatusAlliance');
    Route::post('update-status-alliance','Backend\PartnerController@updateStatusAlliancePost');
    
    // จัดการคูปอง
    Route::get('coupon','Backend\PartnerController@coupon'); //หน้าจัดการคูปอง
    Route::get('search-coupon','Backend\PartnerController@searchCoupon'); //หน้าค้นหาคูปอง
});

