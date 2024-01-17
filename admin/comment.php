<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous" />

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous" />
    <link rel="stylesheet" href="./css/admin.css" />
    <title>TESTBLOG</title>
</head>

<body>
    <!-- Header -->
    <?php include("./includes/header.php"); 
        $comments_query="SELECT * FROM comments ORDER BY id DESC";
        $comments=$db->query($comments_query);
    ?>


    <div class="container-fluid">
        <div class="row">

            <!-- Sidebar -->
            <?php include("./includes/sidebare.php"); ?>

            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">

                <h3 class="mt-5">کامنت ها</h3>

                <div class="table-responsive">
                    <form action="post">
                        <table class="table table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>نام</th>
                                    <th>کامنت</th>
                                    <th>تنظیمات</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    if($comments->rowCount() >0){
                                        foreach($comments as $comment){
                                            ?>
                                            <tr>
                                                <td><?php echo $comment['id'] ?></td>
                                                 <td><?php echo $comment['name'] ?></td>
                                                <td><?php echo $comment['comment'] ?></td>
                                                <td>

                                                <?php 
                                                    if($comment['status']){
                                                        ?>
                                                    <a href="#" class="btn btn-success">تایید</a>
                                                    <?php 
                                                    }else{
                                                        ?>
                                                        <a href="comment.php?action=approve?id=<?php echo $comment['id'] ?>" class="btn btn-warning"> در انتظار تایید</a>

                                                        <?php
                                                    }
                                                    ?>
                                                        <a href="comment.php?action=delete?id=<?php echo $comment['id'] ?>" class="btn btn-danger"> حذف  </a>

                                                    </td>
                                            </tr>
                                        <?php
                                        }
                                    }
                                ?>
                            </tbody>

                        </table>

                    </form>

                </div>

            </main>

        </div>

    </div>

</body>

</html>