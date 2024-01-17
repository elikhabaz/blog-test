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
    <?php include("./includes/header.php"); ?>


    <div class="container-fluid">
        <div class="row">

            <!-- Sidebar -->
            <?php include("./includes/sidebare.php"); 
                $query_posts= "SELECT * FROM posts ORDER BY id DESC";
                $posts= $db->query($query_posts);
            ?>


            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">

                <div class="d-flex justify-content-between mt-5">
                    <h3>مقالات</h3>
                    <a href="new_post.php" class="btn btn-outline-primary">ایجاد مقاله</a>
                </div>

                <div class="table-responsive">
                    <form action="post">
                        <table class="table table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>عنوان</th>
                                    <th>نویسنده</th>
                                    <th>دسته بندی</th>
                                    <th>تنظیمات</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    if($posts->rowCount() > 0){
                                        foreach($posts as $post){
                                    ?>
                                    <tr>
                                    <td><?php echo $post['id'] ?></td>
                                    <td> <?php echo $post['title'] ?> </td>
                                    <td> <?php echo $post['author'] ?></td>
                                    <td> <?php echo $post['category_id'] ?></td>
                                    <td>
                                        <a href="edit_post.php" class=" btn btn-outline-info">ویرایش</a>
                                        <a href="#" class=" btn btn-outline-danger">حذف</a>
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