<?php
    session_start();
    if(isset($_SESSION['username'])) {
        include "include/header.inc";
        include "include/navbar.inc";
        include "../connect.php";
        include "include/functions/functions.inc";

        $do = '';
        if (isset($_GET['do'])) {
            $do = $_GET['do'];
        } else {
            $do = 'manage';
        }
        if ($do == 'manage') {
            $stmt = $con->prepare('SELECT * FROM user WHERE groupid = 0');
            $stmt->execute();
            $rows = $stmt->fetchAll();
            ?>
            <h1 class="text-center">members</h1>
            <div class="container">
                <div class="table-responsive text-center">
                    <table class="main-table table table-bordered">
                        <tr>
                            <td>Username</td>
                            <td>Email</td>
                            <td>Fullname</td>
                            <td>Register Date</td>
                            <td>Control</td>
                        </tr>
                        <?php foreach ($rows as $row) {
                            echo "<tr>";
                            echo "<td>" . $row['username'] . "</td>";
                            echo "<td>" . $row['email'] . "</td>";
                            echo "<td>" . $row['fullname'] . "</td>";
                            echo "<td>" . $row['date'] . "</td>";
                            echo "<td>
                                <a class='btn btn-info' href='members.php?do=edit&userid=" . $row['id'] . "'>update</a>
                                <a class='btn btn-danger' href='members.php?do=check_delete&userid=" . $row['id'] ."&fullname=".$row['fullname']."'>delete</a>
                            </td>";
                        }
                        ?>
                    </table>
                </div>
                <a class="btn btn-primary" href="members.php?do=add"><i class="fa fa-user"></i>add</a>
            </div>
            <?php
        } elseif ($do == 'add') {
            ?>
            <div class="add-user">
                <div class="container">
                    <h1 class="text-center"><i class="fa fa-user"> Add Member</i></h1>
                    <form method="post" action="members.php?do=insert">
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
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input check" id="exampleCheck1" value="false" name="check_admin">
                            <label class="form-check-label" for="exampleCheck1">Add as admin</label>
                        </div>
                        <br>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
            <?php
        } elseif ($do == 'insert') {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $isAdmin = $_POST['check_admin'];
                $username = $_POST['username'];
                $email = $_POST['email'];
                $password = $_POST['password'];
                $hashedPassword = sha1($password);
                $fullname = $_POST['fullname'];
                $check = checkItem('username', 'user', $username);
                if ($check == 1) {
                    echo "<div class='alert alert-danger'>This username is already used</div>";
                    header('refresh:1;url=members.php?do=add');
                } else {
                    if($isAdmin=='true'){
                        $stmt = $con->prepare('INSERT INTO user (username,password,email,fullname,groupid,date)VALUES(?,?,?,?,1,now())');
                        $stmt->execute(array($username, $hashedPassword, $email, $fullname));
                        $count = $stmt->rowCount();
                        echo "<div class='alert alert-success'>" . $count . " Member added</div>";
                        header('refresh:1;url=members.php');
                    }else{
                        $stmt = $con->prepare('INSERT INTO user (username,password,email,fullname,groupid,date)VALUES(?,?,?,?,0,now())');
                        $stmt->execute(array($username, $hashedPassword, $email, $fullname));
                        $count = $stmt->rowCount();
                        echo "<div class='alert alert-success'>" . $count . " Member added</div>";
                        header('refresh:1;url=members.php');
                    }
                }
            } else {
                header('location:members.php');
            }
        } elseif ($do == 'edit') {
            $userid = isset($_GET['userid']) && is_numeric($_GET['userid']) ? intval($_GET['userid']) : 0;
            $stmt = $con->prepare('SELECT * FROM user WHERE id = ?');
            $stmt->execute(array($userid));
            $row = $stmt->fetch();
            $count = $stmt->rowCount();
            if ($count > 0) {
                ?>
                <div class="edit-user">
                    <div class="container">
                        <h1 class="text-center"><i class="fa fa-user"> Edit Member</i></h1>
                        <form method="post" action="members.php?do=update">
                            <div class="form-group">
                                <input type="hidden" class="form-control" id="exampleInputusername" name="member-id"
                                       value="<?php echo $row['id'] ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">username</label>
                                <input type="text" class="form-control" id="exampleInputusername"
                                       aria-describedby="emailHelp" placeholder="Username" name="member-username"
                                       value="<?php echo $row['username'] ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email</label>
                                <input type="email" class="form-control" id="exampleInputEmail1"
                                       aria-describedby="emailHelp" placeholder="Email" name="member-email"
                                       value="<?php echo $row['email'] ?>" required>
                                <small id="emailHelp" class="form-text text-muted">We'll never share your email with
                                    anyone else.
                                </small>
                            </div>
                            <div class="form-group">
                                <input type="hidden" class="form-control" id="exampleInputpassword"
                                       aria-describedby="emailHelp" placeholder="Password" name="old-password"
                                       value="<?php echo $row['password'] ?>" >
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Password</label>
                                <input type="password" class="form-control" id="exampleInputpassword"
                                       aria-describedby="emailHelp" placeholder="Password" name="new-password">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Fullname</label>
                                <input type="text" class="form-control" id="exampleInputfullname"
                                       aria-describedby="emailHelp" placeholder="Fullname" name="member-fullname"
                                       value="<?php echo $row['fullname'] ?>" required>
                            </div>
                            <button type="submit" href="members.php?do=update" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
                <?php
            } else {
                header('location:members.php');
            }
        } elseif ($do == 'update') {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $member_id = $_POST['member-id'];
                $member_username = $_POST['member-username'];
                $member_email = $_POST['member-email'];
                $member_fullname = $_POST['member-fullname'];
                $member_pass=empty($_POST['new-password'])?$_POST['old-password']:sha1($_POST['new-password']);
                $stmt = $con->prepare('UPDATE user SET username=? ,password=? ,email=? ,fullname=? WHERE id=?');
                $stmt->execute(array($member_username,$member_pass,$member_email,$member_fullname,$member_id));
                $count = $stmt->rowCount();
                echo "<div class='alert alert-success'>" . $count . " Member updated</div>";
            } else {
                header('location:member.php');
            }
        }
        elseif ($do == 'check_delete'){
            $delete_fullName='';
            $userid = isset($_GET['userid']) && is_numeric($_GET['userid']) ? intval($_GET['userid']) : 0;
            $delete_fullName=$_GET['fullname'];
            echo "<div class='alert alert-danger'>Do you want to remove ".$delete_fullName."?
                    <a class='btn btn-primary' href='members.php?do=delete&userid=".$userid."'>Remove member</a>
                    <a class='btn btn-primary' href='members.php'>Cancel</a>
            </div>";
        }
        elseif ($do == 'delete'){
            $userid = isset($_GET['userid']) && is_numeric($_GET['userid']) ? intval($_GET['userid']) : 0;
            echo "<div class='alert alert-success'>" . deleteItem('id','user',$userid) . " Member deleted</div>";
            header( "refresh:2;url=members.php");
        }
    }
    include "include/footer.inc";
?>