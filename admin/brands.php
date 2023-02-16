<?php

  session_start();

  if(isset($_SESSION['name'])){
    $title="brands";
    include "init.php";

    $do = isset($_GET['do']) ? $_GET['do'] : 'Manage';

   if($do == 'Manage'){

        include "SideBar.php";  ?>
       
        <!-----start content---->
            <div class="content">
              <div class="back">
              <?php
                     $brands = getdb("*","brands");
                     if(!empty($brands)){ ?>
                <h2 class="text-center mb-3">List of Brands</h2>
                <div class="container">
                    <div class="table-responsive">
                        <table class="main-table text-center table table-bordered">
                            <tr>
                                 <td>#</td>
                                 <td>Date Created</td>
                                 <td>Image</td>
                                 <td>Brand</td>
                                 <td>Status</td>
                                 <td>Action</td>
                            </tr>
                            <?php
                                  $brands = getdb("*","brands");

                                  foreach($brands as $brand){
                                      echo "<tr>";
                                         echo "<td>" . $brand['id']   . "</td>";
                                         echo "<td>" . $brand['Date']   . "</td>";
                                         echo "<td>" ;
                                            if(empty($brand['image'])){
                                                 echo "no image";
                                            }else{
                                              ?>
                                                <img class='imgBrand' src='uploads/attach/<?php echo  $brand['image']; ?>'  />
                                              <?php 
                                              }
                                              
                                            
                                         echo "</td>";
                                         echo "<td>" . $brand['brand']   . "</td>";
                                        echo "<td>";
                                            if($brand['status'] == 0){
                                                echo "not Active";
                                            } else{
                                                echo "Active";
                                            }
                                        echo "</td>";
                                            echo "<td>";                     
                                            echo '<a class="nav-link  dropdown-toggle linkDrp" dropdown-toggle href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Action</a>';
                                          echo  '<ul class="dropdown-menu menu" aria-labelledby="navbarDropdown">
                                          <li><a class="dropdown-item" href="brands.php?do=view&id=' . $brand['id']  .'"><i class="fa-solid fa-eye"></i>view</a></li>
                                                <li><a class="dropdown-item" href="brands.php?do=Edit&id=' . $brand['id']  .'"><i class="fa-solid fa-pen-to-square"></i>Edit</a></li>
                                                <li><a class="dropdown-item" href="brands.php?do=Delete&id=' . $brand['id'] .'"><i class="fa-solid fa-trash"></i>Delete</a></li>
                                             </ul> ';
                          
                                           echo "</td>";
                                      echo "</tr>";
                                   
                                      }
                                    } else{
                                      echo "<div>there is not Brands</div>";
                                    }
                            ?>
                        </table>
              
                    </div>
                    <!---start modal--->
                   
                    <!---end modal---->
                   <a class="btn btn-primary" href="brands.php?do=Add"><i class="fa-solid fa-plus"></i> Add New Brand</a>
                </div>
            </div>
        <!-----end content---->
        </div>
    </div>
    <div>
  </div>
  <?php 

   }
   
   if($do == 'Add'){
    include "SideBar.php";

    ?>
       <!-----start content---->
       <div class="content">
            <div class="container">
              <div class="row">
                <div class="col-md-6">
                <form class="m-auto" method="POST" action="?do=Insert" enctype="multipart/form-data">     
                      <!----start image---->
                      <div class="form-group form-group-lg">
                        <label class="col-sm-2 control-label">Category</label>
                        <div class="col-sm-10 col-lg-12 pa_In">
                        <input type="file" name="attach" placeholder="Category"   class="form-control" required="required"  />
                    </div>
                 </div>
                  <!----end image-->
                    <!----start brand---->
                     <div class="form-group form-group-lg">
                        <label class="col-sm-2 control-label">Brand</label>
                        <div class="col-sm-10 col-lg-12 pa_In">
                        <input type="text" name="brand" placeholder="brand"   class="form-control" required="required"  />
                    </div>
                 </div>
                  <!----end brand---->
                </div>
                    <!----start submit---->
                    <div class="form-group form-group-lg">
                    <div class="col-sm-offset-10 col-lg-12">
                       <input type="submit" value="save Brand" class="btn btn-primary" />
                    </div>
                </div>
              <!----end submit---->
  </form>
              </div>
            </div>
            </div>
        <!-----end content---->
    <?php 
   }
   if($do == 'Insert'){
    
      include "SideBar.php";

     if($_SERVER['REQUEST_METHOD'] == "POST"){

      $brand = $_POST['brand'];
      $attachName = $_FILES['attach']['name'];
      $attachSize = $_FILES['attach']['size'];
      $attachTmp  = $_FILES['attach']['tmp_name'];
      $attachType = $_FILES['attach']['type'];

      $attachArr = explode(".",$attachName);
      $file_ext  = strtolower(end($attachArr));
      $attachAll = array("jpeg","png","jpg","gif","jfif");

      $arrForm = array();

      if(empty($attachName)){
          $arrForm[] = "<div class='container alert alert-danger'>image is required</div>";
      }
      if(!empty($attachName) && !in_array($file_ext,$attachAll)){
          $arrForm[] = "<div class='container alert alert-danger'>not allowed this exetntion</div>"; 
      }
      if($attachSize > 4194304){     
          $arrErour[] = "<div class='container alert alert-danger'>image can't be larger <strong>4MB</strong></div>";
      }
     
     foreach($arrForm as $err){
         echo $err;
     }

     if(empty($arrForm)){
         $attach = rand(0,1000000) . "_" . $attachName;
         move_uploaded_file($attachTmp,"uploads\attach\\" . $attach);
         $checkItem = checkitem("*","brands","WHERE","brand='$brand'");
          $count="";
          if($checkItem==0){
            $stmt = $con->prepare("INSERT INTO `brands`(`Date`,`image`,`brand`,`status`) VALUES(now(),'$attach','$brand',0)");
            $stmt->execute();
            $count = $stmt->rowCount();
          }
          else{
            echo "<div class='content'>this brand is exit</div>";
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
     <?php 

   }

   if($do == 'view'){
    include "SideBar.php";
    $brandid = isset($_GET['id']) && is_numeric($_GET['id']) ? intval($_GET['id']) : 0;
    ?>
      <!-----start content---->
      <div class="content car">
              <div class="container">
                <?php  
                  $detailBrand = getdb("*","brands","WHERE","id =",$brandid);
                 
                  foreach($detailBrand as $detail){ ?>
                       <div class="row">
                          <div class="col-md-10">
                            Brand Details
                          </div>
                     
                       </div>
                       <hr/>
                       <div class="row">
                          <div class="col-md-5">
                             <img src="uploads/attach/<?php echo  $detail['image']?>"  />
                          </div>
                          <div class="col-md-7">
                              <div class="infoCar">
                                  <?php
                                    echo "<h1>" . $detail['brand'] . "</h1>";
                                   echo "<div class='statut'>";
                                           if($detail['status'] == 0){
                                             echo "not Active";
                                         } else{
                                             echo "Active";
                                         }
                                         echo  "</div>";
                             
                                  ?>
                              </div>
                          </div>
                        
                        </div>
                   
                        <div class="edbac">
                           <a class="btn btn-primary" href="brands.php?do=Edit&id=<?php echo $detail['id']; ?>">Edit</a>
                           <a class="btn btn-primary" href="brands.php">back list</a>
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

            
   if($do == 'Edit'){
    include "SideBar.php";
    $EditId = isset($_GET['id']) && is_numeric($_GET['id']) ? intval($_GET['id']) : 0;
    $detailBrand = getdb("*","brands","WHERE","id =",$EditId);
    $_SESSION['id'] = $detailBrand[0]['id'];
    $_SESSION['image'] = $detailBrand[0]['image'];

   ?> 
     <!-----start content---->
     <div class="content">
            <div class="container">
              <div class="row">
                <div class="col-md-6">
                <form class="m-auto" method="POST" action="?do=update" enctype="multipart/form-data">     
                      <!----start image---->
                      <div class="form-group form-group-lg">
                        <label class="col-sm-2 control-label">Category</label>
                        <div class="col-sm-10 col-lg-12 pa_In">
                        <input type="file" name="attach" placeholder="Category"   class="form-control"  />
                    </div>
                 </div>
                  <!----end image-->
                    <!----start brand---->
                     <div class="form-group form-group-lg">
                        <label class="col-sm-2 control-label">Brand</label>
                        <div class="col-sm-10 col-lg-12 pa_In">
                        <input type="text" name="brand" placeholder="brand" value="<?php echo $detailBrand[0]['brand'];  ?>"   class="form-control" required="required"  />
                    </div>
                 </div>
                  <!----end brand---->
                </div>
                    <!----start submit---->
                    <div class="form-group form-group-lg">
                    <div class="col-sm-offset-10 col-lg-12">
                       <input type="submit" value="save Brand" class="btn btn-primary" />
                    </div>
                </div>
              <!----end submit---->
  </form>
              </div>
            </div>
            </div>
        <!-----end content---->
 
 <?php }

 if($do == "update"){

    include "SideBar.php";
   if($_SERVER['REQUEST_METHOD'] == "POST"){

    $brand = $_POST['brand']; 
    $attachName = $_FILES['attach']['name'];
    $attachSize = $_FILES['attach']['size'];
    $attachTmp  = $_FILES['attach']['tmp_name'];
    $attachType = $_FILES['attach']['type'];

    $attachArr = explode(".",$attachName);
    $file_ext  = strtolower(end($attachArr));
    $attachAll = array("jpeg","png","jpg","gif","jfif");
    $id = $_SESSION['id'];
    $attach = rand(0,1000000) . "_" . $attachName;
    move_uploaded_file($attachTmp,"uploads\attach\\" . $attach);
    
    $img="";  
    if(empty($attachName)){
      $img = $_SESSION['image'];
    } else{
      $img = $attach;
    }

    $stmt = $con->prepare("UPDATE `brands` SET  `brand` = '$brand' , `image` = '$img' WHERE `brands`.`id` = '$id' ");
    $stmt->execute();
    $count = $stmt->rowCount();
  }
    ?>
    <!-----start content---->
    <div class="content">
                <?php
                    echo "<div class='alert alert-success'>" . $stmt->rowCount() . " Record Updated"  . "</div>";
                 ?>
            </div>
    <!-----end content---->
<?php

 }

 if($do == "Delete"){
    include "SideBar.php";
    $deleteid = isset($_GET['id']) && is_numeric($_GET['id']) ? intval($_GET['id']) : 0;
    $count = deleteItem("brands","id",$deleteid);
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

 
     include $tp . "/footer.php";
      } else{
          header("Location: login.php");
      }

              
