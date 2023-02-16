<?php

  session_start();

  if(isset($_SESSION['name'])){
    $title="users";
    include "init.php";

    $do = isset($_GET['do']) ? $_GET['do'] : 'Manage';

   if($do == 'Manage'){

        include "SideBar.php";  ?>
       
        <!-----start content---->
            <div class="content">
              <div class="back">
                  <?php
                         $users = getdb("*","users","WHERE","Role =",0);
                         if(!empty($users)){ ?>
          
                <h2 class="text-center mb-3">List of System Users</h2>
                <div class="container">
                    <div class="table-responsive">
                        <table class="main-table text-center table table-bordered">
                            <tr>
                                 <td>#</td>
                                 <td>image</td>
                                 <td>Name</td>
                                 <td>User Name</td>
                                 <td>user Type</td>
                                 <td>Action</td>
                            </tr>
                            <?php
   
                                 foreach($users as $user){
                                    echo "<tr>";
                                       echo "<td>" . $user['id'] . "</td>";
                                       echo "<td>" ;
                                            if(empty($user['attach'])){
                                                 echo "no image";
                                            }else{
                                              ?>
                                                <img class='imgBrand' src='uploads/attach/<?php echo  $user['attach']; ?>'  />
                                              <?php 
                                              }
                                                        
                                         echo "</td>";
                                       echo "<td>" . $user['name'] . "</td>";
                                       echo "<td>" . $user['userName'] . "</td>";
                                       echo "<td>" . $user['User Type'] . "</td>";
                           
                                       echo "<td>";                     
                                         echo '<a class="nav-link  dropdown-toggle linkDrp" dropdown-toggle href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Action</a>';
                                       echo  '<ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                             <li><a class="dropdown-item" href="users.php?do=view&id=' . $user['id'] .'"><i class="fa-solid fa-eye"></i>View</a></li>
                                             <li><a class="dropdown-item" href="users.php?do=Edit&id=' . $user['id']  .'"><i class="fa-solid fa-pen-to-square"></i>Edit</a></li>
                                             <li><a class="dropdown-item" href="users.php?do=Delete&id=' . $user['id'] .'"><i class="fa-solid fa-trash"></i>Delete</a></li>
                                          </ul>
        
                                          ';
                       
                                        echo "</td>";
                                    echo "</tr>";
                                 }
                                }else{
                                  echo "<div>there is not users</div>";
                                }
                            ?>
                        </table>
                    </div>
                   <a class="btn btn-primary" href="users.php?do=Add"><i class="fa-solid fa-plus"></i> Create User</a>
                </div>
            </div>
        <!-----end content---->
        </div>
    </div>
    <div>
  </div>
  <?php 
  include $tp . "/footer.php";
}

if($do == 'Add'){
    include "SideBar.php";
  ?>
   <!-----start content---->
         <div class="content">
            <div class="container">
              <div class="fromUser">
                <form class="m-auto" method="POST" action="?do=Insert" enctype="multipart/form-data">     
                      <!----start Product cover---->
                      <div class="form-group form-group-lg">
                        <label class="col-sm-2 control-label">Attach</label>
                        <div class="col-sm-10 col-lg-12 pa_In">
                        <input type="file" name="attach"   class="form-control"  />
                    </div>
                 </div>
                  <!----end Product cover---->
        
                    <!----start Name---->
                     <div class="form-group form-group-lg">
                        <label class="col-sm-2 control-label">Name</label>
                        <div class="col-sm-10 col-lg-12 pa_In">
                        <input type="text" name="Name" placeholder="Name"   class="form-control" required="required"  />
                    </div>
                 </div>
                  <!----end Name---->
                   <!----start username---->
                   <div class="form-group form-group-lg">
                        <label class="col-sm-2 control-label">User Name</label>
                        <div class="col-sm-10 col-lg-12 pa_In">
                        <input type="text" name="userName" placeholder="User Name"   class="form-control" required="required"  />
                    </div>
                 </div>
                  <!----end username---->
                     <!----start User tYPE ---->
                     <div class="form-group form-group-lg mb-3">
                        <label class="col-sm-2 control-label">User Type</label>
                        <div class="col-sm-10 col-lg-12 pa_In">
                        <input type="text" name="userType" placeholder="user type"   class="form-control" required="required"  />
                    </div>
                 </div>
                  <!----end User tYPE ---->
                  <!----start submit---->
                  <div class="form-group form-group-lg">
                    <div class="col-sm-offset-10 col-lg-12">
                       <input type="submit" value="save User" class="btn btn-primary" />
                    </div>
                </div>
              <!----end submit---->
                </div>
                    
           </form>
            </div>
            </div>
        <!-----end content---->

  <?php 

}

if($do == "Insert"){ 
  include "SideBar.php";
  
  if($_SERVER['REQUEST_METHOD'] == 'POST'){
      
      $attachName = $_FILES['attach']['name'];
      $attachSize = $_FILES['attach']['size'];
      $attachTmp  = $_FILES['attach']['tmp_name'];
      $attachType = $_FILES['attach']['type'];

      $attachArr = explode('.', $attachName);
      $file_extention = strtolower(end($attachArr));
      $attachAllExtension = array("jpeg","png","jpg","gif","jfif");

      $Name = $_POST['Name'];
      $userName  = $_POST['userName'];
      $userType = $_POST['userType'];

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
          $checkItem = checkitem("*","users","WHERE","name='$Name'");
          $count="";

          if($checkItem==0){
               $stmt = $con->prepare("INSERT INTO `users`(`attach`,`name`,`userName`,`User Type`,`Role`) VALUES('$attach','$Name','$userName','$userType',0)");
                $stmt->execute();
                 $count = $stmt->rowCount();
          }
          else{
            echo "<div class='content'>this user is exit</div>";
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

if($do == 'view'){
  include "SideBar.php";
  $userid = isset($_GET['id']) && is_numeric($_GET['id']) ? intval($_GET['id']) : 0;
  ?>
    <!-----start content---->
    <div class="content users">
            <div class="container">
              <?php  
                $detailUser = getdb("*","users","WHERE","id =",$userid);
               
                foreach($detailUser as $detail){ ?>
                     <div class="row">
                        <div class="col-md-10">
                          users Details
                        </div>
                   
                     </div>
                     <hr/>
                     <div class="row">
                        <div class="col-md-4">
                          <?php
                                if(empty($detail['attach'])){
                                  echo "no image";
                                 }else{
                                  ?>
                                    <img class='userimage' src='uploads/attach/<?php echo  $detail['attach']; ?>'  />
                                  <?php 
                                 }
                          ?>
                        </div>
                        <div class="col-md-8">
                            <div class="">
                                <?php
                                  echo "<h1>Name : " . $detail['name'] . "</h1>";
                                  echo "<h1>user Name : " . $detail['userName'] . "</h1>";
                                  echo "<h1>user Type : " . $detail['User Type'] . "</h1>";
                                ?>
                            </div>
                        </div>
                      
                      </div>
                 
                      <div class="edbac">
                         <a class="btn btn-primary" href="users.php?do=Edit&id=<?php echo $detail['id']; ?>">Edit</a>
                         <a class="btn btn-primary" href="users.php">back list</a>
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
    $detailUser = getdb("*","users","WHERE","id =",$EditId);
    $_SESSION['userId'] = $detailUser[0]['id'];
    $_SESSION['attach'] = $detailUser[0]['attach'];

 ?> 
   <!-----start content---->
         <div class="content">
            <div class="container">
              <div class="fromUser">
                <form class="m-auto" method="POST" action="?do=update" enctype="multipart/form-data">     
                      <!----start Product cover---->
                      <div class="form-group form-group-lg">
                        <label class="col-sm-2 control-label">Attach</label>
                        <div class="col-sm-10 col-lg-12 pa_In">
                        <input type="file" name="attach"    class="form-control"  />
                    </div>
                 </div>
                  <!----end Product cover---->
        
                    <!----start Name---->
                     <div class="form-group form-group-lg">
                        <label class="col-sm-2 control-label">Name</label>
                        <div class="col-sm-10 col-lg-12 pa_In">
                        <input type="text" name="Name" placeholder="Name" value="<?php echo $detailUser[0]['name'] ;?>"   class="form-control" required="required"  />
                    </div>
                 </div>
                  <!----end Name---->
                   <!----start username---->
                   <div class="form-group form-group-lg">
                        <label class="col-sm-2 control-label">User Name</label>
                        <div class="col-sm-10 col-lg-12 pa_In">
                        <input type="text" name="userName" placeholder="User Name" value="<?php echo $detailUser[0]['userName'] ;?>"   class="form-control" required="required"  />
                    </div>
                 </div>
                  <!----end username---->
                     <!----start User tYPE ---->
                     <div class="form-group form-group-lg mb-3">
                        <label class="col-sm-2 control-label">User Type</label>
                        <div class="col-sm-10 col-lg-12 pa_In">
                        <input type="text" name="userType" placeholder="user type" value="<?php echo $detailUser[0]['User Type'] ;?>"   class="form-control" required="required"  />
                    </div>
                 </div>
                  <!----end User tYPE ---->
                  <!----start submit---->
                  <div class="form-group form-group-lg">
                    <div class="col-sm-offset-10 col-lg-12">
                       <input type="submit" value="save User" class="btn btn-primary" />
                    </div>
                </div>
              <!----end submit---->
                </div>
                    
           </form>
            </div>
            </div>
   <!-----end content---->

<?php }

if($do == "update"){

  include "SideBar.php";

  $attachName = $_FILES['attach']['name'];
  $attachSize = $_FILES['attach']['size'];
  $attachTmp  = $_FILES['attach']['tmp_name'];
  $attachType = $_FILES['attach']['type'];

  $attachArr = explode(".",$attachName);
  $file_ext  = strtolower(end($attachArr));
  $attachAll = array("jpeg","png","jpg","gif","jfif");
  $userId = $_SESSION['userId'];
  $attach = rand(0,1000000) . "_" . $attachName;
  move_uploaded_file($attachTmp,"uploads\attach\\" . $attach);

  $Name = $_POST['Name'];
  $userName  = $_POST['userName'];
  $userType = $_POST['userType'];
  
  $img="";  
  if(empty($attachName)){
    $img = $_SESSION['attach'];
  } else{
    $img = $attach;
  }

  $stmt = $con->prepare("UPDATE `users` SET  `attach` = '$img' , `name` = '$Name' , `userName` = '$userName' , `User Type` = '$userType' WHERE `users`.`id` = '$userId' ");
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

if($do == "Delete"){
    include "SideBar.php";
    $deletId = isset($_GET['id']) && is_numeric($_GET['id']) ? intval($_GET['id']) : 0;
    $count = deleteItem("users","id",$deletId);

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
    <?php

}


  } else{
       header("Location: login.php");
  }