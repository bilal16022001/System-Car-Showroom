<?php
   include "init.php";
   include $tp . "/navbar.php";
   $do = isset($_GET['do']) ? $_GET['do'] : 'Manage';
   $catego = getdb("*","category");
   
    foreach($catego as $cat){

      if($cat['category']== $do || $do == "Manage"){

?>

<div class="bacimg">
    <?php
       $getImg = getdb("attach","system");
    ?>
    <img src="admin/uploads/attach/<?php echo $getImg[0]['attach']; ?> "/>
   <div class="overlay"></div>
   <div class="title">
      <h1>Welcome to Our <br/> webSite</h1>
   </div>
</div>

<?php 

   include "brands.php";
   include "Feature.php";
   include "categories.php";
   include "Contact.php";
   include "Footer.php";
   include $tp . "/footer.php";
   break;
}
    }

