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
    <title>Login</title>
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
            $registration = 'Регистрация';
            $sign = 'Войти';
        } else if($_SESSION['lang'] == 'eng'){
            $page_posts = 'Main page';
            $registration = 'Registration';
            $sign = 'Sign in';
        }
    ?>
    <div class="container" style="border: 5px black dashed; border-radius: 10px; width: 100%;
            max-width: 700px; margin: 30px auto; padding: 20px;">
        <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
            <input type="text" name="login" class="form-control" value="roman">
            <input type="password" name="password" class="form-control" value="ktcjdjq">
            <button type="submit" name="submit" class="btn btn-primary" style="margin: 10px 0;"><?php global $sign; echo $sign;?></button>
        </form>
        <a href="../index.php" class="btn btn-default" style="float: right;"><?php global $page_posts; echo $page_posts;?></a>
        <a href="registr.php" class="btn btn-default" style="float: right; margin: auto 10px"><?php global $registration; echo $registration;?></a>
    </div>
</body>
</html>

<?php
require_once '../clasess/User/User.php';
if(!empty($_POST))
{
    $login = new User($_POST);
    $login->login();
    header("Location: ../index.php");

}