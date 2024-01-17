<?php
require_once'config.php';

//     include("./config.php");
    include("./include/db.php");

    $query_category="SELECT * FROM categoris";
    $categoris=$db->query($query_category);
?>
<div class="col-md-4 mb-3">

<div class="card bg-light mb-3">
  <div class="card-body">
    <h5 class="card-title">جستجو در وبلاگ</h5>
    <form action="./search.php" method="get">
      <div class="input-group mb-3">
        <div class="input-group-prepend order-2">
          <button class="btn btn-outline-primary" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </div>
        <input name="search" type="text" class="form-control" placeholder="جستجو ...">
      </div>
    </form>
  </div>
</div>


<div class="list-group mb-3">
   
  <a href="#" class="list-group-item list-group-item-action active">
    دسته بندی ها
  </a>
  <?php 
        if($categoris->rowCount()>0){
            foreach($categoris as $category){
    ?>
  <a href="index.php?category=<?php echo $category['id'] ?>" class="list-group-item list-group-item-action">
    <?php echo $category['title'] ?>
  </a>
  
  <?php 
    }
}
  ?>
</div>


<div class="card bg-light mb-3 p-3">
  <div class="card-body">

    <?php 
      if(isset($_POST['subscribe'])){
        if($_POST['name'] != "" || $_POST['email'] != ""){
          $name= $_POST['name'];
          $email= $_POST['email'];
          //first prepare second execute
          $insert_query= $db->prepare("INSERT INTO subscribers (name , email) VALUES (:name , :email) ");
          $insert_query->execute(['name'=>$name , 'email'=>$email]);
  
          echo "مشخصات با موفقیت ثبت شد";
        }
        else{
          echo "فیلد ها نمیتوانند خالی باشند";
        }
      }
    ?>


  <!---this form doesnt any action "we used action for store data to another php file"---->
    <form method="post">
      <div class="form-group">
        <label for="name">نام</label>
        <input type="text" name="name" id="name" class="form-control" placeholder="نام خود را وارد کنید.">

      </div>
      <div class="form-group">
        <label for="email">ایمیل</label>
        <input type="email" name="email" class="form-control" id="email" placeholder="ایمیل خود را وارد کنید.">
      </div>

      <button type="submit" name="subscribe" class="btn btn-outline-primary btn-block">ارسال</button>
    </form>
  </div>
</div>

<div class="card p-3">
  <div class="card-body">
    <h3> سخن بزرگان</h2>
      <p class="text-justify">
      یک فرد موفق کسی است که می‌تواند با آجر‌هایی که دیگران به سمت او پرتاب کرده‌اند، پایه و اساس محکمی برای خود بنا کند.      </p>
  </div>
</div>

</div>