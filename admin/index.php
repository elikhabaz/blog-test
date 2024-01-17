<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous" />

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous" />
    <link rel="stylesheet" href="./css/admin.css" />
    <title>TEST BLOG</title>
</head>

<body>
    <!-- Header -->
    <?php include("./includes/header.php");
    if(isset($_GET['entity']) && isset($_GET['action']) && isset($_GET['id'])){
        $entity=$_GET['entity'];
        $action=$_GET['action'];
        $id=$_GET['id'];
    }
    if ($action == "delete") {

        if ($entity == "post") {
            $query = $db->prepare('DELETE FROM posts WHERE id = :id');
        } elseif ($entity == "category") {
            $query = $db->prepare('DELETE FROM categories WHERE id = :id');
        } else {
            $query = $db->prepare('DELETE FROM comments WHERE id = :id');
        }
        
        $query->execute(['id' => $id]);

        }else{

            $query = $db->prepare("UPDATE comments SET status='1' WHERE id = :id");
            $query->execute(['id' => $id]);
        }

        $query_posts= "SELECT * FROM posts ORDER BY id DESC";

        $posts= $db->query($query_posts);

        $query_comments= "SELECT * FROM comments WHERE status='0' ";

        $comments= $db->query($query_comments);

        $query_categoris= "SELECT * FROM categoris ORDER BY id DESC";

        $categoris= $db->query($query_categoris);

    
    ?>

    <div class="container-fluid">
        <div class="row">

            <!-- Sidebar -->
           <?php include("./includes/sidebare.php"); ?>

            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">داشبورد</h1>
                </div>

                <h3>مقالات اخیر</h3>
                <div class="table-responsive">
                    <table class="table table-striped table-sm">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>عنوان</th>
                                <th>نویسنده</th>
                                <th>تنظیمات</th>
                            </tr>
                        </thead>
                        <tbody>
                                
                                <?php 
                                    if($posts->rowCount() > 0){
                                        foreach($posts as $post){
                                ?>
                                        <tr>
                                            <td>  <?php echo $post['id'] ?> </td>
                                            <td>  <?php echo $post['title'] ?> </td>
                                            <td>  <?php echo $post['author'] ?>  </td>

                                            <td>
                                            <a href="edit_post.php?id=<?php echo $post['id'] ?>" class="btn btn-outline-info">ویرایش</a>
                                            <a href="index.php?entity=post&action=delete&id=<?php echo $post['id'] ?>" class="btn btn-outline-danger">حذف</a>
                                            </td>
                                        </tr>
                                    <?php
                                        }
                                    }
                                ?>
                            
                        </tbody>
                    </table>
                </div>

                <h3>کامنت های اخیر</h3>
                <div class="table-responsive">
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
                                if($comments->rowCount() > 0){
                                    foreach($comments as $comment){
                                ?>

                                <tr>
                                <td> <?php echo $comment['id'] ?> </td>
                                <td> <?php echo $comment['name'] ?> </td>
                                <td> <?php echo $comment['comment'] ?> </td>

                                <td>
                                    <a href="index.php?entity=comment&action=approve&id=<?php echo $comment['id'] ?>" class="btn btn-outline-success">تایید</a>
                                    <a href="index.php?entity=comment&action=delete&id=<?php echo $comment['id'] ?>" class="btn btn-outline-danger">حذف</a>
                                </td>
                            </tr>

                                    <?php
                                    }
                                }
                            ?>

                        </tbody>
                    </table>
                </div>



                <h3>دسته بندی ها</h3>
                <div class="table-responsive">
                    <table class="table table-striped table-sm">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>عنوان</th>
                                <th>تنظیمات</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                if($categoris->rowCount() > 0){
                                    foreach($categoris as $category) {
                                        ?>
                                <tr>
                                    <td> <?php echo $category['id'] ?> </td>
                                    <td> <?php echo $category['title'] ?> </td>
                                    <td>
                                      <a href="edit_category.php?category=<?php echo $category['id'] ?>" class="btn btn-outline-info">ویرایش</a>
                                      <a href="index.php?entity=category?action=delete?id=<?php echo $category['id'] ?>" class="btn btn-outline-danger">حذف</a>
                                    </td>
                                </tr>

                                    <?php
                                    }
                                }
                            ?>
                            
                        </tbody>
                    </table>
                </div>

            </main>

        </div>

    </div>
    
</body>

</html>