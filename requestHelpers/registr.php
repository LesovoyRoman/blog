<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.css" rel="stylesheet">
    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.js"></script>
    <script src="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.js"></script>
    <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.2/summernote.css" rel="stylesheet">
    <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.2/summernote.js"></script>
    <title>Registration</title>
</head>
<body style="background: url('../img/black-linen.png') repeat">
    <?php
    $status = session_status();
    if($status == PHP_SESSION_NONE){
        session_start();
    }
    if(!isset($_SESSION['lang'])){
        $_SESSION['lang'] = 'eng';
    }
    if($_SESSION['lang'] == 'rus'){
        $page_posts = 'Главная';
        $registration = 'Зарегистрироваться';
        $sign = 'Войти';
    } else if($_SESSION['lang'] == 'eng'){
        $page_posts = 'Main page';
        $registration = 'Registration';
        $sign = 'Sign in';
    }
    ?>
    <div class="container" style="border: 5px black dashed; border-radius: 10px; width: 100%;
            max-width: 700px; margin: 30px auto; padding: 20px;">
        <form action="<?= $_SERVER['PHP_SELF'] ;?>" method="post">
            <input type="text" name="login" value="login" class="form-control">
            <input type="email" name="email" value="email" class="form-control">
            <input type="password" name="password" value="pass" class="form-control">
            <button type="submit" name="submit" class="btn btn-primary" style="margin: 10px 0;"><?php global $registration; echo $registration;?></button>
        </form>
        <a href="login.php" class="btn btn-default" style="float: right"><?php global $sign; echo $sign;?></a>
        <a href="../index.php" class="btn btn-default" style="float: right; margin-right: 10px;"><?php global $page_posts; echo $page_posts;?></a>
    </div>
</body>
</html>


<?php
require_once '../clasess/User/User.php';
require_once '../validator.php';


if(isset($_SESSION['user']))
{
    header("Location: ../index.php");
}

if(!empty($_POST))
{
    $user = new User($_POST);
    $user->registration();
}





