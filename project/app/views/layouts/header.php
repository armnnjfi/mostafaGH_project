<nav  style="background-color:rgba(217, 217, 217, 0.9); color: white; height: 70px;"  >
    <ul style="height:100%; display: flex; align-items: center; gap: 30px;">
        <li style="color: #000"><a style="text-decoration: none; color: #000 " href="">home</a></li>
        <?php if (!$this->check_auth()) { ?>
        <li style="color: #000"><a style="text-decoration: none; color: #000 " href="<?=Constants::BASE_URL?>register">register</a></li>
        <?php } ?>
        
        <?php if ($this->check_auth()) { ?>
        <form style="margin-bottom:0px;" action="<?= Constants::BASE_URL?>logout" method="post">
            <button type="submit">Logout</button>
        </form>
        <?php } else { ?>
        <form style="margin-bottom:0px;" action="<?= Constants::BASE_URL?>login" method="post">
            <button type="submit">Login</button>
        </form>
        <?php } ?>
    </ul>
</nav>