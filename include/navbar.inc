<?php session_start();?>

<nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-transparent">
    <a class="navbar-brand" href="#">AMIT</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item item-about">
                <a class="nav-link" href="#" data-scroll="about">about</a>
            </li>
            <li class="nav-item item-services">
                <a class="nav-link" href="#" data-scroll="services">services</a>
            </li>
            <li class="nav-item item-portfolio">
                <a class="nav-link" href="#" data-scroll="portfolio">portfolio</a>
            </li>
            <li class="nav-item item-contact">
                <a class="nav-link" href="contact.php" data-scroll="contact">contact</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <?php
                    echo $_SESSION['fullname']
                    ?>
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <?php if ($_SESSION['groupid']==1){
                        echo '<a class="dropdown-item" href="admin/index.php">Dashboard</a>';
                    }else{
                        echo '<a class="dropdown-item disabled" href="#">Dashboard</a>';
                    } ?>
                    <a class="dropdown-item" href="logout.php">logout</a>
                </div>
            </li>
        </ul>
    </div>
</nav>
<!--End navbar-->