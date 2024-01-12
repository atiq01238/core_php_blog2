<?php include($_SERVER['DOCUMENT_ROOT']. '/my_blog2/include/function.php'); ?>
<?php include($_SERVER['DOCUMENT_ROOT']. '/my_blog2/database/db.php'); ?>

<?php
        session_start();
        $successMessage = '';
        if (isset($_POST['submit'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];
        if (!empty($email) && !empty($password)) {
        $sql = "SELECT * FROM `users` WHERE email = '" . $email . "'";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            $row = mysqli_num_rows($result);
            if ($row > 0) {
                $user = mysqli_fetch_assoc($result);
                $enc_password = $user['password'];
                if (md5($password) == $enc_password) {
                $_SESSION['submit'] = true;
                $successMessage = 'Login Successfully';
                redirect('../index.php');
                } else {
                $message = 'Password is incorrect';
                }
            } else {
                $message = 'Email not found';
            }
            } else {
            $message = 'Error executing the query';
            }
        } else {
            $message = 'Email and password are required';
        }
        }
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>My Blog</title>
         <!-- Bootstrap Core CSS -->
         <link href="<?=url()?>/assets/css/bootstrap.min.css" rel="stylesheet">

        <!-- MetisMenu CSS -->
        <link href="<?=url()?>/assets/css/metisMenu.min.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="<?=url()?>/assets/css/startmin.css" rel="stylesheet">

        <!-- Custom Fonts -->
        <link href="<?=url()?>/assets/css/font-awesome.min.css" rel="stylesheet" type="text/css">

        
    </head>

    <body>

        <div class="container">
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <div class="login-panel panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Please Sign In</h3>
                        </div>
                        <?php if (!empty($successMessage)) { ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <?= $successMessage ?>
                        </div>
                        <?php } ?>
                        <?php if (isset($message)) { ?>
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <?= $message ?>
                        </div>
                        <?php } ?>
                        <div class="panel-body">
                            <form action ="" method= "post">
                                <fieldset>
                                    <div class="form-group">
                                        <input class="form-control" placeholder="E-mail" name="email" type="email" >
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control" placeholder="Password" name="password" type="password" value="">
                                    </div>
                                    <div>
                                        <button type="submit" id="submit" name="submit" class="btn btn-primary btn-block">Sign In</button>
                                        <div style="margin-top: 17px;">
                                            <a href="register.php">Register a New User</a>
                                        </div>
                                        
                                    </div>
                                    
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- jQuery -->
        <script src="<?=url()?>/assets/js/jquery.min.js"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="<?=url()?>/assets/js/bootstrap.min.js"></script>

        <!-- Metis Menu Plugin JavaScript -->
        <script src="<?=url()?>/assets/js/metisMenu.min.js"></script>

        <!-- Custom Theme JavaScript -->
        <script src="<?=url()?>/assets/js/startmin.js"></script>

    </body>
    

</html>
