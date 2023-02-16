<?php

?>

  <div id="categories" class="categories">
      <h2 class="text-center mb-4 mt-4">categories</h2>
      <div class="boxBrand container">
        <?php
              $category =  getdb("*","category");
              echo "<ul class='cateMenu'>";
              echo "<li><a href='home.php'>All</a></li>";
              foreach($category as $cat){

                    echo "<li><a href='home.php?do=" . $cat['category'] ."&id=" . $cat['id'] ."'>" .  $cat['category'] . "</a></li>";
                
              }
              echo "</ul>";

              $id=isset($_GET['id']) && is_numeric($_GET['id']) ? intval($_GET['id']) : 0;

              $sql="";

              if(!isset($_GET['do'])){
                  $sql="";
                  
              }
              else{
                  $sql='WHERE Type=' . $id;
                    
              }
              $detCar = getdb("*","cars",$sql);
              echo "<div class='partCat'>";
               if(!empty($detCar)){
              foreach($detCar as $car){
                 ?>
                   <div class="info">
                       <img src='admin/uploads/attach/<?php echo $car['attach']; ?>'  />
                       <h3><?php echo $car['Title']; ?></h3>
                   </div>
              
                 <?php
             } 
            }else{
              echo "<div class='frB'>there is not categories</div>";
            }
         echo "</div>";
        ?>
    
      </div>
  </div>