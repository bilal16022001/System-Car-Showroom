<?php

  session_start();

  if(isset($_SESSION['name'])){
    $title="Settings";
    include "init.php";

    $do = isset($_GET['do']) ? $_GET['do'] : 'Manage';

   if($do == 'Manage'){

        include "SideBar.php";  
        
        $system = getdb("*","system");

        if($_SERVER['REQUEST_METHOD'] == 'POST'){

           $id = $_POST['id'];
           $SystemName = $_POST['SystemName'];
           $shortName = $_POST['shortName'];
           $about = $_POST['About'];

           $attachName = $_FILES['attach']['name'];
           $attachSize = $_FILES['attach']['size'];
           $attachTmp  = $_FILES['attach']['tmp_name'];
           $attachType = $_FILES['attach']['type'];

           $attachArr  = explode(".",$attachName);
           $file_extention = strtolower(end($attachArr));
           $attachAllExtension = array("jpeg","png","jpg","gif","jfif");

           //valid form
            // $arrForm = array();

            // if(empty($attachName)){
            //     $arrForm[] = "<div class='container alert alert-danger'>image is required</div>";
            // }
            // if(!in_array($file_extention,$attachAllExtension)){
            //     $arrForm[] = "<div class='container alert alert-danger'>not allowed this exetntion</div>"; 
            // }
            // if($attachSize > 4194304){     
            //     $arrErour[] = "<div class='container alert alert-danger'>image can't be larger <strong>4MB</strong></div>";
            // }
            
            // if(empty($arrForm)){
              $attach = rand(0,1000000) . '_' . $attachName;
              move_uploaded_file($attachTmp,"uploads\attach\\" . $attach);

              $stmt = $con->prepare("UPDATE `system` SET `SystemName` = '$SystemName' , `shortName` = '$shortName' , `About` = '$about' , `attach` = '$attach' WHERE `system`.`id` = '$id' ");
              $stmt->execute();
              $count = $stmt->rowCount();

              ?>
              <!-----start content---->
              <div class="content">
                      <?php
                            echo "<div class='alert alert-success'>" . $count . " Record Updated"  . "</div>";
                       ?>
                  </div>
              <!-----end content---->
              <?php
          //  }
           
      }
        ?>
       
        <!-----start content---->
            <div class="content">
              <div class="back">
                <h2 class=" mb-3">System Information</h2>
                <hr class="mb-5">
                <div class="container">
                  <form class="formSett" method="POST" action="Settings.php" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?php echo $system[0]['id']; ?>" />
                        <h3>System Name</h3>
                        <input type="text" placeholder="System Name" name="SystemName" value="<?php echo $system[0]['SystemName']; ?>" />
                        <h3>System Short Name</h3>
                        <input type="text" placeholder="System Short Name" name="shortName" value="<?php echo $system[0]['shortName']; ?>" />
                        <h3>About Us</h3>
                        <textarea name="About"><?php echo $system[0]['About']; ?>"</textarea> 
                        <h3>image</h3>
                        <input type="file" name="attach" /><br/><br/>
                        <img src="uploads/attach/<?php echo  $system[0]['attach']; ?>"  />
                        <input type="submit" value="update" />
                  </form>

                </div>
            </div>
        <!-----end content---->
        </div>
      </div>
  </div>
  <?php
     include $tp . "/footer.php";
  }


  } else{
      header("Location: login.php");
  }