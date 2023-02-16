<?php


?>

<div id="Brands" class="ourBrands">
    <h2 class="text-center mb-4">Our Brands</h2>
    <div class="boxBrand container">
       <?php
            $brands =  getdb("*","brands");
              if(!empty($brands)){
            foreach($brands as $brand){
               ?>
                  <div class="brand">
                        <img src="admin/uploads/attach/<?php echo $brand['image']?>"  />
                        <h3><?php echo $brand['brand'];  ?></h3>
                  </div>
               <?php
            }
         } else{
            echo "<div class='frB'>there is not Brands</div>";
         }
       ?>
    </div>
</div>