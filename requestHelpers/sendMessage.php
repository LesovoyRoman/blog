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
        <?php
        require_once '../clasess/Messages/Messages.php';

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
            $from = 'От';
            $title = 'Тема';
            $text = 'Сообщение';
            $when = 'Когда';
            $header_message = 'Сообщение';
            $send_to = 'Отправить сообщение к';

        } else if($_SESSION['lang'] == 'eng'){
            $cancel = 'Cancel';
            $send = 'Send message';
            $from = 'From';
            $title = 'Title';
            $text = 'Message';
            $when = 'When';
            $header_message = 'Message';
            $send_to = 'Send message to';

        }
            $messages_to = Messages::getMessage($_GET['id_message']);
            foreach ($messages_to as $message_to) {

                   $message_title = $message_to['title_message'];
                   $message_text = $message_to['text_message'];
                   $curr_login_receiver_array = Messages::getUser($message_to['id_transmitter']);
                   $curr_login_receiver = $curr_login_receiver_array['login'];
                   $time = explode(':', stristr(stristr($message_to['time'], ' '), '.', true));

                   global $from;
                   global $title;
                   global $text;
                   global $when;
                   global $header_message;

                   echo "
                    <div class='panel' style='border:none; margin:5px 0; border-radius:5px; padding:10px 15px;'>
                    <h2>$header_message:</h2>
                        <strong>$title:</strong> $message_title </br>
                        <strong>$text:</strong> $message_text </br>
                        <strong>$from:</strong> $curr_login_receiver </br>
                        <strong>$when:</strong> $time[0]:$time[1] 
                    </div>";
                    }
             ?>
    <br>
    <h3 class=""><?php global $send_to; echo $send_to.": ";
    $curr_login_receiver_array = Messages::getUser($_GET['id_receiver']);
    $curr_login_receiver = $curr_login_receiver_array['login'];
    echo $curr_login_receiver;?></h3>
    <form action="<?= $_SERVER['PHP_SELF'] ;?>" method="post">
        <input type="text" name="title" class="form-control" style="margin-bottom: 5px" placeholder="title">
        <textarea name="message" class="form-control" placeholder="message" style="resize: none;"></textarea>
        <button type="submit" name="submit" class="btn btn-primary" style="margin: 10px 0;"><?php global $send; echo $send;?></button>
        <input type="text" value="<?= $_GET['id_receiver'] ;?>" name="receiver_id" hidden>
    </form>
    <a href="messages.php" class="btn btn-default" style="float: right; margin: auto auto"><?php global $cancel; echo $cancel;?></a>
</div>
</body>
</html>

<?php

require_once '../clasess/User/User.php';

    if (!empty($_POST['message'])) {
        User::createMessage($_POST);
    }




