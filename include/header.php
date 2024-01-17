<?php

    include("./include/config.php");
    include("./include/db.php");
    $query="SELECT * FROM categoris";
    $categoris= $db->query($query);
?>

<nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <div class="container">
      <a class="navbar-brand order-md-2" href="index.php">TESTBLOG</a>
      <button class="navbar-toggler" data-target="#my-nav" data-toggle="collapse" aria-controls="my-nav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div id="my-nav" class="collapse navbar-collapse">
        <ul class="navbar-nav order-md-1">
            <?php
                 if($categoris->rowCount()>0){
                    foreach($categoris as $category){
            ?>
          <li class="nav-item <?php echo (isset($_GET['category']) && $category['id'] == $_GET['category']) ? "active" : "";  ?>" >
                      
            <a class="nav-link" href="index.php?category=<?php echo $category['id'] ?>" > <?php echo $category['title'] ?> </a>
          </li>

        <?php 
               }
            }
        ?>
          
        </ul>
      </div>
    </div>
  </nav>