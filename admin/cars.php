<?php

  session_start();

  if(isset($_SESSION['name'])){
    $title="cars";
    include "init.php";
    
    $do = isset($_GET['do']) ? $_GET['do'] : 'Manage';

   if($do == 'Manage'){

        include "SideBar.php";  ?>
        <!-----start content---->
            <div class="content">
              <div class="back">
                    <?php

                            $stmt = $con->prepare("SELECT 
                            cars.*,category.category
                            FROM    
                            cars
                            INNER JOIN
                            category
                            ON
                            cars.Type = category.id

                            ");
                            $stmt->execute();
                            $cars = $stmt->fetchAll();
                            
                        if(!empty($cars)){ ?>

                <h2 class="text-center mb-3">List of Cars</h2>
                <div class="container">
                    <div class="table-responsive">
                        <table class="main-table text-center table table-bordered">
                            <tr>
                                 <td>#</td>
                                 <td>Date Created</td>
                                 <td>Brand</td>
                                 <td>Type</td>
                                 <td>Title</td>
                                 <td>Status</td>
                                 <td>Action</td>
                            </tr>
                            <?php

                               
                                   
                                 foreach($cars as $car){
                                    echo "<tr>";
                                       echo "<td>" . $car['id'] . "</td>";
                                       echo "<td>" . $car['Date'] . "</td>";
                                       echo "<td>" . $car['Brand'] . "</td>";
                                       echo "<td>" . $car['category'] . "</td>";
                                       echo "<td>" . $car['Title'] . "</td>";
                                       echo "<td class='statut'>";
                                         if($car['Status'] == 0){
                                            echo "not Avaibale";
                                         } else{
                                             echo "Availbale";
                                         }
                                       echo "</td>";
                                       echo "<td>";                     
                                         echo '<a class="nav-link  dropdown-toggle linkDrp" dropdown-toggle href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Action</a>';
                                       echo  '<ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                             <li><a class="dropdown-item" href="cars.php?do=view&id=' . $car['id'] .'"><i class="fa-solid fa-eye"></i>View</a></li>
                                             <li><a class="dropdown-item" href="cars.php?do=Edit&id=' . $car['id']  .'"><i class="fa-solid fa-pen-to-square"></i>Edit</a></li>
                                             <li><a class="dropdown-item" href="cars.php?do=Delete&id=' . $car['id'] .'"><i class="fa-solid fa-trash"></i>Delete</a></li>
                                          </ul>
        
                                          ';
                       
                                        echo "</td>";
                                    echo "</tr>";
                                 }
                                } else{
                                  echo "<div>there is not Brands</div>";
                                }
                            ?>
                        </table>
                    </div>
                   <a class="btn btn-primary" href="cars.php?do=Add"><i class="fa-solid fa-plus"></i> Add New Product</a>
                </div>
            </div>
        <!-----end content---->
        </div>
    </div>
    <div>
  </div>
  <?php }
  
  if($do == "Add"){ 
    include "SideBar.php";
         $stmt = $con->prepare("SELECT * FROM category");
         $stmt->execute();
         $types = $stmt->fetchAll();
      
     ?>
   <!-----start content---->
         <div class="content">
            <div class="container">
              <div class="row">
                <div class="col-md-6">
                <form class="m-auto" method="POST" action="?do=Insert" enctype="multipart/form-data">     
                      <!----start Product title---->
                      <div class="form-group form-group-lg">
                        <label class="col-sm-2 control-label">Product title</label>
                        <div class="col-sm-10 col-lg-12 pa_In">
                        <input type="text" name="Product_title" placeholder="Product title"   class="form-control" required="required"  />
                    </div>
                 </div>
                  <!----end title---->
                    <!----start Brand---->
                     <div class="form-group form-group-lg">
                        <label class="col-sm-2 control-label">Brand</label>
                        <div class="col-sm-10 col-lg-12 pa_In">
                        <input type="text" name="brand" placeholder="name of Brand"   class="form-control" required="required"  />
                    </div>
                 </div>
                  <!----end Brand---->
                   <!----start Type---->
                   <div class="form-group form-group-lg">
                        <label class="col-sm-2 control-label">Type of Car</label>
                        <div class="col-sm-10 col-lg-12 pa_In">
                        <!-- <input type="text" name="Type" placeholder="Type of Car"   class="form-control" required="required"  /> -->
                        <?php
                          echo "<select class='form-control' name='Type'>";
                            echo "<option value='0'>...</option>";
                           foreach($types as $type){
                            
                              ?>
                                  <option value="<?php echo $type['id'] ?>"><?php echo $type['category']; ?></option>
                              <?php
                           }
                           echo "</select>";
                        ?>
                    </div>
                 </div>
                  <!----end Type---->
                     <!----start Price---->
                     <div class="form-group form-group-lg">
                        <label class="col-sm-2 control-label">Price</label>
                        <div class="col-sm-10 col-lg-12 pa_In">
                        <input type="text" name="price" placeholder="Price"   class="form-control" required="required"  />
                    </div>
                 </div>
                  <!----end Price---->
                    <!----start fuel---->
                    <div class="form-group form-group-lg">
                        <label class="col-sm-2 control-label">fuel</label>
                        <div class="col-sm-10 col-lg-12 pa_In">
                        <input type="text" name="fuel" placeholder="fuel"   class="form-control" required="required"  />
                    </div>
                 </div>
                  <!----end fuel---->
                    <!----start Engine---->
                    <div class="form-group form-group-lg">
                        <label class="col-sm-2 control-label">Engine</label>
                        <div class="col-sm-10 col-lg-12 pa_In">
                        <input type="text" name="engine" placeholder="Engine"   class="form-control" required="required"  />
                    </div>
                 </div>
                  <!----end Engine---->
                    <!----start color---->
                    <div class="form-group form-group-lg">
                        <label class="col-sm-2 control-label">color</label>
                        <div class="col-sm-10 col-lg-12 pa_In">
                        <input type="text" name="color" placeholder="color"   class="form-control" required="required"  />
                    </div>
                 </div>
                  <!----end color---->
                    <!----start Product cover---->
                    <div class="form-group form-group-lg">
                        <label class="col-sm-2 control-label">Product cover</label>
                        <div class="col-sm-10 col-lg-12 pa_In">
                        <input type="file" name="attach"   class="form-control"  />
                    </div>
                 </div>
                  <!----end Product cover---->
        
                </div>
                <div class="col-md-6">
                       <!----start condition---->
                           <div class="form-group form-group-lg">
                                <label class="col-sm-2 control-label">Condition</label>
                                <div class="col-sm-10 col-lg-12 pa_In">
                                <textarea class="form-control" name="condition"></textarea>
                            </div>
                        </div>
                  <!----end condition---->
                     <!----start feature---->
                     <div class="form-group form-group-lg">
                                <label class="col-sm-2 control-label">feature</label>
                                <div class="col-sm-10 col-lg-12 pa_In">
                                <textarea  class="form-control"  name="feature"></textarea>
                            </div>
                        </div>
                  <!----end feature---->
                     <!----start Description---->
                     <div class="form-group form-group-lg">
                                <label class="col-sm-2 control-label">Description</label>
                                <div class="col-sm-10 col-lg-12 pa_In">
                                <textarea  class="form-control"  name="Description"></textarea>
                            </div>
                        </div>
                  <!----end Description---->
                </div>
                    <!----start submit---->
                    <div class="form-group form-group-lg">
                    <div class="col-sm-offset-10 col-lg-12">
                       <input type="submit" value="Add Product" class="btn btn-primary" />
                    </div>
                </div>
              <!----end submit---->
  </form>
              </div>
            </div>
            </div>
        <!-----end content---->

 <?php }


  if($do == "view"){ 
     include "SideBar.php";
     $carid = isset($_GET['id']) && is_numeric($_GET['id']) ? intval($_GET['id']) : 0;
    ?>
         <!-----start content---->
         <div class="content car">
              <div class="container">
                <?php  
                  $stmt = $con->prepare("SELECT 
                        cars.*,category.category
                        FROM    
                                  cars
                        INNER JOIN
                                  category
                        ON
                                  cars.Type = category.id
                        WHERE
                             cars.id = '$carid'                         
                                ");
                      $stmt->execute();
                      $detailCar = $stmt->fetchAll();

                  foreach($detailCar as $detail){ ?>
                       <div class="row">
                          <div class="col-md-10">
                            Car Details
                          </div>
                          <div class="col-md-2">
                            <div class="statut">
                             <?php
                                    if($detail['Status'] == 0){
                                      echo "not Avaibale";
                                  } else{
                                      echo "Availbale";
                                  }
                                ?>
                              </div>
                          </div>
                       </div>
                       <hr/>
                       <div class="row">
                          <div class="col-md-4">
                             <img src='uploads/attach/<?php echo  $detail['attach']; ?>'  />
                          </div>
                          <div class="col-md-6">
                              <div class="infoCar">
                                  <?php
                                    echo "<h1>" . $detail['Title'] . "</h1>";
                                    echo "<p>" . $detail['Brand'] . "</p>";
                                    echo "<p>" . $detail['category'] . "</p>";
                                  ?>
                              </div>
                          </div>
                        
                        </div>
                        <hr/>
                        <div class="row">
                            <div class="col-md-6">
                                <h3>Model</h3>
                                <?php echo "<span>" . $detail['Title'] . "</span>";   ?>
                                <h3>Engine</h3>
                                <?php echo "<span>" . $detail['engine'] . "</span>";   ?>
                            </div>
                            <div class="col-md-6">
                                <h3>Fuel</h3>
                                <?php echo "<span>" . $detail['fuel'] . "</span>";   ?>
                                <h3>Color</h3>
                                <?php echo "<span>" . $detail['color'] . "</span>";   ?>
                            </div>
                        </div>
                        <hr/>
                        <div class="row">
                          <div class="col-md-12">
                             <h3>Condition</h3>
                             <?php echo "<p>" . $detail['condition_car'] . "</p>";   ?>
                          </div>
                          <hr/>
                          <div class="col-md-12">
                             <h3>feature</h3>
                             <?php echo "<p>" . $detail['feature'] . "</p>";   ?>
                          </div>
                        </div>
                        <hr/>
                        <div class="edbac">
                           <a class="btn btn-primary" href="cars.php?do=Edit&id=<?php echo $detail['id']; ?>"><i class="fa-solid fa-pen-to-square"></i> Edit</a>
                           <a class="btn btn-primary" href="Cars.php"><i class="fa-sharp fa-solid fa-arrow-left"></i> back list</a>
                        </div>
                     <?php  
                  }
                 
                ?>
                
             
              </div>
            </div>
        <!-----end content---->
        </div>
    </div>
  </div>
  
  <?php }

if($do == "Insert"){ 
    include "SideBar.php";
    
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        
        $brand = $_POST['brand'];
        $type  = $_POST['Type'];
        $title = $_POST['Product_title'];
        $price = $_POST['price'];
        $fuel  = $_POST['fuel'];
        $engine = $_POST['engine'];
        $color  = $_POST['color'];

        $attachName = $_FILES['attach']['name'];
        $attachSize = $_FILES['attach']['size'];
        $attachTmp  = $_FILES['attach']['tmp_name'];
        $attachType = $_FILES['attach']['type'];

        $attachArr = explode('.', $attachName);
        $file_extention = strtolower(end($attachArr));
        $attachAllExtension = array("jpeg","png","jpg","gif","jfif");

        $condition = $_POST['condition'];
        $feature  = $_POST['feature'];
        $Description = $_POST['Description'];

        //valid form
        $arrForm = array();

        if(empty($attachName)){
            $arrForm[] = "<div class='container alert alert-danger'>image is required</div>";
        }
        if(!empty($attachName) && !in_array($file_extention,$attachAllExtension)){
            $arrForm[] = "<div class='container alert alert-danger'>not allowed this exetntion</div>"; 
        }
        if($attachSize > 4194304){     
            $arrErour[] = "<div class='container alert alert-danger'>image can't be larger <strong>4MB</strong></div>";
         }
        
         foreach($arrForm as $err){
             echo $err;
         }
         
         if(empty($arrForm)){
            $attach = rand(0,1000000) . '_' . $attachName;
            move_uploaded_file($attachTmp,"uploads\attach\\" . $attach);

            $checkItem = checkitem("*","cars","WHERE","Brand='$brand'");
            $count="";

            if($checkItem==0){
              $stmt = $con->prepare("INSERT INTO `cars`(`Date`,`Brand`,`Type`,`Title`,`Status`,`price`,`fuel`,`engine`,`color`,`attach`,`condition_car`,`feature`,`Description`) VALUES(now(),'$brand','$type','$title',0,'$price','$fuel','$engine','$color','$attach','$condition','$feature','$Description')");
              $stmt->execute();
               $count = $stmt->rowCount();
            }
            else{
              echo "<div class='content'>this cars is exit</div>";
            }
         }

    }

   ?>
        <!-----start content---->
        <div class="content">
               <?php
               if($count > 0){
                 echo "<div class='alert alert-success'>" . $count . " Record Inserted</div>";
               }
               ?>
           </div>
       <!-----end content---->
       </div>
   </div>
 </div>
 
 <?php }

  if($do == "Edit"){
      include "SideBar.php";
      $Editid = isset($_GET['id']) && is_numeric($_GET['id']) ? intval($_GET['id']) : 0;
      $detailCar = getdb("*","cars","WHERE","id =",$Editid);
      $_SESSION['editId'] = $Editid;
      $_SESSION['attach'] = $detailCar[0]['attach'];

    ?>

       <!-----start content---->
       <div class="content">
            <div class="container">
            <h1 class="text-center">Edit Product</h1>
              <div class="row">
                <div class="col-md-6">
                <form class="m-auto" method="POST" action="?do=update" enctype="multipart/form-data">     
                      <!----start Product title---->
                      <div class="form-group form-group-lg">
                        <label class="col-sm-2 control-label">Product title</label>
                        <div class="col-sm-10 col-lg-12 pa_In">
                        <input type="text" name="Product_title" placeholder="Product title" value="<?php echo $detailCar[0]['Title']; ?>"    class="form-control" required="required"  />
                    </div>
                 </div>
                  <!----end title---->
                    <!----start Brand---->
                     <div class="form-group form-group-lg">
                        <label class="col-sm-2 control-label">Brand</label>
                        <div class="col-sm-10 col-lg-12 pa_In">
                        <input type="text" name="brand" placeholder="name of Brand" value="<?php echo $detailCar[0]['Brand']; ?>"    class="form-control" required="required"  />
                    </div>
                 </div>
                  <!----end Brand---->
                   <!----start Type---->
                   <div class="form-group form-group-lg">
                        <label class="col-sm-2 control-label">Type of Car</label>
                        <div class="col-sm-10 col-lg-12 pa_In">
                        <input type="text" name="Type" placeholder="Type of Car" value="<?php echo $detailCar[0]['Type']; ?>"    class="form-control" required="required"  />
                    </div>
                 </div>
                  <!----end Type---->
                     <!----start Price---->
                     <div class="form-group form-group-lg">
                        <label class="col-sm-2 control-label">Price</label>
                        <div class="col-sm-10 col-lg-12 pa_In">
                        <input type="text" name="price" placeholder="Price" value="<?php echo $detailCar[0]['price']; ?>"    class="form-control" required="required"  />
                    </div>
                 </div>
                  <!----end Price---->
                    <!----start fuel---->
                    <div class="form-group form-group-lg">
                        <label class="col-sm-2 control-label">fuel</label>
                        <div class="col-sm-10 col-lg-12 pa_In">
                        <input type="text" name="fuel" placeholder="fuel" value="<?php echo $detailCar[0]['fuel']; ?>"    class="form-control" required="required"  />
                    </div>
                 </div>
                  <!----end fuel---->
                    <!----start Engine---->
                    <div class="form-group form-group-lg">
                        <label class="col-sm-2 control-label">Engine</label>
                        <div class="col-sm-10 col-lg-12 pa_In">
                        <input type="text" name="engine" placeholder="Engine" value="<?php echo $detailCar[0]['engine']; ?>"    class="form-control" required="required"  />
                    </div>
                 </div>
                  <!----end Engine---->
                    <!----start color---->
                    <div class="form-group form-group-lg">
                        <label class="col-sm-2 control-label">color</label>
                        <div class="col-sm-10 col-lg-12 pa_In">
                        <input type="text" name="color" placeholder="color" value="<?php echo $detailCar[0]['color']; ?>"    class="form-control" required="required"  />
                    </div>
                 </div>
                  <!----end color---->
                    <!----start Product cover---->
                    <div class="form-group form-group-lg">
                        <label class="col-sm-2 control-label">Product cover</label>
                        <div class="col-sm-10 col-lg-12 pa_In">
                        <input type="file" name="attach"   class="form-control"  />
                    </div>
                 </div>
                  <!----end Product cover---->
        
                </div>
                <div class="col-md-6">
                       <!----start condition---->
                           <div class="form-group form-group-lg">
                                <label class="col-sm-2 control-label">Condition</label>
                                <div class="col-sm-10 col-lg-12 pa_In">
                                <textarea class="form-control" name="condition"><?php echo $detailCar[0]['condition_car']; ?></textarea>
                            </div>
                        </div>
                  <!----end condition---->
                     <!----start feature---->
                     <div class="form-group form-group-lg">
                                <label class="col-sm-2 control-label">feature</label>
                                <div class="col-sm-10 col-lg-12 pa_In">
                                <textarea  class="form-control"  name="feature"><?php echo $detailCar[0]['feature']; ?></textarea>
                            </div>
                        </div>
                  <!----end feature---->
                     <!----start Description---->
                     <div class="form-group form-group-lg">
                                <label class="col-sm-2 control-label">Description</label>
                                <div class="col-sm-10 col-lg-12 pa_In">
                                <textarea  class="form-control"  name="Description"><?php echo $detailCar[0]['Description']; ?></textarea>
                            </div>
                        </div>
                  <!----end Description---->
                </div>
                    <!----start submit---->
                    <div class="form-group form-group-lg">
                    <div class="col-sm-offset-10 col-lg-12">
                       <input type="submit" value="Save Product" class="btn btn-primary" />
                    </div>
                </div>
              <!----end submit---->
            </form>
              </div>
            </div>
            </div>
        <!-----end content---->
        </div>
    </div>
  </div>
  <?php }

    if($do == "update"){
      include "SideBar.php";
     
      $brand = $_POST['brand'];
      $type  = $_POST['Type'];
      $title = $_POST['Product_title'];
      $price = $_POST['price'];
      $fuel  = $_POST['fuel'];
      $engine = $_POST['engine'];
      $color  = $_POST['color'];

      $attachName = $_FILES['attach']['name'];
      $attachSize = $_FILES['attach']['size'];
      $attachTmp  = $_FILES['attach']['tmp_name'];
      $attachType = $_FILES['attach']['type'];

      $attachArr = explode('.', $attachName);
      $file_extention = strtolower(end($attachArr));
      $attachAllExtension = array("jpeg","png","jpg","gif","jfif");

      $attach = rand(0,1000000) . '_' . $attachName;
      move_uploaded_file($attachTmp,"uploads\attach\\" . $attach);

      $condition = $_POST['condition'];
      $feature  = $_POST['feature'];
      $Description = $_POST['Description'];
      $carid = $_SESSION['editId'];
      $img="";
    
      if(empty($attachName)){
        $img = $_SESSION['attach'];
      } else{
        $img = $attach;
      }

      $stmt = $con->prepare("UPDATE `cars` SET `Date` = now(), `Brand` = '$brand' , `Type` = '$type' , `Title` = '$title' , `Status` = 0 , `price` = '$price' , `fuel` = '$fuel' , `engine` = '$engine' , `color` = '$color' , `attach` = '$img' , `condition_car` = '$condition' , `feature` = '$feature' , `Description` = '$Description' WHERE `cars`.`id` = $carid ");
      $stmt->execute();

       ?>
      
          <!-----start content---->
              <div class="content">
                   <?php
                          echo "<div class='alert alert-success'>" . $stmt->rowCount() . " Record Updated"  . "</div>";
                   ?>
              </div>
          <!-----end content---->
          </div>
      </div>
    </div>
   <?php }


  if($do == "Delete"){
    include "SideBar.php";
    $deleteid = isset($_GET['id']) && is_numeric($_GET['id']) ? intval($_GET['id']) : 0;
    $count = deleteItem("cars","id",$deleteid);
     ?>
    
        <!-----start content---->
            <div class="content">
                <?php

               if($count > 0){
                   echo "<div class='alert alert-success'>" . $count . " Record Deleted</div>";
               }

              ?>
            </div>
        <!-----end content---->
        </div>
    </div>
  </div>
 <?php }

if($do == "Available"){
     include "SideBar.php";
     ?>
        <!-----start content---->
        <div class="content">
              <div class="back">
                    <?php

                            $stmt = $con->prepare("SELECT 
                            cars.*,category.category
                            FROM    
                            cars
                            INNER JOIN
                            category
                            ON
                            cars.Type = category.id
                            AND 
                            cars.Status = 1

                            ");
                            $stmt->execute();
                            $cars = $stmt->fetchAll();
                            
                        if(!empty($cars)){ ?>

                <h2 class="text-center mb-3">List of Cars</h2>
                <div class="container">
                    <div class="table-responsive">
                        <table class="main-table text-center table table-bordered">
                            <tr>
                                 <td>#</td>
                                 <td>Date Created</td>
                                 <td>Brand</td>
                                 <td>Type</td>
                                 <td>Title</td>
                                 <td>Status</td>
                                 <td>Action</td>
                            </tr>
                            <?php

                               
                                   
                                 foreach($cars as $car){
                                    echo "<tr>";
                                       echo "<td>" . $car['id'] . "</td>";
                                       echo "<td>" . $car['Date'] . "</td>";
                                       echo "<td>" . $car['Brand'] . "</td>";
                                       echo "<td>" . $car['category'] . "</td>";
                                       echo "<td>" . $car['Title'] . "</td>";
                                       echo "<td class='statut'>";
                                         if($car['Status'] == 0){
                                            echo "not Avaibale";
                                         } else{
                                             echo "Availbale";
                                         }
                                       echo "</td>";
                                       echo "<td>";                     
                                         echo '<a class="nav-link  dropdown-toggle linkDrp" dropdown-toggle href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Action</a>';
                                       echo  '<ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                             <li><a class="dropdown-item" href="cars.php?do=view&id=' . $car['id'] .'">View</a></li>
                                             <li><a class="dropdown-item" href="cars.php?do=Edit&id=' . $car['id']  .'">Edit</a></li>
                                             <li><a class="dropdown-item" href="cars.php?do=Delete&id=' . $car['id'] .'">Delete</a></li>
                                          </ul>
        
                                          ';
                       
                                        echo "</td>";
                                    echo "</tr>";
                                 }
                                } else{
                                  echo "<div>there is not Brands</div>";
                                }
                            ?>
                        </table>
                    </div>
                </div>
            </div>
        <!-----end content---->
     <?php
 }
 
   ?>
<?php 
include $tp . "/footer.php";
} else{
     header("Location: login.php");
     exit();
}


?>