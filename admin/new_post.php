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
        $query_category="SELECT * FROM categoris";
        $categoris= $db->query($query_category);

        if(isset($_POST['add_post'])){
            if($_POST['title'] != "" && $_POST['author'] != "" && $_POST['category_id'] != "" && $_POST['body'] != "" && $_FILES['image']['name'] != ""){

                $title=$_POST['title'];
                $author=$_POST['author'];
                $category_id=$_POST['category_id'];
                $body=$_POST['body'];

                $name_image = $_FILES['image']['name'];
                $tmp_name = $_FILES['image']['tmp_name'];
                if (move_uploaded_file($tmp_name, "../uploads/img/$name_image")) {
                    echo "Upload Success";
                } else {
                    echo "Upload Error";
                }

                $query_post=$db->prepare("INSERT INTO posts(title , author , category_id , body , image) VALUES (:title , :author , :category_id , :body , :image)");
                $query_post->execute(['title'=>$title , 'author'=>$author , 'category_id'=>$category_id , 'body'=>$body , 'image'=>$name_image]);
                    header("location:post.php");
            }else{
            header("location:new_post.php?err_msg=تمام فیلدها باید پرشود");
            exit();
        }
    }
    ?>


    <div class="container-fluid">
        <div class="row">

            <!-- Sidebar -->
            <?php include("./includes/sidebare.php"); ?>

            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">

                <div class="d-flex justify-content-between mt-5">
                    <h3>ایجاد مقاله</h3>
                </div>

                <?php 
                    if(isset($_GET['err_msg'])){
                        ?>
                        <div class="alert alert-danger">
                            <?php 
                                echo $_GET['err_msg'];
                            ?>
                        </div>
                    <?php
                    }
                ?>

                <hr>

                <form method="post" class="mb-5" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="category">عنوان : </label>
                        <input type="text" class="form-control" name="title" id="title">
                        <small class="form-text text-muted">نام مقاله را وارد کنید.</small>
                    </div>
                    <div class="form-group">
                        <label for="author">نویسنده : </label>
                        <input type="text" class="form-control" name="author" id="author">
                        <small class="form-text text-muted">نام نویسنده را وارد کنید.</small>
                    </div>
                    <div class="form-group">
                        <label for="category_id">دسته بندی : </label>
                        <select class="form-control" name="category_id" id="category_id">
                            <?php 
                                if($categoris->rowCount() >0){
                                    foreach($categoris as $category){
                                ?>
                                <option value="1"> <?php echo $category['title'] ?> </option>

                            <?php
                                    }
                                }
                            ?>
                            
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="category">متن مقاله : </label>
                        <textarea class="form-control" name="body" id="body" rows="3"></textarea>
                        <small class="form-text text-muted">متن مقاله را وارد کنید.</small>
                    </div>

                    <div class="form-group">
                        <label for="author">تصویر : </label>
                        <input type="file" class="form-control" name="image" id="image">
                        <small class="form-text text-muted">تصویر مقاله را وارد کنید.</small>
                    </div>

                    <button type="submit" name="add_post" class="btn btn-outline-primary">ایجاد</button>
                </form>

            </main>

        </div>

    </div>

</body>
<script src="https://cdn.ckeditor.com/4.12.1/standard/ckeditor.js"></script>

<script>
    CKEDITOR.replace('body');
</script>

</html>