# EdoPlus - Restaurant Loyalty & Membership Management System
ระบบบริหารจัดการสมาชิกและสิทธิประโยชน์ (ในเครือ Edo Group)

## Project Overview
EdoPlus พัฒนาขึ้นเพื่อเป็นเครื่องมือทางการตลาด สำหรับกลุ่มร้านอาหารในเครือ Edo โดยเน้นการสะสมคะแนนจากยอดใช้จ่าย (Points Earned) การแบ่งระดับสมาชิก (Membership Tiering) และการแลกรับสิทธิพิเศษ เพื่อเพิ่มอัตราการกลับมาใช้บริการซ้ำ และสร้างฐานลูกค้าที่เหนียวแน่น

## Tech Stack
* **Framework:** Laravel 5.7 (PHP)
* **Database:** MySQL
* **Frontend:** Bootstrap, jQuery
* **Key Features:** * Member Digital Card (บัตรสมาชิกดิจิทัล)
    * Real-time Point Accumulation (ระบบสะสมแต้มแบบเรียลไทม์)
    * Reward & Coupon Redemption (ระบบแลกของรางวัลและคูปองส่วนลด)
    * Promotion Broadcast Integration (ระบบจัดการโปรโมชันเฉพาะบุคคล)

## Key Features & Business Logic

* **Dynamic Point Calculation:** ระบบคำนวณคะแนนสะสมที่ยืดหยุ่น
* **Tiered Rewards Logic:** ออกแบบระบบระดับสมาชิก (Silver, Gold, Platinum) ที่มีสิทธิประโยชน์แตกต่างกันตามยอดใช้จ่ายสะสม ช่วยกระตุ้นยอดขายต่อบิล (Average Ticket Size)
* **E-Coupon & Voucher Management:** ระบบจัดการคูปองส่วนลดดิจิทัลที่ลูกค้าสามารถกดแลกและนำไปใช้หน้าสาขาได้ทันที พร้อมระบบตรวจสอบการใช้งานซ้ำเพื่อความปลอดภัย
* **Comprehensive Member Dashboard:** หน้าโปรไฟล์ที่แสดงประวัติการเข้าใช้บริการ (Dining History) คะแนนคงเหลือ และสิทธิพิเศษที่ได้รับ เพื่อสร้างประสบการณ์เฉพาะบุคคล (Personalized Experience)

## Technical Achievements
* **Transactional Integrity:** จัดการระบบแต้มและคูปองด้วย Database Transactions เพื่อให้มั่นใจว่าการเพิ่ม/ลดคะแนนมีความถูกต้อง 100% แม้มีการใช้งานพร้อมกันหลายสาขา

## Project Preview

**Live Website:** [www.edoplus.com](https://www.edoplus.com)
---
