
<header class="header-section">
        <div class="header-top">
            <div class="container">
                <div class="ht-left">
                    <div class="mail-service">
                    <?php if(strlen($_SESSION['uid'])!=0): ?>
                        <i class=" fa fa-envelope"></i>
                            <?php echo $_SESSION['email'];?>
                            <?php endif;?>
                    </div>
                    <div class="phone-service">
                    <?php if(strlen($_SESSION['uid'])!=0): ?>
                            <i class=" fa fa-user"></i>
                            <?php echo $_SESSION['name'];?>
                        <?php endif;?>
                    </div>
                </div>
                <div class="ht-right">
                    <?php if(strlen($_SESSION['uid'])==0): ?>
                    <a href="login.php" class="login-panel"><i class="fa fa-user"></i>User Login</a>
                    <?php else :?>
                        <a href="logout.php" class="login-panel"><i class="fa fa-refresh"></i>Logout</a>
                      <a href="change-password.php" class="login-panel"><i class="fa fa-user"></i>Change Password &nbsp;</a>
                     <a href="profile.php" class="login-panel"><i class="fa fa-gear"></i>Profiles &nbsp;&nbsp;</a>
                    
                    <?php endif;?>
               
                </div>
            </div>
        </div>
        <div class="container-fluid "  style="background-image: url(img1.jpg);   background-repeat: no-repeat;  background-size: 100% ;  object-fit: contain; " >
            <div class="inner-header">
                <div class="row">
                    <div class="col-lg-8 col-md-3 d-flex flex-row " >
                        
                        <div class="logo">
                            <a href="index.php">
                          <h3>  DC </h3>
                          <small style="color:chartreuse">Driver Connect</small>
                            </a>
                            
                        </div>
                        <div class= "d-flex   pl-5  " >
                           
                        <h1>he road to success starts with the perfect driver</h1>

                        </div>
                       
                        
                    </div>
                    <!-- <div class="col-lg-9 col-md-9">
                        <div class="advanced-search">
                            
                            <div class="input-group">
                                <input type="text" name="search" id="search" placeholder="What do you need?">
                                <button type="button"><i class="ti-search"></i></button>
                            </div>
                        </div>
                    </div> -->
                   
                </div>
            </div>
        </div>
        <div class="nav-item">
            <div class="container">
               
                <nav class="nav-menu mobile-menu">
                    <ul>
                        <?php if(strlen($_SESSION['uid'])==0): ?>
                        <li class="active"><a href="index.php">Home</a></li>
                       <li><a href="drivers/login.php">Driver Login</a></li>
                       <li><a href="admin/login.php">Admin Login</a></li>
                       <?php else :?>
                        <li class="active"><a href="index.php">Home</a></li>
                         <li><a href="profile.php">My Profile</a></li>
                          <li><a href="change-password.php">Change Password</a></li>
                            <li><a href="booking-history.php">Book History</a></li>
                           <li><a href="logout.php">Logout</a></li>
                       <?php endif;?>
                    </ul>
                </nav>
                <div id="mobile-menu-wrap"></div>
            </div>
        </div>
    </header>