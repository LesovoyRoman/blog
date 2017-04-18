<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="shortcut icon" href="img/favicon.png" type="image/png">
    <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>    <title>Main</title>
</head>
<body style="background: url('img/bg-strange.png')no-repeat center/cover">
<style>
    * {box-sizing: border-box;}
    li{list-style: none;}
</style>
    <?php

    require_once './clasess/Comments/Comment.php';

    // session

    $status = session_status();
    if($status == PHP_SESSION_NONE) {
        session_start();
    }
    $_SESSION['curr_limit'] = 2;

    if(!isset($_SESSION['lang'])){
        $_SESSION['lang'] = 'eng';
    }

    // language of main page
    if(isset($_GET['curr_lang'])){
        if($_GET['curr_lang'] != $_SESSION['lang']) {
            if ($_GET['curr_lang'] == 'rus') {
            $_SESSION['lang'] = 'rus';
            } else {
                $_SESSION['lang'] = 'eng';
            }
        }
    };

    // active class lang for <li>
    if($_SESSION['lang'] == 'rus'){
        $rus_lang = 'active';
        $eng_lang = '';
    } else if($_SESSION['lang'] == 'eng'){
        $rus_lang = '';
        $eng_lang = 'active';
    }
    ;?>

    <div class="container" style="width: 100%; padding: 0; position: fixed; top:0;">
        <form class="navbar-form  navbar navbar-default" role="search" style="padding: 10px; margin-top: 0;
        border-radius: 0; background: rgba(0, 0, 0, 0.73);">
            <?php

            // language laws
                $eng = 'eng';
                $rus = 'rus';

                if($_SESSION['lang'] == 'rus'){
                    $login = 'Войти';
                    $logout = 'Выйти';
                    $new_post = 'Новый пост';
                    $my_messages = 'Мои сообщения';
                    $update_post = 'Редактировать';
                    $delete_post = 'Удалить пост';
                    $admin = 'Администратор';
                    $hello_guest = 'Гость';
                    $by = 'Автор';
                    $published = 'Опубликовано';
                    $send_comment = 'Отправить';

                } else if($_SESSION['lang'] == 'eng') {
                    $login = 'login';
                    $logout = 'logout';
                    $new_post = 'New post';
                    $my_messages = 'My messages';
                    $update_post = 'Edit post';
                    $delete_post = 'Delete post';
                    $admin = 'Admin';
                    $hello_guest = 'Guest';
                    $by = 'by';
                    $published = 'Published';
                    $send_comment = 'Send';
                }

                // check of user
                if(isset($_SESSION['user'])) {
                    global $new_post;
                    global $logout;
                    global $my_messages;
                    echo "<a href='requestHelpers/logout.php' class='btn btn-default' style='float: right; margin: 0 20px;''>$logout</a>";
                    echo "<a href='requestHelpers/createPost.php' class='btn btn-default' style=''>$new_post</a>";
                    echo "<a href='requestHelpers/messages.php' class='btn btn-default' style='margin-left: 10px;'>$my_messages</a>";
                } else {
                    global $login;
                    echo "<a href = 'requestHelpers/login.php' class='btn btn-primary' style = 'float: right; margin: 0 20px;'>$login</a>";
            }

            // link with set of language
            global $eng_lang;
            global $rus_lang;
            echo "<ul class='nav-tabs tab-eng' style='font-size: 18px; float:right; border:none;''>";
                echo "<li style='margin-top: 5px' class='$eng_lang'><a class='badge' href='index.php?curr_lang={$eng}'>eng</a></li>";
                echo "<li style='margin-top: 5px' class='$rus_lang'><a class='badge' href='index.php?curr_lang={$rus}'>rus</a></li>";
            echo "</ul>";

            ?>

            <?php

            // check user admin or not
            if(isset($_SESSION['user'])){
                if($_SESSION['user']['login'] == 'roman') {
                    global $admin;
                    echo "<h3 class='navbar-text' style='margin-top:5px;'>$admin<span class='badge' style='margin-left: 5px;'>&#x2654;</span></h3>";
                } else if($_SESSION['user']['login'] != 'roman'){?>
            <h3 class='navbar-text' style='margin-top:5px;'><?php echo $_SESSION['user']['login'];}} else {
                    global $hello_guest;
                    echo "<h3 class='navbar-text' style='margin-top:5px;'>$hello_guest</h3>";
            } ?></h3>
        </form>
    </div>

    <?php require_once './clasess/Post/Post.php'; $posts = Post::getPosts();?>
    <?php foreach ($posts as $post) :?>
        <?php $time =  explode(' ', stristr($post['time'],  '.', true));
        $time_days = $time[0];
        $time_hours_minutes = explode(":", $time[1])?>

        <div class="container" style="border: 5px black solid; border-radius: 10px; width: 100%;
        max-width: 600px; margin: 80px auto; padding: 20px; background:black;">
                <div class="thumbnail" style="background:#A7A5A5;">
                    <div class="caption" style="background: white;">
                        <h3 style="text-transform: uppercase; margin-top: 10px; color: black;"><?= $post['title'] ;?></h3>
                    </div>
                </div>

                        <p class="content-post" style="width: 100%; font-size: 24px;"><?= $post['text'] ;?></p>

                    <div class="panel-footer" style="background:transparent; color: black ;">
                        <p class="text-left" style="font-weight: bold; float: left; color:white !important;"><?php global $by; echo $by.": ".$post['author'] ;?></p>
                        <p class="text-right" style="font-weight: bold; color:white !important;"><?php  global $published; echo $published.": ".$time_days."<br>".$time_hours_minutes[0].":".$time_hours_minutes[1]?></p>
                    </div>
                        <div>
                            <?php
                            require_once './clasess/Likes/Likes.php';
                            $likes = Like::getLikes($post['id']);

                                foreach ($likes as $like_curr) {
                                    $check_likes = Like::checkLikes($post['id']);
                                        if ($check_likes == true) {
                                            $curr_post_like = $post['id'];
                                            $like = "<a class='btn badge-like badge like$curr_post_like' style='margin:20px; background: #337ab7; margin-left:0; font-size:20px; float:left' role='button' href='";
                                        } else {
                                            $curr_post_like = $post['id'];
                                            $like = "<a class='btn badge-hover badge-like badge like$curr_post_like' style='margin:20px; background:#8C8787; margin-left:0; font-size:20px; float:left' role='button' href='";
                                        }

                                    $like .= "'>❤ $like_curr[0]</a>";
                                    echo $like;
                                }

                                 if(isset($_SESSION['user'])){
                                    if ($_SESSION['user']['login'] == 'roman') {
                                        global $update_post;
                                        global $delete_post;

                                        $delete = "<a class='btn btn-primary label-danger' style='float:right; margin: 20px 0; border:none;'  role='button' href='";
                                        $delete .= "requestHelpers/delete.php?remove_id={$post["id"]}";
                                        $delete .= "'>$delete_post</a>";

                                        $update = "<a class='btn btn-primary' style='border:none; margin:20px 10px; margin-right:0; float:right;' role='button' href='";
                                        $update .= "requestHelpers/update.php?update_id={$post["id"]}";
                                        $update .= "'>$update_post</a>";

                                        echo $update;
                                        echo $delete . "<br>";

                                    }
                                }

                                $post_id_like = $post['id'];

                            $curr_comment = Comment::getComments($post['id']);

                            foreach ($curr_comment as $valueComment){
                                $commentValue = $valueComment['comment'];
                                $curr_author_comment = Comment::getUsers($valueComment['id_author']);
                                $comment_author = $curr_author_comment[0]['login'];
                                echo "<div class='comment-holder' style='background: transparent;  clear: both;'>";
                                    echo "<p class='text-left panel-comment label-info' id='comment$post_id_like' style='background:white; color:black; font-weight: bold; width:100%; font-size:16px;margin-bottom: 0; border-bottom: 2px solid rgba(43,73,129,0.72); padding-left: 10px;'>$comment_author: $commentValue</p>";
                                echo "</div>";
                            }
                             ?>
                            <?php
                            global $send_comment;
                            if (isset($_SESSION['user'])) : ?>
                                <form action="" style="margin-top: 10px;" class="form-comment">
                                    <div class="input-group" style="width: 100%; margin: 0 auto">
                                        <input type='text' name='comment' placeholder='comment' class="form-control text-comment" style="width: 80%; border-radius: 0;">
                                        <input type='submit' name='submit' value="<?= $send_comment ;?>" class="btn btn-primary submit-comment" id="<?= $post['id'] ;?>" style="width: 20%; border-radius: 0;">
                                    </div>
                                    <input class='id_post comment<?=$post['id']?>' type="text" name="id_post" value="<?= $post['id'] ;?>" hidden>
                                    <script>
                                        var id = "<?= $post['id'] ?>";
                                        $(".like<?= $post['id'] ?>").val(id);
                                        $(".comment<?=$post['id']?>").val(id);
                                    </script>
                                </form>
                            <?php endif; ?>

                        </div>
        </div>
    <?php endforeach ;?>


<?php
    if(!empty($_POST['comment']) && isset($_SESSION['user'])) {
        $comment = Comment::createComment($_POST);
        echo "";
    }

    print_r($_SESSION);

    if(!isset($_SESSION['user'])){
        echo "<script>$('.badge-like').css('pointer-events', 'none'); </script>";
    }
?>

<script src="js/main.js"></script>
</body>

</html>

