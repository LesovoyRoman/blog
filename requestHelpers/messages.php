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
<style>
    body .container .list-group-item:hover{background: rgba(38, 81, 142, 0.76); color: white;}
    .nav-tabs>li.active>a, .nav-tabs>li.active>a:focus, .nav-tabs>li.active>a:hover
    {background: rgba(2, 73, 136, 0.97); color:white;}
    .nav-tabs>li>a{background: white;}
</style>
<body style="background: url('../img/black-linen.png') repeat">
    <?php

        $status = session_status();
        if($status == PHP_SESSION_NONE){
            session_start();
        }

        $_SESSION['curr_limit']++;

        if($_SESSION['lang'] == 'rus'){
            $cancel = 'На главную';
            $inbox_message = 'Входящие';
            $outbox_message = 'Исходящие';
            $create_message = 'Создать сообщение';
            $from = 'От';
            $to = 'Кому';
            $title = 'Тема';
            $text = 'Сообщение';
            $when = 'Когда';
            $limit_more = 'Ещё..';

        } else if($_SESSION['lang'] == 'eng'){
            $cancel = 'Back to main';
            $inbox_message = 'Inbox messages';
            $outbox_message = 'Outbox messages';
            $create_message = 'Create message';
            $from = 'From';
            $to = 'To';
            $title = 'Title';
            $text = 'Message';
            $when = 'When';
            $limit_more = 'More..';

        }
    ?>

    <div class="container" style="border: 5px black dashed; border-radius: 10px; width: 100%;
    max-width: 700px; margin: 30px auto; padding: 20px;">
        <ul class="nav nav-tabs" style="font-size: 18px;">
            <li class="active"><a href='#' class="inbox"><?php global $inbox_message; echo $inbox_message ?></a></li>
            <li><a href='#' class="outbox"><?php global $outbox_message; echo $outbox_message ?></a></li>
        </ul>
        
        <div class="tab-pane inbox-messages">
            <?php require_once '../clasess/Messages/Messages.php';
            $messagesIn = Messages::getMessagesInbox();

            foreach ($messagesIn as $messageIn) : ?>
            <?php

                global $from;
                global $title;
                global $when;

                $curr_login_transmitter_array = Messages::getUser($messageIn['id_transmitter']);
                $curr_login_transmitter = $curr_login_transmitter_array['login'];
                $curr_message = $messageIn['title_message'];
                $curr_time = explode(':', stristr(stristr($messageIn['time'], ' '), '.', true));
                $answer = "<a class='list-group-item' style='border:none; margin:5px 0; border-radius:5px;' role='button' href='";
                $answer .= "sendMessage.php?id_message={$messageIn['id_message']}&id_receiver={$messageIn['id_transmitter']}";
                $answer .= "'><strong>$title:</strong> $curr_message <br>
                <strong>$from:</strong> $curr_login_transmitter<br>
                <strong>$when:</strong>
                $curr_time[0]:$curr_time[1]</p></a>";
                echo $answer;
             ?>

            <?php endforeach ;?>
        </div>
        <div class="tab-pane outbox-messages" style="display:none;">
            <?php $messagesOut = Messages::getMessagesOutbox();

            foreach ($messagesOut as $messageOut) : ?>
                <?php

                global $title;
                global $to;
                global $text;
                global $when;

                $curr_message = $messageOut['title_message'];
                $curr_login_receiver_array = Messages::getUser($messageOut['id_receiver']);
                $curr_login_receiver = $curr_login_receiver_array['login'];
                $curr_text = $messageOut['text_message'];
                $curr_time = explode(':', stristr(stristr($messageOut['time'], ' '), '.', true));
                echo "
                    <p class='panel' style='border:none; margin:5px 0; border-radius:5px; padding:10px 15px;'>
                        <strong>$to:</strong>$curr_login_receiver<br>
                        <strong>$title:</strong> $curr_message<br>
                        <strong>$text:</strong> $curr_text<br>
                        <strong>$when:</strong>$curr_time[0]:$curr_time[1]
                    </p>";
                ?>

            <?php endforeach ;?>

        </div>

        <a href="<?= $_SERVER['PHP_SELF'] ;?>" class="" style="font-size:18px; display: block; text-align: center; color: #014E90; margin: 10px auto"><?php global $limit_more; echo $limit_more ?></a>
        <a href="createMessage.php" class="btn btn-primary" style="float: right;"><?php global $create_message; echo $create_message ?></a>
        <a href="../index.php" class="btn btn-default" style="float: left; margin: auto auto"><?php global $cancel; echo $cancel ?></a>
    </div>

    <script src="../js/main.js"></script>
</body>
</html>

