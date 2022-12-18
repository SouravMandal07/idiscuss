<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>iDiscuss - Coding Forum</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <!-- <style>
        #ques {
            min-height: 500px;
        }
    </style> -->
</head>

<body>
    <?php
    include 'partials/_header.php'
    ?>
    <?php
    include 'partials/_dbconnect.php'
    ?>

    <?php
    $id = $_GET['threadid'];
    $sql = "SELECT * FROM `threads` WHERE thread_cat_id=$id";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $title = $row['thread_title'];
        $desc = $row['thread_desc'];
    }
    ?>

    <!--Start Add comment  -->

    <?php
        $id = $_GET['threadid'];
        $method = $_SERVER['REQUEST_METHOD'];
        $showAlert = false;
        if($method == 'POST'){
            
            $comment = $_POST['comment'];
            
            $sql = "INSERT INTO `comments` (`comment_content`, `thread_id`, `comment_by`, `comment_time`) VALUES ('$comment', '$id', '0', current_timestamp());
            ";

            $result = mysqli_query($conn, $sql);
            $showAlert = true;
            if($showAlert){
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> Your comment has been added. 
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
            }


        }
    ?>

    <!-- End Add comment  -->

    <div class="container my-4">
        <div class="jumbotron">
            <h1 class="display-4"><?php echo $title; ?></h1>
            <p class="lead"><?php echo $desc; ?> </p>
            <hr class="my-2">
            <p>This is a peer to peer forum for sharing knowledge with each other. Keep it friendly. Be courteous and respectful. Appreciate that others may have an opinion different from yours.Stay on topic. Share your knowledge. Refrain from demeaning, discriminatory, or harassing behaviour and speech.</p>
            <p> Posted by:<b> Sourav </b></p>
        </div>

    </div>

    <div class="container">
        <h1 class="py-3">Post a Comment</h1>


        <form action="<?php 'REQUEST_URI' ?>" method="post">

            <div class="form-group">
                <label for="exampleFormControlTextarea1">Type your Comment</label>
                <textarea class="form-control" id="comment" name="comment" rows="3"></textarea>
            </div>

            <button type="submit" class="btn btn-success mb-2">Post Comment</button>
        </form>

    </div>

    <div class="container py-2">
        <h1>Discussion</h1>


        <?php
        $id = $_GET['threadid'];
        $sql = "SELECT * FROM `comments` WHERE thread_id=$id;";
        $result = mysqli_query($conn, $sql);
        $noResult = true;
        while ($row = mysqli_fetch_assoc($result)) {
            $noResult = false;
            $id = $row['comment_id'];
            $content = $row['comment_content'];
            $comment_time = $row['comment_time'];
            echo
            ' <div class="media my-3">
                <img src="img/userdefault.png" class="mr-3" width="50px" alt="...">
                <div class="media-body ">
                <p class="font-weight-bold my-0">Anonymous User at ' . $comment_time . '</p>
                 
                 ' . $content . '
                </div>
              </div>';
        }
        if ($noResult) {

            echo ' <div class="jumbotron jumbotron-fluid">
                  <div class="container">
                    <p class="display-4">No Result Found</p>
                     <p class="lead">Be the first one to ask a question.</p>
                  </div>
                </div>';
        }

        ?>

    </div>


    <?php include 'partials/_footer.php' ?>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
</body>

</html>