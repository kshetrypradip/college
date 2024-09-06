<?php
session_start();
error_reporting(0);
include('includes/config.php');
if ($_SESSION['alogin'] != '') {
    $_SESSION['alogin'] = '';
}
if (isset($_POST['login'])) {
    $uname = $_POST['username'];
    $password = md5($_POST['password']);
    $sql = "SELECT UserName,Password FROM admin WHERE UserName=:uname and Password=:password";
    $query = $dbh->prepare($sql);
    $query->bindParam(':uname', $uname, PDO::PARAM_STR);
    $query->bindParam(':password', $password, PDO::PARAM_STR);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);
    if ($query->rowCount() > 0) {
        $_SESSION['alogin'] = $_POST['username'];
        echo "<script type='text/javascript'> document.location = 'dashboard.php'; </script>";
    } else {
        echo "<script>alert('Invalid Details');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Login</title>
    <link rel="stylesheet" href="css/bootstrap.min.css" media="screen">
    <link rel="stylesheet" href="css/font-awesome.min.css" media="screen">
    <link rel="stylesheet" href="css/animate-css/animate.min.css" media="screen">
    <link rel="stylesheet" href="css/prism/prism.css" media="screen">
    <link rel="stylesheet" href="css/main.css" media="screen">
    <script src="js/modernizr/modernizr.min.js"></script>

    
    <style>
        body {
            background: url('index.jpg') no-repeat fixed;
            background-size: cover;
            font-family: 'Arial', sans-serif;
            margin: 0; 
        }

        header {
            background-color: rgba(255, 255, 255, 0.50);
            padding: 6px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 0px;
        }

        h1 {
            font-size: 50px;
            text-align: center;
            color: #000000;
            margin-bottom: 2px;
        }

        .main-wrapper {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .main-page {
            background-color: rgba(255, 255, 255, 0);
            padding: 0px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 0px;
            width: 100%;
            max-width: 1200px;
        }

        .panel {
            background-color: rgba(255, 255, 255, 0.6);
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 2px;
        }

        fieldset {
            border: 2px solid #000000;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
        }

        legend {
            font-size: 32px;
            color: #000000;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            font-size: 18px;
            color: #333;
        }

        input {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        button {
            padding: 15px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 18px;
        }

        .sign-in-link,
        .sign-up-link {
            margin-top: 15px;
            text-align: center;
            color: #333;
        }

        a {
            color: #4CAF50;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

    </style>
</head>

<body class="">
    <header>
        <h1><b>MBMAN Student Result Management System</h1>
    </header>
    <div class="main-wrapper">
        <div class="content-wrapper">
            <div class="main-page">

                <div class="col-lg-6 visible-lg-block">
                    <section class="section">
                        <div class="row mt-40">
                            <div class="col-md-10 col-md-offset-1 pt-50">
                                <div class="row mt-30 ">
                                    <div class="col-md-11">
                                        <div class="panel">
                                            <div class="panel-body p-20">
                                                <form action="result.php" method="post">
                                                    <fieldset>
                                                        <legend>View Result</legend>
                                                        <div class="form-group">
                                                            <label for="rollid">Symbol no</label>
                                                            <input type="text" class="form-control" id="rollid" placeholder="Enter Your Roll Id" autocomplete="off" name="rollid">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="default" class="col-sm-2 control-label">Class</label>
                                                            <select name="class" class="form-control" id="default" required="required">
                                                                <option value="">Select Class</option>
                                                                <?php
                                                                $sql = "SELECT * from classes";
                                                                $query = $dbh->prepare($sql);
                                                                $query->execute();
                                                                $results = $query->fetchAll(PDO::FETCH_OBJ);
                                                                if ($query->rowCount() > 0) {
                                                                    foreach ($results as $result) {
                                                                        ?>
                                                                        <option
                                                                            value="<?php echo htmlentities($result->id); ?>"><?php echo htmlentities($result->ClassName); ?>&nbsp; Section-<?php echo htmlentities($result->Section); ?></option>
                                                                    <?php }
                                                                } ?>
                                                            </select>
                                                        </div>
                                                        <div class="form-group mt-20">
                                                            <button type="submit"
                                                                    class="btn btn-labeled pull-right">Search<span
                                                                        class="btn-label btn-label-right"><i
                                                                            class="fa fa-check"></i></span></button>
                                                            <div class="clearfix"></div>
                                                        </div>
                                                    </fieldset>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>

                <div class="col-lg-6">
                    <section class="section">
                        <div class="row mt-40">
                            <div class="col-md-10 col-md-offset-1 pt-50">
                                <div class="row mt-30 ">
                                    <div class="col-md-11">
                                        <div class="panel">
                                            <div class="panel-body p-20">
                                                <form class="form-horizontal" method="post">
                                                    <fieldset>
                                                        <legend>Admin Login</legend>
                                                        <div class="form-group">
                                                            <label for="inputEmail3" class="col-sm-2 control-label">Username</label>
                                                            <div class="col-sm-10">
                                                                <input type="text" name="username" class="form-control"
                                                                    id="inputEmail3" placeholder="UserName">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="inputPassword3" class="col-sm-2 control-label">Password</label>
                                                            <div class="col-sm-10">
                                                                <input type="password" name="password" class="form-control"
                                                                    id="inputPassword3" placeholder="Password">
                                                            </div>
                                                        </div>
                                                        <div class="form-group mt-20">
                                                            <div class="col-sm-offset-2 col-sm-10">
                                                                <button type="submit" name="login"
                                                                        class="btn btn-labeled pull-right">Sign
                                                                    in<span class="btn-label btn-label-right"><i
                                                                            class="fa fa-check"></i></span></button>
                                                            </div>
                                                        </div>
                                                    </fieldset>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    
                </div>
            </div>
        </div>
    </div>
    <footer align="center">
                    
                    <div class="text-muted"><h7>Copyright &copy; Team Pradip 2024</h7></div>
                  
        </footer>

    
</body>
</html>
