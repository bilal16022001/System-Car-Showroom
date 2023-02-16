<?php
   session_start();
   $title="login";
   include "init.php";

   if($_SERVER['REQUEST_METHOD'] == "POST"){

       $name = $_POST['name'];
       $pass = sha1($_POST['password']);

       $stmt = $con->prepare("SELECT * FROM `users` WHERE name = ? AND password = ?");
       $stmt->execute(array($name,$pass));
       $count = $stmt->rowCount();

    
       if($count > 0) {
         $_SESSION['name']=$name;
         header("Location: dashboard.php");
         exit();

       }
    
   }

?>

<form action="<?php echo $_SERVER['PHP_SELF'] ?>" class="adminForm" method="POST">
    <div>
        <h2 class="mb-3">Login</h2>
        <input class="form-control" type="text" placeholder="your name" name="name" /><br/>
        <input class="form-control" type="password" placeholder="password"  name="password" /><br/>
        <input class="form-control mb-3 btn btn-primary" type="submit" value="login" /><br/>
        <a href="http://localhost/Car_Showroom/home.php">Go To webSite</a>
    </div>
</form>

<?php

 include $tp . "/footer.php";

?>