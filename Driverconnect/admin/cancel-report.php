<?php
session_start();
error_reporting(0);
require_once('include/config.php');
if(strlen( $_SESSION["adminid"])==0)
    {   
header('location:login.php');
}
else{?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>DC| Cancelled Booking Report</title>

    <!-- Custom fonts for this template -->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>

    <!-- Custom styles for this page -->
    <link href="../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
       <?php include 'include/sidebar.php';?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
               <?php include 'include/header.php';?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                   
                  

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Cancelled Report Date Selection</h6>
                        </div>
                        <div class="card-body">
                        <form method="POST">
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="date" class="form-control" name="fromdate" id="fromdate" placeholder="From Date" required="">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="date" class="form-control" name="todate" id="todate" placeholder="To Date" required="">
                                    </div>
                                </div>
                               <input type="submit" id="submit" name="submit" class="btn btn-primary" value="submit">
                               
                              
                               
                            </form>
                        </div>
                    </div>
<?php 
if(Isset($_POST['submit'])){?>
<?php
 $fdate=$_POST['fromdate'];
 $tdate=$_POST['todate'];
?>


                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Cancelled Booking Report Details</h6>
                        </div>
                        <div class="card-body">
                        <h5 align="center" style="color:blue">Report from <?php echo $fdate?> to <?php echo $tdate?></h5>
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Sr No</th>
                                            <th>Booking no</th>
                                            <th>User Name</th>
                                            <th>User Email</th>
                                            <th>User Mobile</th>
                                            <th>From Date</th>
                                            <th>To Date</th>
                                            <th>User Remark</th>
                                            <th>Status</th>
                                            <th>Driver Remark</th>
                                            
                                           
                                      
                                        </tr>
                                    </thead>
                      <?php 
                    
                      $st='2';
                      $sql ="SELECT fname,lname,email,mobile,fromdate,todate,status,remark,driverremarks,bookingNumber
                       FROM tbhiredriver 
                       join tbluser
                      on tbluser.id=tbhiredriver.userid 
where tbhiredriver.status=:st and date(tbhiredriver.create_date) between :fdate and :tdate";
                     $query= $dbh -> prepare($sql);
        
                    $query->bindParam(':st',$st, PDO::PARAM_STR);
                    $query->bindParam(':fdate',$fdate, PDO::PARAM_STR);
                    $query->bindParam(':tdate',$tdate, PDO::PARAM_STR);
                      $query-> execute();
                      $results = $query -> fetchAll(PDO::FETCH_OBJ);
                      $cnt=1;
                      if($query -> rowCount() > 0)
                      {
                      foreach($results as $result)
                      {
                      ?>
                  <tr>
                    <td><?php echo($cnt);?></td>
                        <th><?php echo htmlentities($result->bookingNumber);?></th>
                    <td><?php echo htmlentities($result->fname);?> <?php echo htmlentities($result->lname);?></td>
                    <td><?php echo htmlentities($result->email);?></td>
                    <td><?php echo htmlentities($result->mobile);?></td>
                    <td><?php echo htmlentities($result->fromdate);?></td>
                    <td><?php echo htmlentities($result->todate);?></td>
                    <td><?php echo htmlentities($result->remark);?></td>
                    <td>
                        
                        <?php 
                        $statusd=$result->status;
                        if ($statusd=='1') {
                            echo '<span class="badge badge-danger">Cancel</span>';
                         }
                        
                        ?>
                    </td> <td><?php echo htmlentities($result->driverremarks);?></td>
                   
                </tr>

                  

                  <?php  $cnt=$cnt+1; } } ?>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <?php }?>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <?php include 'include/footer.php'; ?>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

   

    <!-- Bootstrap core JavaScript-->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="../vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="../vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../js/demo/datatables-demo.js"></script>

</body>

</html>
<?php } ?>