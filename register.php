<?php include "include/header.inc"?>
<?php include "connect.php"?>
<?php include "admin/include/functions/functions.inc";?>
<?php
    session_start();
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $hashedPassword = sha1($password);
        $fullname = $_POST['fullname'];
        $check = checkItem('username', 'user', $username);
        if ($check == 1) {
            echo "<div class='alert alert-danger'>This username is already used</div>";
            header('refresh:3;url=register.php');
        } else {
            $stmt = $con->prepare('INSERT INTO user (username,password,email,fullname,groupid,date)VALUES(?,?,?,?,0,now())');
            $stmt->execute(array($username, $hashedPassword, $email, $fullname));
            echo "<div class='alert alert-success'>Register success</div>";
            $_SESSION['fullname']=$fullname;
            $_SESSION['groupid']=0;
            header('refresh:10;url=home.php');
        }
    }
?>
<div class="register">
    <div class="container">
        <h1 class="text-center"><i class="fa fa-user">Create Account</i></h1>
        <form method="post" action="<?php $_SERVER['PHP_SELF']?>">
            <div class="form-group">
                <label for="exampleInputEmail1">username</label>
                <input type="text" class="form-control" id="exampleInputusername"
                       aria-describedby="emailHelp" placeholder="Username" name="username" required>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Email</label>
                <input type="email" class="form-control" id="exampleInputEmail1"
                       aria-describedby="emailHelp" placeholder="Email" name="email" required>
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone
                    else.
                </small>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Password</label>
                <input type="password" class="form-control" id="exampleInputpassword"
                       aria-describedby="emailHelp" placeholder="Password" name="password" required>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Fullname</label>
                <input type="text" class="form-control" id="exampleInputfullname"
                       aria-describedby="emailHelp" placeholder="Fullname" name="fullname" required>
            </div>
            <button type="submit" class="btn btn-primary">Create Account</button>
        </form>
    </div>
</div>
<?php include "include/footer.inc"?>
