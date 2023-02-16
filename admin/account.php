<?php

if(isset($_SESSION['name'])){
     $title = "account";
     include "init.php";
     include "SideBar.php";

     $do = isset($_GET['do']) ? $_GET['do'] : 'Manage';
     $MyAccount = getdb("*","users","WHERE","Role =",1);
     if($do == 'Manage'){
?>

 <div class="account">
    <div class="container">
        <div class="row">
           <?php
             foreach($MyAccount as $acc){
                  
                ?>
                 <div class="col-md-4">
                   <img src="uploads/attach/552202_b1.png" />
               </div>
            <div class="col-md-6">
                <ul>
                    <li>name     :  <?php echo $acc['name']; ?></li>
                    <li>userName :  <?php echo $acc['userName']; ?></li>
                    <li>userType :  <?php echo $acc['User Type']; ?></li>
                    <li>email    :  <?php echo $acc['Email']; ?></li>
                </ul>
            </div>
            <a class="btn btn-primary" href="account.php?do=Edit&id=<?php echo $acc['id']; ?> ">Edit</a>
                <?php
                 }
            
            ?>

        </div>
    </div>
 </div>
   <?php 
    
}
include $tp . "/footer.php";

   if($do == 'Edit'){
      
       ?>
        <form method="POST" class="accountForm" action="?do=update">
            <h2>Edit Profile</h2>
            <input type="hidden"  name="id"     value="<?php echo $MyAccount[0]['id']; ?>" /><br/>
            <input type="text"  name="name"     value="<?php echo $MyAccount[0]['name']; ?>" /><br/>
            <input type="text"  name="userName" value="<?php echo $MyAccount[0]['userName']; ?>" /><br/>
            <input type="text"  name="usertype" value="<?php echo $MyAccount[0]['User Type']; ?>" /><br/>
            <input type="email"  name="email"   value="<?php echo $MyAccount[0]['Email']; ?>" /><br/>
            <input type="submit" value="save" class="btn btn-primary" />
        </form>
       <?php
       
     }

     if($do == 'update'){
          $name     = $_POST['name'];
          $userName = $_POST['userName'];
          $usertype = $_POST['usertype'];
          $email    = $_POST['email'];
          $id = $_POST['id'];

          $stmt = $con->prepare("UPDATE `users` SET `name` = '$name' , `userName` = '$userName' , `User Type` = '$usertype' , `Email` = '$email' WHERE `users`.`id` = '$id' ");
          $stmt->execute();
          $count = $stmt->rowCount();
          ?>
           <!-----start content---->
         <div class="content">
               <?php
                    if($count > 0){
                      echo "<div class='alert alert-success'>" . $count . " Record updated</div>";
                     }
               ?>
           </div>
       <!-----end content---->
        <?php
     }
    }else{
      header("Location: login.php");
      exit();
    }