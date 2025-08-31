<nav  style="background-color:rgba(217, 217, 217, 0.9); color: white; height: 70px; margin-bottom: 10px;"  >
    <ul style="height:100%; display: flex; align-items: center; gap: 30px;">
        <li style="color: #000"><a style="text-decoration: none; color: #000 " href="http://localhost/mvc/home">home</a></li>
        <li style="color: #000"><a style="text-decoration: none; color: #000 " href="http://localhost/mvc/search">search</a></li>
        <li style="color: #000"><a style="text-decoration: none; color: #000 " href="http://localhost/mvc/products">products</a></li>
        <li style="color: #000"><a style="text-decoration: none; color: #000 " href="http://localhost/mvc/register">register</a></li>
        
        <?php if ($this->check_auth()) { ?>
        <form style="margin-bottom:0px;" action="http://localhost/mvc/logout" method="post">
            <button type="submit">Logout</button>
        </form>
        <?php } else { ?>
        <form style="margin-bottom:0px;" action="http://localhost/mvc/login" method="post">
            <button type="submit">Login</button>
        </form>
        <?php } ?>
    </ul>
</nav>