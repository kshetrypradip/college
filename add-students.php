<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])=="")
    {   
    header("Location: index.php"); 
    }
    else{
if(isset($_POST['submit']))
{
$studentname=$_POST['fullanme'];
$roolid=$_POST['rollid']; 
$studentemail=$_POST['emailid']; 
$gender=$_POST['gender']; 
$classid=$_POST['class']; 
$dob=$_POST['dob']; 
$status=1;
$sql="INSERT INTO  students(StudentName,RollId,StudentEmail,Gender,ClassId,DOB,Status) VALUES(:studentname,:roolid,:studentemail,:gender,:classid,:dob,:status)";
$query = $dbh->prepare($sql);
$query->bindParam(':studentname',$studentname,PDO::PARAM_STR);
$query->bindParam(':roolid',$roolid,PDO::PARAM_STR);
$query->bindParam(':studentemail',$studentemail,PDO::PARAM_STR);
$query->bindParam(':gender',$gender,PDO::PARAM_STR);
$query->bindParam(':classid',$classid,PDO::PARAM_STR);
$query->bindParam(':dob',$dob,PDO::PARAM_STR);
$query->bindParam(':status',$status,PDO::PARAM_STR);
$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
$msg="Student information added successfully";
}
else 
{
$error="Something went wrong. Please try again";
}

}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
        <title> Student Result Management System | Student Registration< </title>
        <link rel="stylesheet" href="css/bootstrap.min.css" media="screen" >
        <link rel="stylesheet" href="css/font-awesome.min.css" media="screen" >
        <link rel="stylesheet" href="css/animate-css/animate.min.css" media="screen" >
        <link rel="stylesheet" href="css/lobipanel/lobipanel.min.css" media="screen" >
        <link rel="stylesheet" href="css/prism/prism.css" media="screen" >
        <link rel="stylesheet" href="css/select2/select2.min.css" >
        <link rel="stylesheet" href="css/main.css" media="screen" >
        <script src="js/modernizr/modernizr.min.js"></script>
    </head>
    <body class="top-navbar-fixed">
        <div class="main-wrapper">

           
  <?php include('includes/topbar.php');?> 
            
            <div class="content-wrapper">
                <div class="content-container">

                  
                   <?php include('includes/leftbar.php');?>  
                  
                    <div class="main-page">

                     <div class="container-fluid">
                            <div class="row page-title-div">
                                <div class="col-md-6">
                                    <h2 class="title">Student Registration</h2>
                                
                                </div>
                                
                                
                            </div>
                           
                            <div class="row breadcrumb-div">
                                <div class="col-md-6">
                                    <ul class="breadcrumb">
                                        <li><a href="dashboard.php"><i class="fa fa-home"></i> Home</a></li>
                                
                                        <li class="active">Student Registration</li>
                                    </ul>
                                </div>
                             
                            </div>
                            
                        </div>
                        <div class="container-fluid">
                           
                        <div class="row">
                                    <div class="col-md-12">
                                        <div class="panel">
                                            <div class="panel-heading">
                                                <div class="panel-title">
                                                    <h5>Fill the Student information</h5>
                                                </div>
                                            </div>
                                            <div class="panel-body">
                                            <?php if($msg || $error): ?>
<div id="notification" class="alert left-icon-alert <?= $msg ? 'alert-success' : 'alert-danger'; ?>" role="alert">
    <?= htmlentities($msg ? $msg : $error); ?>
</div>

<script>
   
    setTimeout(function() {
        var notification = document.getElementById('notification');
        if (notification) {
            notification.style.display = 'none';
        }
    }, 2000);
</script>

<?php endif; ?>
                                                <form class="form-horizontal" method="post">

<div class="form-group">
<label for="default" class="col-sm-2 control-label" style="
                                        display: block;
                                        margin-bottom: 8px;">Full Name*</label>
<div class="col-sm-10">
<input type="text" name="fullanme" class="form-control" id="fullanme" required="required" autocomplete="off" style="
                                        width: 100%;
                                        padding: 12px;
                                        margin-bottom: 16px;
                                        box-sizing: border-box;
                                        border: 1px solid #ccc;
                                        border-radius: 4px;">
</div>
</div>

<div class="form-group">
<label for="default" class="col-sm-2 control-label" style="
                                        display: block;
                                        margin-bottom: 8px;">Symbol no*</label>
<div class="col-sm-10">
<input type="text" name="rollid" class="form-control" id="rollid" maxlength="10" required="required" autocomplete="off" style="
                                        width: 100%;
                                        padding: 12px;
                                        margin-bottom: 16px;
                                        box-sizing: border-box;
                                        border: 1px solid #ccc;
                                        border-radius: 4px;">
</div>
</div>

<div class="form-group">
<label for="default" class="col-sm-2 control-label" style="
                                        display: block;
                                        margin-bottom: 8px;">Email</label>
<div class="col-sm-10">
<input type="email" name="emailid" class="form-control" id="email"  autocomplete="off">
</div>
</div>



<div class="form-group">
<label for="default" class="col-sm-2 control-label">Gender*</label>
<div class="col-sm-10">
<input type="radio" name="gender" value="Male" required="required" checked="">Male <input type="radio" name="gender" value="Female" required="required">Female <input type="radio" name="gender" value="Other" required="required">Other
</div>
</div>
                                                        <div class="form-group">
                                                        <label for="default" class="col-sm-2 control-label" style="
                                        display: block;
                                        margin-bottom: 8px;">Class*</label>
                                                        <div class="col-sm-10">
 <select name="class" class="form-control" id="default" required="required">
<option value="">Select Class</option>
<?php $sql = "SELECT * from classes";
$query = $dbh->prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0)
{
foreach($results as $result)
{   ?>
<option value="<?php echo htmlentities($result->id); ?>"><?php echo htmlentities($result->ClassName); ?>&nbsp; Section-<?php echo htmlentities($result->Section); ?></option>
<?php }} ?>
 </select>
                                                        </div>
                                                    </div>
<div class="form-group">
                                                        <label for="date" class="col-sm-2 control-label" style="
                                        display: block;
                                        margin-bottom: 8px;">DOB*</label>
                                                        <div class="col-sm-10">
                                                            <input type="date"  name="dob" class="form-control" id="date">
                                                        </div>
                                                    </div>
                                                    

                                                    
                                                    <div class="form-group">
                                                        <div class="col-sm-offset-2 col-sm-10">
                                                            <button type="submit" name="submit" class="btn btn-primary">Register</button>
                                                        </div>
                                                    </div>
                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                    </div>
                </div>
                
            </div>
          
        </div>
       
        <script src="js/jquery/jquery-2.2.4.min.js"></script>
        <script src="js/bootstrap/bootstrap.min.js"></script>
        <script src="js/pace/pace.min.js"></script>
        <script src="js/lobipanel/lobipanel.min.js"></script>
        <script src="js/iscroll/iscroll.js"></script>
        <script src="js/prism/prism.js"></script>
        <script src="js/select2/select2.min.js"></script>
        <script src="js/main.js"></script>
        <script>
            $(function($) {
                $(".js-states").select2();
                $(".js-states-limit").select2({
                    maximumSelectionLength: 2
                });
                $(".js-states-hide").select2({
                    minimumResultsForSearch: Infinity
                });
            });
        </script>
    </body>
</html>
<?PHP } ?>
