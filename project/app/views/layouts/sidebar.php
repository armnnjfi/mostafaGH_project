<?php
if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin') { ?>
    <ul dir='rtl' style="width:10%; text-align:right; 
    align-items: center; gap: 30px;  background-color:rgba(217, 217, 217, 0.9);
     color: black; height: auto; float:right; padding:15px;">
        <li><a href="http://localhost/sina%20project/mvc/project/admin/requests" style="text-decoration: none; color:black;">درخواست ها</a></li>
        <li><a href="http://localhost/sina%20project/mvc/project/admin/userList" style="text-decoration: none; color:black;">لیست کاربر ها</a></li>
        <li><a href="http://localhost/sina%20project/mvc/project/admin/manageClasses" style="text-decoration: none; color:black;">مدیریت ترم و درس ها</a></li>
    </ul>
<?php } else if(isset($_SESSION['role']) && $_SESSION['role'] == 'user'){ ?>

    <ul dir='rtl' style="width:10%; text-align:right; 
    align-items: center; gap: 30px;  background-color:rgba(217, 217, 217, 0.9);
     color: black; height: auto; float:right; padding:15px;">
        <li><a href="http://localhost/sina%20project/mvc/project/user/dashboard" style="text-decoration: none; color:black;">داشبورد </a></li>
        <li><a href="http://localhost/sina%20project/mvc/project/user/request/new" style="text-decoration: none; color:black;">ثبت درخواست</a></li>
    </ul>
<?php } ?>  