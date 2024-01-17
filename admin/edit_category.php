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
        <?php include("./includes/sidebare.php"); ?>


        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">

            <div class="d-flex justify-content-between mt-5">
                <h3>ویرایش دسته</h3>
            </div>
            <hr>
            
            <form method="post">
                <div class="form-group">
                    <label for="category">عنوان : </label>
                    <input type="text" class="form-control" value="دسته 1" name="title" id="category">
                    <small class="form-text text-muted">نام دسته را وارد کنید.</small>
                </div>

                <button type="submit" name="edit_category" class="btn btn-outline-primary">ویرایش</button>
            </form>

        </main>

    </div>

</div>