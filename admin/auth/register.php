<?php include($_SERVER['DOCUMENT_ROOT']. '/my_blog2/include/function.php'); ?>
<?php include($_SERVER['DOCUMENT_ROOT']. '/my_blog2/database/db.php'); ?>
<?php
$error_name = '';
$error_email = '';
$error_password = '';
$result = '';
if(isset($_POST['submit'])){
    $name=$_POST['name'];
    $email=$_POST['email'];
    $password=$_POST['password'];
    $enc_password = md5($password);
    if (empty($name)){
        $error_name = "Name is Required";
    }
    if (empty($email)){
        $error_email = "Email is required";
    }
    if (empty($password)){
        $error_password = "Password is Requuired";
    }
    if (empty($error_name) && empty($error_email) && empty($error_password)){
        $check_email = "SELECT * FROM users WHERE 'email' = '$email'";
        $check_result = mysqli_query($conn, $check_email);
        if (mysqli_num_rows($check_result) > 0){
            $error_email = "Email is already exist";
        }else{
            $sql= "INSERT INTO users(`name`, `email`, `password`) VALUES ('$name', '$email', '" . $enc_password . "')";
            $result= mysqli_query($conn, $sql) or die ("Failed"); 
        }
        if ($result){
            header('location: login.php');
        }
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
    <style>
        /* .red-border{
            border: 1px solid red;
        } */
        .red-color{
            color: red;
        }
    </style>

    <body>

        <div class="container">
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <div class="login-panel panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Please LogIn</h3>
                        </div>
                        <div class="panel-body">
                            <form role="form" method="post">
                                <fieldset>
                                    <div class="form-group">
                                        <input class="form-control <?= isset($error_name) ? 'red-border' :'' ?>" placeholder="name" name="name" type="name" autofocus>
                                        <p class='red-color'><?= isset($error_name)? $error_name : '' ?></p>
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control <?= isset($error_email) ? 'red-border' :'' ?>" placeholder="E-mail" name="email" type="email" autofocus>
                                        <p class='red-color'><?= isset($error_email)? $error_email : '' ?></p>
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control <?= isset($error_password) ? 'red-border' :'' ?>" placeholder="Password" name="password" type="password" value="">
                                        <p class='red-color'><?= isset($error_password)? $error_password : '' ?></p>
                                    </div>
                                    <!-- Change this to a button or input when using this as a form -->
                                    <div class="">
                                         <button type="submit" name="submit" class="btn btn-primary btn-block">Register</button>
                                    </div>
                                    <a href="login.php" class="text-center">I already have an Account</a>
                                   
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
