<?php  include "include/header.inc";?>
<?php include  "include/navbar.inc";?>
<?php
      if ($_SERVER['REQUEST_METHOD']=='POST'){
          $user        =$_POST['username'];
          $email      = $_POST['email'];
          $phone      = $_POST['phone'];
          $textMessage=$_POST['text-message'];
          $formError=array();
          if (strlen($user) <= 3){
                  $formError[]= "Sorry username must be more than 3 letter";
          }
          if (strlen($textMessage) < 10){
              $formError[]= "Sorry message must be more than 10 letter";
          }
          if (empty($formError)){
              /** mail(To , subject , message , headers )*/
              $headers='From: '.$email;
              mail('pierre@info.com','Contact-form',$textMessage,$headers);
              $success= "<div class='alert alert-success'>Your message recivced</div>";
          }

      }
?>
<div class="container">
    <h1 class="text-center">Contact me</h1>
    <?php
          if (isset($formError)){
              foreach ($formError as $value){
                  echo "<div class='alert alert-danger'>".$value."</div>";
              }
          }
          if (isset($success)){
              echo $success;
          }
    ?>
    <form method="post" action="<?php $_SERVER['PHP_SELF']?>">
        <div class="form-group">
            <label for="exampleInputUsername">username</label>
            <input type="text" class="form-control" id="exampleInputUsername" name="username" placeholder="Enter username">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input type="email" class="form-control" id="exampleInputEmail1" name="email" placeholder="Enter email">
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>
        <div class="form-group">
            <label for="phone">Phone Number</label>
            <input type="number" class="form-control" id="exampleInputEmail1" name="phone" placeholder="Enter phone">
        </div>
        <div class="form-group">
            <label for="exampleFormControlTextarea1">Write Your Message</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="text-message"></textarea>
            <?php
                if (isset($textMessage)){
                    textCounter($textMessage);
                }

            ?>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
<?php include  "include/footer.inc";?>
