
<div class="dashboard sidebar">
    <div class="row">
        <div class="col-md-3">
            <div class="sidebar">
                <?php
                       $titleSystem = getdb("SystemName","system");
                      echo "<h3>" . $titleSystem[0]['SystemName'] . "</h3>";
                 ?>
                <hr>
                <ul>
                    <li class=""><i class="fa fa-gauge-high"></i><a href="dashboard.php">dashboard</a></li>
                    <li><i class="fa-solid fa-car"></i><a href="cars.php">Car List</a></li>
                    <li><i class="fa-solid fa-info"></i><a href="inquiry.php">inquiries</a></li>
                    <h3>Maintenance</h3>
                    <li><i class="fa-solid fa-list"></i><a href="categories.php">Category List</a></li>
                    <li><i class="fa-solid fa-copyright"></i><a href="brands.php">Brand List</a></li>
                    <li><i class="fa-sharp fa-solid fa-users"></i><a href="users.php">User List</a></li>
                    <li><i class="fa-solid fa-gear"></i><a href="settings.php">Settings</a></li>
                </ul>
            </div>
        </div>
        <div class="col-md-9">
            <div class="header">
                <div class="row">
                    <div class="col-md-8">
                      <?php
                           $titleSystem = getdb("SystemName","system");
                             echo  $titleSystem[0]['SystemName'];
                       ?>
                    </div>
                    <div class="col-md-4">
                           <a class="nav-link Sad  dropdown-toggle linkDrp " dropdown-toggle href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Administrator admin</a>

                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="account.php"><i class="fa-solid fa-user"></i> My Account</a></li>
                            <li><a class="dropdown-item" href="logout.php"><i class="fa-solid fa-right-from-bracket"></i> logout</a></li>
            
                        </ul>
        
                                        
                    </div>
                </div>
            </div>
