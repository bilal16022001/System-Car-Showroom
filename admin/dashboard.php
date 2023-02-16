<?php

  session_start();

  if(isset($_SESSION['name'])){
    $title="dashbord";
    include "init.php";
    include "SideBar.php";
 ?>
 
 
    <!-----start content---->
       <div class="content">
         <?php
            $titleSystem = getdb("shortName","system");
            echo "<h1>" . $titleSystem[0]['shortName'] . "</h1>";
         ?>
         <hr>
         <div class="row">
            <div class="col-md-3">
               <div class="cr">
                <div class="iconbr">
                  <a href="brands.php">
                <i class="fa-solid fa-copyright"></i>
                    </a>
                    </div>
                    <div class="">
                      <?php
                           $countBrand =  CountItem("id","brands");
                      ?>
                        All Brands
                        <span><?php echo $countBrand; ?></span>
                    </div>
               </div>
            </div>
            <div class="col-md-3">
             <div class="cr">
                <div class="iconCarT">
                  <a href="cars.php">
                <i class="fa-solid fa-list"></i>
                  </a>
                </div>
                <div class="">
                    <?php
                           $countCar =  CountItem("id","cars");
                      ?>
                        Cars Types
                        <span><?php echo $countCar; ?></span>
                </div>
             </div>
            </div>
            <div class="col-md-3">
              <div class="cr">
                <div class="iconAc">
                  <a href="cars.php?do=Available">
                      <i class="fa-solid fa-car"></i>
                  </a>
                </div>
                <div class="">
                     <?php
                           $countCar =  CountItem("id","cars","WHERE Status = 1");
                      ?>
                        Availbale Cars
                        <span><?php echo $countCar; ?></span>
                </div>
          </div>
            </div>
            <div class="col-md-3">
              <div class="cr">
                <div class="iconSo">
                <i class="fa-solid fa-car"></i>
                </div>
                <div class="">
                    Solid Cars
                    <span>0</span>
                </div>
           </div>
            </div>
       </div> 
 
    <!-----end content---->

        </div>
    </div>
  </div>

<?php 


include $tp . "/footer.php";

} 

else{
    header("Location: login.php");
}



?>