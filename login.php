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
<body style="background: url('black-linen.png') repeat">
    <div class="container" style="border: 5px black dashed; border-radius: 10px; width: 100%;
            max-width: 700px; margin: 30px auto; padding: 20px;">
        <form action="login.php" method="post">
            <input type="text" name="login" class="form-control" value="roman">
            <input type="password" name="password" class="form-control" value="ktcjdjq">
            <button type="submit" name="submit" class="btn btn-primary" style="margin: 10px 0;">Sign in</button>
        </form>
        <a href="index.php" class="btn btn-default" style="float: right;">Main page</a>
        <a href="registr.php" class="btn btn-default" style="float: right; margin: auto 10px">Registration</a>
    </div>
</body>
</html>

<?php
require_once 'clasess/User/User.php';
if(!empty($_POST))
{
    $login = new User($_POST);
    if(!empty($login ->login())) {
        header("Location: index.php");
    }
}