<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
    <div class="container">
        <a class="navbar-brand" href="home.php">SUMA</a>
        <ul class="navbar-nav">
            <li class="nav-item">
                <?php 
                if($_SESSION['user']['level'] == "Admin")
                {
                ?>
                    <a class="nav-link" href="adminMenu.php">Admin Menu</a>
                    <?php
                }else{
                    ?>
                    <a class="nav-link" href="pengaturanAkun.php">Akun</a>
                <?php
                }
                ?>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#logoutModal">Logout</a>
            </li>
        </ul>
    </div>
</nav>