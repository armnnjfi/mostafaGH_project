<?php
if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin') { ?>
    <ul dir='rtl' style="width:10%; text-align:right; 
    align-items: center; gap: 30px;  background-color:rgba(217, 217, 217, 0.9);
     color: black; height: auto; float:right; padding:15px;">
        <li><a href="<?= Constants::BASE_URL ?>add_company" style="text-decoration: none; color:black;">ثبت شرکت جدید </a></li>
    </ul>
<?php } else if (isset($_SESSION['role']) && $_SESSION['role'] == 'employee') { ?>

    <ul dir='rtl' style="width:10%; text-align:right; 
    align-items: center; gap: 30px;  background-color:rgba(217, 217, 217, 0.9);
     color: black; height: auto; float:right; padding:15px;">
        <!-- <li><a href="http://localhost/sina%20project/mvc/project/user/dashboard" style="text-decoration: none; color:black;">داشبورد </a></li> -->
    </ul>
<?php } ?>