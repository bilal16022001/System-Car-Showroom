<?php

  session_start();

  if(isset($_SESSION['name'])){
    $title="inquiry";
    include "init.php";

    $do = isset($_GET['do']) ? $_GET['do'] : 'Manage';
 
    if($do == 'Manage'){

      include "SideBar.php";  ?>
     
      <!-----start content---->
          <div class="content">
            <div class="back">
            <?php
                  $inquires = getdb("*","inquiry");
                  if(!empty($inquires)){ ?>
              <h2 class="text-center mb-3">List of Inquiry</h2>
              <div class="container">
                  <div class="table-responsive">
                      <table class="main-table text-center table table-bordered">
                          
                            <tr>
                                <td>#</td>
                                <td>Full Name</td>
                                <td>Inquired for</td>
                                <td>Status</td>
                                <td>Action</td>
                           </tr>
                          <?php
                     
                                  foreach($inquires as $inquiry){
                                    echo "<tr>";
                                      echo "<td>" . $inquiry['id'] . "</td>";
                                      echo "<td>" . $inquiry['fullName'] . "</td>";
                                      echo "<td>" . $inquiry['inquired'] . "</td>";
                                      echo "<td class='statut'>";
                                        if($inquiry['status'] == 0){
                                            echo "Unread";
                                        } else{
                                            echo "read";
                                        }
                                      echo "</td>";
                                      echo "<td>";                     
                                        echo '<a class="nav-link  dropdown-toggle linkDrp" dropdown-toggle href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Action</a>';
                                      echo  '<ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                            <li><a class="dropdown-item" href="inquiry.php?do=view&id=' . $inquiry['id'] .'"><i class="fa-solid fa-eye"></i>View</a></li>
                                            <li><a class="dropdown-item" href="inquiry.php?do=read&id=' . $inquiry['id']  .'"><i class="fa-regular fa-envelope-open"></i>Mark As Read</a></li>
                                            <li><a class="dropdown-item" href="inquiry.php?do=Delete&id=' . $inquiry['id'] .'"><i class="fa-solid fa-trash"></i>Delete</a></li>
                                          </ul>
        
                                          ';
                      
                                        echo "</td>";
                                    echo "</tr>";
                                }
                             } else{
                                 echo "<div>there is not inquiry</div>";

                             }
                          ?>
                      </table>
                  </div>
              </div>
          </div>
      <!-----end content---->
      </div>
  </div>
  <div>
</div>
<?php 
}

if($do == "view"){ 
  include "SideBar.php";
  $inq_id = isset($_GET['id']) && is_numeric($_GET['id']) ? intval($_GET['id']) : 0;
 ?>
   <!-----start content---->
     <div class="content">
        <div class="container">
           <div class="boxInq">
            <?php
             $detailInqui = getdb("*","inquiry","WHERE","id =",$inq_id);
                 
             foreach($detailInqui as $detail){ ?>
                 <h2>Car inquired</h2>   
                 <p><?php echo $detail['inquired'] ?></p>
                 <h2>Full Name</h2>   
                 <p><?php echo $detail['fullName'] ?></p>
                 <h2>Email</h2>
                 <p><?php echo $detail['Email'] ?></p>
                 <h2>contact</h2>
                 <p><?php echo $detail['contact'] ?></p>
                 <h2>Status</h2>
               <?php 
                if($detail['status'] == 0){
                  echo "unread";
                  } else{
                  echo "read";
               }
            }

            ?>
            </div>
        </div>
     </div>
    <!-----end content---->

 <?php }

  if($do == "Delete"){
    include "SideBar.php";
    $deleteid = isset($_GET['id']) && is_numeric($_GET['id']) ? intval($_GET['id']) : 0;
    $count = deleteItem("inquiry","id",$deleteid);
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
  if($do == "read"){
    include "SideBar.php";
    $readid = isset($_GET['id']) && is_numeric($_GET['id']) ? intval($_GET['id']) : 0;
    $stmt = $con->prepare("UPDATE  `inquiry`  SET `status` = 1 WHERE `inquiry`.`id` = '$readid' ");
    $stmt->execute();
    $count = $stmt->rowCount();
     ?>
    
        <!-----start content---->
            <div class="content">
                <?php

                if($count > 0){
                    echo "<div class='alert alert-success'>" . $count . "readed</div>";
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

?>