<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="shortcut icon" href="../img/message.png" type="image/png">
    <script   src="https://code.jquery.com/jquery-3.2.1.js"   integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE="   crossorigin="anonymous"></script>
    <title>Messages</title>
</head>
<body style="background: url('../img/black-linen.png') repeat">
<div class="container" style="border: 5px black dashed; border-radius: 10px; width: 100%;
    max-width: 700px; margin: 30px auto; padding: 20px;">
    <form action="<?= $_SERVER['PHP_SELF'] ;?>" method="post">
        <select name="receiver_id" class="form-control" style="margin-bottom: 5px">
        <?php
        $status = session_status();
        if($status == PHP_SESSION_NONE){
            session_start();
        }
        $_SESSION['curr_limit'] = 2;

        if(!isset($_SESSION['lang'])){
            $_SESSION['lang'] = 'eng';
        }
        if($_SESSION['lang'] == 'rus'){
            $cancel = 'Назад';
            $send = 'Отправить сообщение';

        } else if($_SESSION['lang'] == 'eng'){
            $cancel = 'Cancel';
            $send = 'Send message';
        }

        require_once '../clasess/Messages/Messages.php';
            $messages_to = Messages::getUsers();
            foreach ($messages_to as $message_to)
            {
               $id = $message_to['id'];
               $login = $message_to['login'];
               echo "<option value='$id'>to: $login</option>";
            }
        ?>
        </select>
        <input type="text" name="title" class="form-control" style="margin-bottom: 5px" placeholder="title">
        <textarea name="message" class="form-control" placeholder="message" style="resize: none;"></textarea>
        <button type="submit" name="submit" class="btn btn-primary" style="margin: 10px 0;"><?php global $send; echo $send;?></button>
    </form>
    <a href="messages.php" class="btn btn-default" style="float: right; margin: auto 10px"><?php global $cancel; echo $cancel;?></a>
</div>
</body>
</html>

<?php
require_once '../clasess/User/User.php';

    if (!empty($_POST['message'])) {
        User::createMessage($_POST);
    }


