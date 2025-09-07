<nav style="background-color:rgba(217, 217, 217, 0.9); color: white; height: 70px;">
    <ul style="height:100%; display: flex; align-items: center; gap: 30px;">
        <?php if (!$this->check_auth()) { ?>
            <li style="color: #000"><a style="text-decoration: none; color: #000 " href="<?= Constants::BASE_URL ?>register">register</a></li>
        <?php } ?>

        <?php if ($this->check_auth()) {
            if ($this->is_admin()) { ?>
                <li style="color: #000"><a style="text-decoration: none; color: #000 " href="<?= Constants::REDIRECT_ADMIN_URL?>">home</a></li>
            <?php  } elseif (!$this->is_admin()) { ?>
                <li style="color: #000"><a style="text-decoration: none; color: #000 " href="<?= Constants::REDIRECT_EMPLOYEE_URL?>">home</a></li>

            <?php } ?>

            <form style="margin-bottom:0px;" action="<?= Constants::BASE_URL ?>logout" method="post">
                <button type="submit">Logout</button>
            </form>
        <?php } else {
        ?>

            <li style="color: #000"><a style="text-decoration: none; color: #000 " href="<?= Constants::BASE_URL ?>login">login</a></li>
        <?php } ?>
    </ul>
</nav>