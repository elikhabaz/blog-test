<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous" />

  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous" />
  <link rel="stylesheet" href="./css/style.css" />
  <title>Test Blog for training</title>
</head>

<body>
<?php
include("./include/header.php");

if (isset($_GET['post'])) {
    $post_id = $_GET['post'];

    $post = $db->prepare('SELECT * FROM posts WHERE id = :id');
    $post->execute(['id' => $post_id]);
    $post = $post->fetch();
}

if (isset($_POST['post_comment'])) {

    if (trim($_POST['name']) != "" || trim($_POST['comment']) != "") {

        $name = $_POST['name'];
        $comment = $_POST['comment'];

        $comment_insert = $db->prepare("INSERT INTO comments (name, comment, post_id) VALUES (:name , :comment , :post_id)");
        $comment_insert->execute(['name' => $name, 'comment' => $comment, 'post_id' => $post_id]);
        
        header("Location:single.php?post=$post_id");
        exit();
    } else {
        echo "فیلد ها نباید خالی باشند";
    }
}
?>

<section class="py-3">

    <div class="container-fluid">
        <div class="row">

            <div class="col-md-8 mb-4">
                <div class="container">
                    <?php
                    if ($post) {
                        $category_id = $post['category_id'];

                        $query_post_category = "SELECT * FROM categoris WHERE id=$category_id";

                        $post_category = $db->query($query_post_category)->fetch();

                        $post_id = $post['id'];

                        $comments = $db->prepare(" SELECT * FROM comments WHERE post_id=:id AND status='1' ");
                        $comments->execute(['id' => $post_id]);

                        ?>
                        <div class="row">

                            <div>
                                <img src="./uploads/img/<?php echo $post['image'] ?>" class="img-fluid" alt="">
                            </div>

                            <div class="p-3">

                                <div class="d-flex align-items-center">
                                    <h2><?php echo $post['title'] ?></h2>
                                    <div class="mr-2">
                                        <span class="badge badge-secondary"><?php echo $post_category['title'] ?></span>
                                    </div>
                                </div>
                                <p class="text-justify">
                                    <?php echo $post['body'] ?>
                                </p>

                                <p> نویسنده : <?php echo $post['author'] ?> </p>
                            </div>

                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-12">

                                <form method="post">
                                    <div class="form-group">
                                        <label for="name">نام</label>
                                        <input type="name" name="name" class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <label for="comment">متن کامنت</label>
                                        <textarea name="comment" class="form-control" rows="5"></textarea>
                                    </div>

                                    <button type="submit" name="post_comment" class="btn btn-outline-primary">ارسال</button>
                                </form>
                                
                            </div>
                        </div>
                        <hr>
                        <div class="row p-md-3">

                            <p>تعداد کامنت : <?php echo $comments->rowCount() ?></p>
                            <?php
                                if ($comments->rowCount() > 0) {
                                    foreach ($comments as $comment) {
                                        ?>
                                    <div class="col-12 mb-3">

                                        <div class="card bg-light">

                                            <div class="card-body">
                                                <div class="d-flex align-items-center">
                                                    <img src="./img/boy.svg" width="70" height="70" class="rounded-circle" alt="Cinque Terre">

                                                    <div class="mr-3">
                                                        <h5 class="card-title"> <?php echo $comment['name'] ?> </h5>
                                                    </div>
                                                </div>

                                                <p class="card-text pt-3 pr-3">
                                                    <?php echo $comment['comment'] ?>
                                                </p>

                                            </div>
                                        </div>
                                    </div>
                            <?php
                                    }
                                }
                                ?>

                        </div>

                    <?php
                    } else {
                        ?>
                        <div class="alert alert-danger" role="alert">
                            مقاله مورد نظر پیدا نشد!!!!!
                        </div>
                    <?php
                    }
                    ?>

                </div>

            </div>

            <?php include("./include/sidebar.php") ?>

        </div>

    </div>

</section>

<?php include("./include/footer.php") ?>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>

</html>