<?php
if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin') { ?>
    <ul dir='rtl' style="width:10%; text-align:right; 
    align-items: center; gap: 30px;  background-color:rgba(217, 217, 217, 0.9);
     color: black; height: auto; float:right; padding:15px;">
        <li><a href="<?= Constants::BASE_URL ?>add_company" style="text-decoration: none; color:black;">ثبت شرکت جدید </a></li>
        <li><a href="<?= Constants::BASE_URL ?>employee_list" style="text-decoration: none; color:black;">لیست کارمندان بدون شرکت</a></li>
        <li><a href="<?= Constants::BASE_URL ?>leave_requests" style="text-decoration: none; color:black;">درخواست های مرخصی</a></li>
        <li><a href="<?= Constants::BASE_URL ?>Attendance_reports" style="text-decoration: none; color:black;">گزارش های ورود و خروج</a></li>
        <li><a href="<?= Constants::BASE_URL ?>reports" style="text-decoration: none; color:black;">گزارش</a></li>
    </ul>
<?php } else if (isset($_SESSION['role']) && $_SESSION['role'] == 'employee') { ?>

    <ul dir='rtl' style="width:10%; text-align:right; 
    align-items: center; gap: 30px;  background-color:rgba(217, 217, 217, 0.9);
     color: black; height: auto; float:right; padding:15px;">
     <li><a href="<?= Constants::BASE_URL ?>check_in_out" style="text-decoration: none; color:black;">ثبت ورود و خروج</a></li>
     <li><a href="<?= Constants::BASE_URL ?>leave_form" style="text-decoration: none; color:black;">درخواست مرخصی</a></li>
    </ul>
<?php } ?>