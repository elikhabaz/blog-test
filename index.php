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
  <!-- Navbar -->
  <?php include("./include/header.php"); 
  
  //if category is exist?? on top of page in slug I want say if we select any categories show us each post if it has this category//
  if (isset($_GET['category'])) {

    $category_id = $_GET['category'];
    $posts = $db->prepare('SELECT * FROM posts WHERE category_id = :id');
    $posts->execute(['id' => $category_id]);

  } else {
    $post_query = "SELECT * FROM posts";
    $posts = $db->query($post_query);
  }
  
  ?>

  <!-- Slider -->
  <?php
  include("./include/slider.php");
  ?>

  <!-- Blogs -->
  <section class="py-3">
    <div class="container-fluid">
      <div class="row">

        <div class="col-md-8 mb-4">
          <div class="row">

            <?php
            if ($posts->rowCount() > 0) {
              foreach ($posts as $post) {
                $category_id = $post['category_id'];
                $cat_post_query = "SELECT * FROM categoris WHERE id = $category_id";
                $cat_post = $db->query($cat_post_query)->fetch();
            ?>

                <div class="col-sm-6 mt-2">
                  <div class="card">
                    <img src="./uploads/img/<?php echo $post['image'] ?>" class="card-img-top" alt="...">
                    <div class="card-body">
                      <div class="d-flex justify-content-between">
                        <h5 class="card-title"><?php echo $post['title'] ?></h5>
                        <div><span class="badge badge-secondary"> <?php echo $post['category_id'] ?> </span></div>
                      </div>
                      <p class="card-text text-justify">
                        <?php echo $post['body'] ?>
                      </p>
                      <div class="d-flex justify-content-between">
                        <a href="single.php?post=<?php echo $post['id'] ?>" class="btn btn-outline-primary stretched-link">مشاهده</a>
                        <p>نویسنده: <?php echo $post['author'] ?> </p>
                      </div>
                    </div>
                  </div>
                </div>

            <?php
              }
            }
              else{
                ?>

                <div class=btn-danger>
                  <p>نوشته ای یافت نشد</p>
                </div>

            <?php
            }
            ?>

          </div>
        </div>

        <!-- Sidebar -->
        <?php
        include("./include/sidebar.php");
        ?>

      </div>

    </div>

  </section>

  <!-- Footer -->
  <?php
  include("./include/footer.php");
  ?>

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>

</html>