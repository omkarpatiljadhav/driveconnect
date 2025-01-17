<?php
session_start();
error_reporting(0);
require_once('include/config.php');
if(strlen( $_SESSION["driverid"])==0)
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

    <title>DC| All Bookings</title>

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
                    <h1 class="h3 mb-2 text-gray-800">All Booking List</h1>
                  

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">All Booking List</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Sr No</th>
                                            <th>Booking No.</th>
                                            <th>User Name</th>
                                            <th>User Email</th>
                                            <th>User Mobile</th>
                                            <th>From Date</th>
                                            <th>To Date</th>
                                            <th>User Remark</th>
                                            <th>Status</th>
                                            <th>Driver Remark</th>
                                            <th>Action</th>
                                      
                                        </tr>
                                    </thead>
                      <?php 
                     $uid=$_SESSION['driverid'];
if(isset($_POST['submit']))
{
 $bookingidss=$_POST['bookingiddd'];
$status=$_POST['status'];
$remark=$_POST['remark'];


  $sql="update tbhiredriver set status=:status,driverremarks=:driverremarks where id=:bookingid";
$query = $dbh->prepare($sql);
$query->bindParam(':bookingid',$bookingidss,PDO::PARAM_STR);
$query->bindParam(':status',$status,PDO::PARAM_STR);
$query->bindParam(':driverremarks',$remark,PDO::PARAM_STR);

$query->execute();
//$msg="<script>toastr.success('Mobile info updated Successfully', {timeOut: 5000})</script>";
echo "<script>alert('Booked has been updated.');</script>";
echo "<script> window.location.href =bookeddetails.php;</script>";
}


                      $sql ="SELECT tbhiredriver.id as bookingid, fname,lname,email,mobile,fromdate,todate,status,remark,driverremarks,bookingNumber
                       FROM tbhiredriver 
                       join tbluser
                      on tbluser.id=tbhiredriver.userid 
where driveruserid=:uid ";
                     $query= $dbh -> prepare($sql);
                    $query->bindParam(':uid',$uid, PDO::PARAM_STR);
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
                         if ($statusd=='0') {
                             echo '<span class="badge badge-primary">Pending</span>';
                         }
                         elseif ($statusd=='1') {
                            echo '<span class="badge badge-success">Approved</span>';
                         }
                         elseif ($statusd=='2') {
                             echo '<span class="badge badge-danger">Cancelled</span>';
                         }
                        ?>
                    </td>
                    <td><?php echo htmlentities($result->driverremarks);?></td>
                    <td> 
                    <?php  $statusid=$result->bookingid;?>
                    
                    <?php 
                        $statusd=$result->status;
                         if ($statusd=='0') {?>
                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal<?php echo $statusid; ?>">View</button>

                         <?php } ?>
                        
                      
                       
                    </td>
                   
                  </tr>

                   <!--   here i am creating a modal popup code......... -->

        <div id="myModal<?php echo $statusid; ?>" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                         <button type="button" class="close" data-dismiss="modal">&times;</button>
                            
                    </div>
                    <div class="modal-body">
       <form method="post">
    <div class="row">
      <input type="hidden" name="bookingiddd" value="<?php echo htmlentities($result->bookingid);?>">
      <div class="col-md-12">
        <label for="status">Status</label>
        <select name="status" id="Status" class="form-control">
            <option value="NA">--select--</option>
            <option value="1">Approved</option>
            <option value="2">Cancelled</option>


        </Select>
      </div>
  </div>
  <br></br>
   <div class="row">
        <div class="col-md-12">
            <label for="remark">Remarks</label>
       <textarea name="remark" id="remark" class="form-control"></textarea>
      </div>
    </div>
    <input type="submit" id="submit" name="submit" value="submit" class="btn btn-primary mt-3">
  </form>
                </div>
                </div>
            </div>
        </div>

     <!--    // end modal popup code........ -->

                  <?php  $cnt=$cnt+1; } } ?>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
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