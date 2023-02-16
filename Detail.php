<?php
    include "init.php";
    include $tp . "/navbar.php";
    $do = isset($_GET['do']) ? $_GET['do'] : "Manage"
?>

<!---start content---->
  <div class="content car">
      <div class="container">
          <?php
                $carid = isset($_GET['id']) && is_numeric($_GET['id']) ? intval($_GET['id']) : 0;
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
                          <img src='admin/uploads/attach/<?php echo  $detail['attach']; ?>'  />
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
              <!---start inquiry--->
              <form class="m-auto formInqu" method="POST" action="?do=Insert">  
                   <h1>Submit inquiry</h1>  
                   <input type="hidden" name="id" value="<?php echo $detail['id'] ?>" />
                      <!----start Name & email---->
                      <div class="row">
                         <div class="col-md-6">
                         <label class="col-sm-2 control-label">Name</label>
                             <input type="text" name="Name" placeholder="Name"   class="form-control" required="required"  />
                         </div>
                         <div class="col-md-6">
                         <label class="col-sm-2 control-label">Email</label>
                            <input type="email" name="Email" placeholder="Email"   class="form-control" required="required"  />
                         </div>
                      </div>
                     <!----end Name & email---->
                     <!-----start contact------->
                       <div class="row">
                          <div class="col-md-6">
                            <label class="col-sm-2 control-label">Contact</label>
                             <input type="text" name="contact" placeholder="Contact"   class="form-control" required="required"  />
                          </div>
                       </div>
                     <!-----end contact------->
                      <!-----start message------->
                          <div class="msg">
                              <label class="col-sm-2 control-label">Message</label>
                               <textarea name="message" class="form-control"></textarea>
                          </div><br/>
                      <!-----end message--------->
                      <!----start submit---->
                        <div class="sb">
                            <div class="">
                                <input type="submit" value="submit" class="btn btn-primary" />
                            </div>
                        </div>
                      <!----end submit---->
               </form>
                   <!---end inquiry--->
                     <div class="edbac">
                        <a class="btn btn-primary" href="home.php">back list</a>
                     </div>
                  <?php  
                  
               }
               
               if($do == "Insert"){

                   if($_SERVER['REQUEST_METHOD'] == 'POST'){

                        $Name    = $_POST['Name'];
                        $Email   = $_POST['Email'];
                        $contact = $_POST['contact'];
                        $message = $_POST['message'];
                        $inquiry_id = $_POST['id'];

                        $inqCar   = getdb("Brand","cars","WHERE","id =",$inquiry_id);
                        $inquired = $inqCar[0]['Brand'];

                        $stmt = $con->prepare("INSERT INTO `inquiry`(`fullName`,`inquired`,`Email`,`contact`,`message`,`status`)VALUES('$Name','$inquired','$Email','$contact','$message',0) ");
                        $stmt->execute();
                        $count = $stmt->rowCount();
                        if($count > 0){
                            ?>
                            <!-----start content---->
                            <div class="content">
                                 
                             <div class='alert alert-success'> <?php echo $count; ?> Record Inserted</div>
                           
                                    </div>
                                <!-----end content---->
                            <?php
                        }
                   }
                   
             }
             ?>
            
      </div>
  </div>
<!---end  content----->


