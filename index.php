<?php include "include/header.inc"?>
<?php include "connect.php"?>
<?php
   session_start();
     if($_SERVER['REQUEST_METHOD'] == 'POST'){
          $username   = $_POST['user'];
          $password   =$_POST['pass'];
          $inPassword = sha1($password); //inPassword -> this var to incyrpte password
         //check if user is exist
         $stmt=$con ->prepare('SELECT * FROM `user` WHERE username=? AND password=? LIMIT 1');
         $stmt->execute(array($username,$inPassword));
         $row= $stmt->fetch();
         $count=$stmt->rowCount();
         if ($count > 0){
             $_SESSION['username']=$username; // Register ssesion name
             $_SESSION['userid']=$row['id'];  // Register session ID
             $_SESSION['fullname']=$row['fullname'];
             $_SESSION['groupid']=$row['groupid'];
             header('location:home.php');
         }
     }
?>

<div class="login-form">
    <div class="container members">
        <form method="post" action="<?php $_SERVER['PHP_SELF']?>">
            <div class="form-group">
                <label for="exampleInputEmail1">Username</label>
                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="user" placeholder="Username">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" class="form-control" id="exampleInputPassword1" name="pass" placeholder="Password">
            </div>
            <button type="submit" class="btn btn-primary login-btn">Login</button>
            <a href="register.php">Don't have account ? Register here</a>
        </form>
    </div>
</div>


<?php include "include/footer.inc"?>
