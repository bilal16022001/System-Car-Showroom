<?php

  session_start();

  if(isset($_SESSION['name'])){
    $title="category";
    include "init.php";

    $do = isset($_GET['do']) ? $_GET['do'] : 'Manage';

   if($do == 'Manage'){

        include "SideBar.php";  ?>
       
        <!-----start content---->
            <div class="content">
              <div class="back">
                <?php
                      $category = getdb("*","category");
                      if(!empty($category)){
                ?>
                <h2 class="text-center mb-3">List of Category</h2>
                <div class="container">
                    <div class="table-responsive">
                        <table class="main-table text-center table table-bordered">
                            <tr>
                                 <td>#</td>
                                 <td>Date Created</td>
                                 <td>Category</td>
                                 <td>Description</td>
                                 <td>Status</td>
                                 <td>Action</td>
                            </tr>
                            <?php
                       

                                  foreach($category as $cat){

                                    echo "<tr>";
                                       echo "<td>" . $cat['id'] . "</td>";
                                       echo "<td>" . $cat['Date'] . "</td>";
                                       echo "<td>" . $cat['category'] . "</td>";
                                       echo "<td>" . $cat['description'] . "</td>";
                                       echo "<td class='statut'>";
                                        if($cat['status'] == 0){
                                            echo "not Active";
                                        } else{
                                            echo "Active";
                                        }
                                     echo "</td>";
                                     echo "<td>";                     
                                       echo '<a class="nav-link  dropdown-toggle linkDrp" dropdown-toggle href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Action</a>';
                                     echo  '<ul class="dropdown-menu menu" aria-labelledby="navbarDropdown">
                                            <li>
                                    
                                            <a class="dropdown-item" href="categories.php?do=view&id=' . $cat['id']  .'"><i class="fa-solid fa-eye"></i>View</a>
                                            </li>
                                           <li>
                                                <a class="dropdown-item" href="categories.php?do=Edit&id=' . $cat['id']  .'"><i class="fa-solid fa-pen-to-square"></i>Edit</a>
                                             </li>
                                           <li>
                                               <a class="dropdown-item" href="categories.php?do=Delete&id=' . $cat['id'] .'"><i class="fa-solid fa-trash"></i>Delete</a>
                                           </li>
                                        </ul> ';
                     
                                      echo "</td>";
                                    echo "</tr>";
                                      }
                                    } else{
                                           echo "<div>there is not categories</div>";
                                    }
                            ?>
                        </table>
              
                    </div>
                 
                   <a class="btn btn-primary" href="categories.php?do=Add"><i class="fa-solid fa-plus"></i> Add New Category</a>
                </div>
            </div>
        <!-----end content---->
        </div>
    </div>
    <div>
  </div>
  <?php 

   }
   if($do == "Add"){ 
    include "SideBar.php";
     ?>
   <!-----start content---->
         <div class="content">
            <div class="container">
              <div class="row">
                <div class="col-md-6">
                <form class="m-auto" method="POST" action="?do=Insert" enctype="multipart/form-data">     
                      <!----start Category---->
                      <div class="form-group form-group-lg">
                        <label class="col-sm-2 control-label">Category</label>
                        <div class="col-sm-10 col-lg-12 pa_In">
                        <input type="text" name="Category" placeholder="Category"   class="form-control" required="required"  />
                    </div>
                 </div>
                  <!----end Category-->
                    <!----start Description---->
                     <div class="form-group form-group-lg">
                        <label class="col-sm-2 control-label">Description</label>
                        <div class="col-sm-10 col-lg-12 pa_In">
                        <input type="text" name="Description" placeholder="Description"   class="form-control" required="required"  />
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

 if($do == "Insert"){

    include "SideBar.php";
    
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $category    = $_POST['Category'];
            $Description = $_POST['Description'];

            $checkItem = checkitem("*","category","WHERE","category='$category'");
            $count="";

            if($checkItem==0){
            $stmt = $con->prepare("INSERT INTO `category`(`Date`,`category`,`description`,`status`) VALUES(now() , '$category' ,'$Description',0)");
            $stmt->execute();
            $count = $stmt->rowCount();
            }else{
              echo "<div class='content'>this category is exit</div>";
            }
    }

    ?>
      
    <!-----start content---->
        <div class="content">
             <?php
                    echo "<div class='alert alert-success'>" . $count . " Record Ïnserted"  . "</div>";
             ?>
        </div>
    <!-----end content---->
    </div>
</div>
</div>
<?php 
 }
 if($do == "view"){ 
  include "SideBar.php";
  $catid = isset($_GET['id']) && is_numeric($_GET['id']) ? intval($_GET['id']) : 0;
 ?>
   <!-----start content---->
     <div class="content">
        <div class="container">
            <?php
             $detailCat = getdb("*","category","WHERE","id =",$catid);
                 
             foreach($detailCat as $detail){ ?>
                 <h2>Name</h2>   
                 <p><?php echo $detail['category'] ?></p>
                 <h2>Description</h2>
                 <p><?php echo $detail['description'] ?></p>
                 <h2>Status</h2>

               <?php 
                if($detail['status'] == 0){
                  echo "not Active";
                  } else{
                  echo "Active";
               }
            }

            ?>
        </div>
     </div>
    <!-----end content---->

 <?php }

 if($do == 'Edit'){
    include "SideBar.php";
    $EditId = isset($_GET['id']) && is_numeric($_GET['id']) ? intval($_GET['id']) : 0;
    $detailCate = getdb("*","category","WHERE","id =",$EditId);
    $_SESSION['id'] = $detailCate[0]['id'];
   ?> 
      <!-----start content---->
      <div class="content">
            <div class="container">
              <div class="row">
                <div class="col-md-6">
                <form class="m-auto" method="POST" action="?do=update" enctype="multipart/form-data">     
                      <!----start Category---->
                      <div class="form-group form-group-lg">
                        <label class="col-sm-2 control-label">Category</label>
                        <div class="col-sm-10 col-lg-12 pa_In">
                        <input type="text" name="Category" placeholder="Category" value="<?php echo $detailCate[0]['category']; ?>"   class="form-control" required="required"  />
                    </div>
                 </div>
                  <!----end Category-->
                    <!----start Description---->
                     <div class="form-group form-group-lg">
                        <label class="col-sm-2 control-label">Description</label>
                        <div class="col-sm-10 col-lg-12 pa_In">
                        <input type="text" name="Description" placeholder="Description" value="<?php echo $detailCate[0]['description']; ?>"   class="form-control" required="required"  />
                    </div>
                 </div>
                  <!----end Description---->
                </div>
                    <!----start submit---->
                    <div class="form-group form-group-lg">
                    <div class="col-sm-offset-10 col-lg-12">
                       <input type="submit" value="save Product" class="btn btn-primary" />
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
  $category    = $_POST['Category'];
  $Description = $_POST['Description'];
  $id = $_SESSION['id'];
  
  if(!empty($category) && !empty($Description)){
       $stmt = $con->prepare("UPDATE `category` SET `category` = '$category' , `description` = '$Description' WHERE `category`.`id` = '$id'");
       $stmt->execute();
       $count = $stmt->rowCount();

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
}

  if($do == "Delete"){
    include "SideBar.php";
    $deleteid = isset($_GET['id']) && is_numeric($_GET['id']) ? intval($_GET['id']) : 0;
    $count = deleteItem("category","id",$deleteid);
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

  }

  else{
      // echo "you should login";
      header("Location: login.php");
  }