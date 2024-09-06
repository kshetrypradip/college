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
$classname=$_POST['classname'];
$classnamenumeric=$_POST['classnamenumeric']; 
$section=$_POST['section'];
$sql="INSERT INTO  classes(ClassName,ClassNameNumeric,Section) VALUES(:classname,:classnamenumeric,:section)";
$query = $dbh->prepare($sql);
$query->bindParam(':classname',$classname,PDO::PARAM_STR);
$query->bindParam(':classnamenumeric',$classnamenumeric,PDO::PARAM_STR);
$query->bindParam(':section',$section,PDO::PARAM_STR);
$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
$msg="Class Created successfully";
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
        <title>Student Result Management System | Create Class</title>
        <link rel="stylesheet" href="css/bootstrap.css" media="screen" >
        <link rel="stylesheet" href="css/font-awesome.min.css" media="screen" >
        <link rel="stylesheet" href="css/animate-css/animate.min.css" media="screen" >
        <link rel="stylesheet" href="css/lobipanel/lobipanel.min.css" media="screen" >
        <link rel="stylesheet" href="css/prism/prism.css" media="screen" > 
        <link rel="stylesheet" href="css/main.css" media="screen" >
        <script src="js/modernizr/modernizr.min.js"></script>
         <style>
        .errorWrap {
    padding: 10px;
    margin: 0 0 20px 0;
    background: #fff;
    border-left: 4px solid #dd3d36;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
.succWrap{
    padding: 10px;
    margin: 0 0 20px 0;
    background: #fff;
    border-left: 4px solid #5cb85c;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
        </style>
    </head>
    <body class="top-navbar-fixed" >
        <div class="main-wrapper">

            
            <?php include('includes/topbar.php');?>   
         
            <div class="content-wrapper">
                <div class="content-container">


<?php include('includes/leftbar.php');?>                   
 

                    <div class="main-page">
                        <div class="container-fluid">
                            <div class="row page-title-div">
                                <div class="col-md-6">
                                    <h2 class="title">Create Student Class</h2>
                                </div>
                                
                            </div>
                           
                            <div class="row breadcrumb-div">
                                <div class="col-md-6">
                                    <ul class="breadcrumb">
            							<li><a href="dashboard.php"><i class="fa fa-home"></i> Home</a></li>
            							<li><a href="#">Classes</a></li>
            							<li class="active">Create Class</li>
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
                                                    <h5>Create Student Class</h5>
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
                                                    <label for="default" class="col-sm-2 control-label" style="display: block; margin-bottom: 8px;">Branch*</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" name="classname" class="form-control" required="required" placeholder="BCE, B-Arch, BIT etc " style= "width: 100%;padding: 12px;margin-bottom: 16px;box-sizing: border-box;border: 1px solid #ccc; border-radius: 4px;">
                                                    </div>
                                                    </div>
                                                    <div class="form-group">
                                                    <label for="default" class="col-sm-2 control-label" style="display: block; margin-bottom: 8px;">Semester*</label>
                                                    <div class="col-sm-10">
                                                        <input type="number" name="classnamenumeric" class="form-control"  placeholder="1, 2, 3 etc"required="required" style="width: 100%; padding: 12px;margin-bottom: 16px;box-sizing: border-box;border: 1px solid #ccc;border-radius: 4px;">
                                                    </div>
                                                    </div>
                                                    <div class="form-group">
                                                    <label for="default" class="col-sm-2 control-label" style="display: block; margin-bottom: 8px;">Section</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" name="section" class="form-control"  placeholder="A, B, C etc" style="width: 100%; padding: 12px;margin-bottom: 16px;box-sizing: border-box;border: 1px solid #ccc;border-radius: 4px;">
                                                    </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="col-sm-offset-2 col-sm-10">
                                                            <button type="submit" name="submit" class="btn btn-primary">Create</button>
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
            

        </div>

        <script src="js/jquery/jquery-2.2.4.min.js"></script>
        <script src="js/jquery-ui/jquery-ui.min.js"></script>
        <script src="js/bootstrap/bootstrap.min.js"></script>
        <script src="js/pace/pace.min.js"></script>
        <script src="js/lobipanel/lobipanel.min.js"></script>
        <script src="js/iscroll/iscroll.js"></script>


        <script src="js/prism/prism.js"></script>

        
        <script src="js/main.js"></script>




    </body>
</html>
<?php  } ?>
