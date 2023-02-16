

<div class="ourCars">
    <h2 class="text-center mb-5">Feature Cars</h2>
    <div class="boxCar container">
       <?php
            $cars =  getdb("*","cars");
             if(!empty($cars)){
            foreach($cars as $car){
               echo '<a class="" href="Detail.php?do=view&id=' . $car['id'] .'">';
               ?>
   
                  <div class="infocar">
                
                        <img src="admin/uploads/attach/<?php echo $car['attach']?>"  />

                        <div class="a">
                       <div class="dtil">
                        <?php
                           echo "<span>Model : </span>";
                           echo "<p>" . $car['Brand']  .  "</p>";
                           
                        ?>      
                       </div>
                       <div class="dtil">
                        <?php
                              echo "<span>Fuel : </span>";
                              echo "<p>" . $car['fuel']  .  "</p>";
                           ?>
                       </div>
                       <div class="dtil">
                        <?php
                              echo "<span>Engine : </span>";
                              echo "<p>" . $car['engine']  .  "</p>";
                           ?>
                       </div>
                       <div class="dtil">
                        <?php
                              echo "<span>color : </span>";
                              echo "<p>" . $car['color']  .  "</p>";
                           ?>
                       </div>
                       <div class="dtil">
                        <?php
                              echo "<span>price : </span>";
                              echo "<p>" . $car['price']  .  "</p>";
                           ?>
                       </div>
            </div>
                  </div>
    
               <?php
echo "</a>";
            }
         }else{
            echo "<div class='frc'>there is not cars</div>";
          }
       ?>
    </div>
</div>