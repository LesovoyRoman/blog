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
    <title>Update</title>
</head>
<body style="background: url('black-linen.png') repeat">

<div class="container" style="border: 5px black dashed; border-radius: 10px; width: 100%;
        max-width: 700px; margin: 30px auto; padding: 20px;">
    <form action="update.php" method="post">
        <input type="text" name="title" placeholder="title" class="form-control">
        <textarea name="text" id="text" placeholder="text" class="form-control"></textarea>
        <input type="hidden" value="<?=$_GET['update_id'];?>" name="id">

    <a href="index.php" class="btn btn-default" style="margin: 10px 0">Cancel</a>


<script type="text/javascript">
    $(document).ready(function(){
        $('#text').summernote();
    });
</script>

    <?php
    require_once './clasess/Post/Post.php';
    session_start();
    if (isset($_SESSION['user'])) {
        if ($_SESSION['user']['login'] == 'roman') {
            echo "<button type='submit' class='btn btn-primary'>Save</button>";
        } else if($_SESSION['user']['login'] != 'roman') {
            echo "<h2 style='text-align: center'>You can't change Post</h2>";
        }
    } else {
        echo "<h2 style='text-align: center'>You can't change Post</h2>";
    }

    if(!empty($_POST) && $_SESSION['user']['login'] == 'roman')
    {
        Post::updatePost($_POST, $_POST['id']);
        header("Location: index.php");
    }
    ?>
    </form>
</div>
</body>
</html>


