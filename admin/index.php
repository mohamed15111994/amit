<?php include "include/header.inc"?>
<?php include "include/functions/functions.inc";?>
<?php include "../connect.php";?>
<?php include "include/navbar.inc";?>
<h1 class="text-center">Dashboard</h1>
<div class="dashboard-panel">
    <div class="container">
        <div class="row">
            <div class="col-m-6">
                <div class="user">
                        <i class="fa fa-user fa-5x"></i>
                        <div class="data">
                            <h3>Admins</h3>
    <!--                        subtract number of admins(exception) from total number of users-->
                            <span><?php echo countItem('id','user')-itemException('groupid','user',0) ?></span>
                        </div>
                    </div>
                </div>
            <div class="col-m-6">
                <div class="users">
                    <i class="fa fa-users fa-5x"></i>
                    <div class="data">
                        <h3>Users</h3>
                        <span><?php echo countItem('id','user')-itemException('id','user',1) ?></span>
                    </div>
                </div>
            </div>
            <div class="col-m-6">
                <div class="item">
                    <i class="fa fa-tag fa-5x"></i>
                    <div class="data">
                        <h3>Items</h3>
                        <span>100</span>
                    </div>
                </div>
            </div>
    </div>
</div>

<?php include "include/footer.inc";?>

