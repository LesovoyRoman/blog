<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <script   src="https://code.jquery.com/jquery-3.2.1.js"   integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE="   crossorigin="anonymous"></script>
    <title>Main</title>
</head>
<body style="background: url('black-linen.png') repeat">
<style>
    * {box-sizing: border-box;}
</style>
<?php session_start() ;?>
    <div class="container" style="width: 100%; padding: 0; position: fixed; top:0;">
        <form class="navbar-form  navbar navbar-default" role="search" style="padding: 10px; margin-top: 0;
        border-radius: 0; background: rgba(0, 0, 0, 0.73);">
            <?php if(isset($_SESSION['user'])) {
                    echo "<a href='logout.php' class='btn btn-default' style='float: right; margin: 0 20px;''>logout</a>";
                    echo "<a href='createPost.php' class='btn btn-default'>Create Post</a>";
                } else {
                    echo "<a href = 'login.php' class='btn btn-primary' style = 'float: right; margin: 0 20px;'>login</a>";
            } ?>
            <?php if(isset($_SESSION['user'])){
                if($_SESSION['user']['login'] == 'roman') {
                    echo "<h3 class='navbar-text' style='margin-top:5px;'>Admin<span class='badge' style='margin-left: 5px;'>&#x2654;</span></h3>";
                } else if($_SESSION['user']['login'] != 'roman'){?>
            <h3 class='navbar-text' style='margin-top:5px;'>Hello, <?php echo $_SESSION['user']['login'];}} else {
                    echo "<h3 class='navbar-text' style='margin-top:5px;'>Hello, Guest</h3>";
            } ?></h3>
        </form>
    </div>

    <?php require_once './clasess/Post/Post.php'; $posts = Post::getPosts();?>
    <?php foreach ($posts as $post) :?>
        <div class="container" style="border: 5px black dashed; border-radius: 10px; width: 100%;
        max-width: 600px; margin: 80px auto; padding: 20px;">
                <div class="thumbnail">
                    <div class="caption">
                        <h3 style="text-transform: uppercase; margin-top: 10px;"><?= $post['title'] ;?></h3>
                    </div>
                </div>

                        <p class="content-post" style="width: 100%; font-size: 24px;"><?= $post['text'] ;?></p>

                    <div class="panel-footer" style="background: #9A9A9A;">
                        <p class="text-left" style="font-weight: bold">by: <?= $post['author'] ;?></p>
                        <p class="text-right" style="font-weight: bold">Published: <?= $post['time'] ;?></p>
                    </div>
                        <div>
                            <?php
                                $delete = "<a class='btn btn-default label-danger' style='float:right; margin: 20px auto;'  role='button' href='";
                                $delete .= "delete.php?remove_id={$post["id"]}";
                                $delete .= "'>Delete Post</a>";

                                $update = "<a class='btn btn-primary' style='margin:20px 0;' role='button' href='";
                                $update.= "update.php?update_id={$post["id"]}";
                                $update.= "'>Update Post</a>";

                                echo $update;
                                echo $delete."<br>";
                                ?>
                        </div>
                    </div>


<?php endforeach ;?>
<?php print_r($_SESSION);?>
    <script src="js/main.js"></script>
</body>
</html>

