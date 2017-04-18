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
    <link rel="shortcut icon" href="../img/post.png" type="image/png">
    <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.2/summernote.js"></script>
    <title>Create</title>
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
        $cancel = 'Назад';
        $create = 'Создать';

    } else if($_SESSION['lang'] == 'eng'){
        $cancel = 'Cancel';
        $create = 'Create';
    }

    ?>
    <div class="container" style="border: 5px black dashed; border-radius: 10px; width: 100%;
        max-width: 700px; margin: 30px auto; padding: 20px;">
        <form action="<?= $_SERVER['PHP_SELF'] ;?>" method="post">
            <input type="text" name="title" placeholder="title" class="form-control">
            <textarea name="text" placeholder="sometext" id="text"></textarea>
            <button type="submit" name="submit" role="button" class="btn btn-primary"><?php global $create; echo $create;?></button>
        </form>
        <a href="../index.php" class="btn btn-default" style="margin: 10px 0; float: right;"><?php global $cancel; echo $cancel;?></a>
    </div>

    <script type="text/javascript">
        $(document).ready(function(){
            $('#text').summernote();
        });
    </script>
</body>
</html>


<?php
require_once '../clasess/User/User.php';

if(!empty($_POST))
{
    User::createPost($_POST);
}
