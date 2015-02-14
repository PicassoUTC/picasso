<!DOCTYPE html>
<html lang="en">

<head>
<?php
include 'config.php';
include "php/services.php";


session_start();
if(!isset($_SESSION['login'])){
    header("Location: https://cas.utc.fr/cas/login?service=https://".$_SERVER['HTTP_HOST']."/picassoAdmin/pages/index.php");
}


$con = mysqli_connect($database['host'], $database['username'], $database['password'], 'picasso');
$query = "SELECT * FROM `site_goodies`";
$query = mysqli_query($con, $query);
$numberOfWinners = 0;
while($res = mysqli_fetch_array($query)){
    $numberOfWinners++;
}  
mysqli_close($con);                                 

if(isset($_POST['deleteTable'])){
    if ($_POST['deleteTable'] == 'true'){
        $con = mysqli_connect($database['host'], $database['username'], $database['password'], 'picasso');
        $query = "TRUNCATE TABLE `site_goodies`";
        $query = mysqli_query($con, $query);           
        mysqli_close($con);
        $numero = 0;
    }
}

if (isset($_POST['fName']) && isset($_POST['lName'])){
    if($_POST['fName'] != "" && $_POST['lName'] != ""){
        $con = mysqli_connect($database['host'], $database['username'], $database['password'], 'picasso');
        $numero = $numberOfWinners + 1;
        $query = 'INSERT INTO `site_goodies` (id, nom, prenom, numero) VALUES (null, "'.strtoupper($_POST['lName']).'", "'.$_POST['fName'].'", '.$numero.')';
        $query = mysqli_query($con, $query);           
        mysqli_close($con);
    }
}

if(isset($_POST['goodieID'])){
    if($_POST['goodieID'] != ""){
        $con = mysqli_connect($database['host'], $database['username'], $database['password'], 'picasso');
        $query = 'UPDATE `site_goodies` SET received=1 WHERE id='.$_POST['goodieID'];
        $query = mysqli_query($con, $query);
        mysqli_close($con);
    }
}

$Pris = array();
$nonPris = array();

//get those who already took their goodies
    $con = mysqli_connect($database['host'], $database['username'], $database['password'], 'picasso');
    $query = "SELECT * FROM `site_goodies` ORDER BY `nom`";
    $query = mysqli_query($con, $query);
    $in = 0;
    $inN = 0;
    while($res = mysqli_fetch_array($query, MYSQL_ASSOC)){

        if($res['received'] == 1){
            
            $Pris[$in] = array(
                    0 => $res['nom'],
                    1 => $res['prenom'],
                    2 => $res['id']
                );
            $in++;
        }else if ($res['received'] == "0"){
            
            $nonPris[$inN] = array(
                    0 => $res['nom'],
                    1 => $res['prenom'],
                    2 => $res['id']
                );
            $inN++;
        }
    }

    mysqli_close($con);

?>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Pic'Asso Suivi Tréso / Stock</title>

    <!-- Bootstrap Core CSS -->
    <link href="../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Timeline CSS -->
    <link href="../dist/css/timeline.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="../bower_components/morrisjs/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">Pic'Asso Suivi Tréso / Stock</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-envelope fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-messages">
                        <li>
                            <a href="#">
                                <div>
                                    <strong>John Smith</strong>
                                    <span class="pull-right text-muted">
                                        <em>Yesterday</em>
                                    </span>
                                </div>
                                <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend...</div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <strong>John Smith</strong>
                                    <span class="pull-right text-muted">
                                        <em>Yesterday</em>
                                    </span>
                                </div>
                                <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend...</div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <strong>John Smith</strong>
                                    <span class="pull-right text-muted">
                                        <em>Yesterday</em>
                                    </span>
                                </div>
                                <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend...</div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a class="text-center" href="#">
                                <strong>Read All Messages</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                    <!-- /.dropdown-messages -->
                </li>
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-tasks fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-tasks">
                        <li>
                            <a href="#">
                                <div>
                                    <p>
                                        <strong>Task 1</strong>
                                        <span class="pull-right text-muted">40% Complete</span>
                                    </p>
                                    <div class="progress progress-striped active">
                                        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                                            <span class="sr-only">40% Complete (success)</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <p>
                                        <strong>Task 2</strong>
                                        <span class="pull-right text-muted">20% Complete</span>
                                    </p>
                                    <div class="progress progress-striped active">
                                        <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%">
                                            <span class="sr-only">20% Complete</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <p>
                                        <strong>Task 3</strong>
                                        <span class="pull-right text-muted">60% Complete</span>
                                    </p>
                                    <div class="progress progress-striped active">
                                        <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%">
                                            <span class="sr-only">60% Complete (warning)</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <p>
                                        <strong>Task 4</strong>
                                        <span class="pull-right text-muted">80% Complete</span>
                                    </p>
                                    <div class="progress progress-striped active">
                                        <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%">
                                            <span class="sr-only">80% Complete (danger)</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a class="text-center" href="#">
                                <strong>See All Tasks</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                    <!-- /.dropdown-tasks -->
                </li>
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-bell fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-alerts">
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-comment fa-fw"></i> New Comment
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-twitter fa-fw"></i> 3 New Followers
                                    <span class="pull-right text-muted small">12 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-envelope fa-fw"></i> Message Sent
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-tasks fa-fw"></i> New Task
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-upload fa-fw"></i> Server Rebooted
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a class="text-center" href="#">
                                <strong>See All Alerts</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                    <!-- /.dropdown-alerts -->
                </li>
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#"><i class="fa fa-user fa-fw"></i> <?php echo $_SESSION['login'];?></a>
                        </li>
                        <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="login.html"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

           <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="sidebar-search">
                            <div class="input-group custom-search-form">
                                <input type="text" class="form-control" placeholder="Search...">
                                <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                            </div>
                            <!-- /input-group -->
                        </li>
                        <li>
                            <a href="index.php"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-eur fa-fw"></i> Trésorerie</span></a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-bar-chart fa-fw"></i> Stock<span class="fa arrow"></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="stockBiere.php">Bière</a>
                                </li>
                                <li>
                                    <a href="#">Softs</a>
                                </li>
                                <li>
                                    <a href="#">Snack</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-edit fa-fw"></i> Site Picasso<span class="fa arrow"></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="#">Article du Jour</a>
                                </li>
                                <li>
                                    <a href="calendrier.php">Calendrier</a>
                                </li>
                                <li>
                                    <a href="goodies.php">Gagnants Goodies</a>
                                </li>   
                                <li>
                                    <a href="adminAdd.php">Ajouter Admin</a>
                                </li>
                            </ul>
                        </li>
                        
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Gagants Goodies</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-calendar fa-fw"></i> Les gagnants des Goodies de la Semaine du <?php echo date("d/m/y");?>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="row">
                                <form method="POST" action="goodies.php">
                                    <div class="col-lg-5">
                                        <div class="row">
                                            <div class="col-lg-6"><input class="form-control" style="margin-bottom:5px;" type="text" name="fName" placeholder="Prénom"/></div>
                                            <div class="col-lg-6"><input class="form-control" style="margin-bottom:5px;" type="text" name="lName" placeholder="Nom"/></div>
                                        </div>

                                            <button type="submit" class="btn btn-primary btn-lg btn-block">Ajouter</button>
                                        
                                        
                                    </div>
                                    <div class="col-lg-5">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <i class="fa fa-warning"></i> Eliminer les gagnants de la semaine dernière 
                                            </div>
                                            <div class="panel-body">
                                                <form method="POST" action="goodies.php">
                                                    <div class="col-lg-12">
                                                        <script type="text/javascript">
                                                            function setDelete () {
                                                                document.getElementById("deleteHidden").value="true";
                                                            }
                                                        </script>

                                                        <input type="hidden" name="deleteTable"  id="deleteHidden" value="false"/>
                                                        <button type="submit" class="btn btn-lg btn-danger col-lg-12 col-sm-12 col-md-12" onclick="setDelete();"><i class="fa fa-times"></i></button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>                  
                                    <div class="col-lg-2">
                                       
                                        Pour l'instant il y a <?php 
                                        if(isset($numero)){
                                            echo $numero;
                                        }else{
                                            echo $numberOfWinners; 

                                        }

                                        ?> gagnants de goodies
                                    </div>
                                </form>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 col-sm-12 col-md-12">
                                    <div class="panel panel-default">
                                        <div class="panel-heading"><i class="fa fa-calendar"></i> Gagnants</div>
                                        <div class="panel-body">
                                            <div class="col-lg-6 col-sm-12">
                                                <div class="panel panel-default">
                                                    <div class="panel-heading"><i class="fa fa-calendar"></i> Non Récupérés</div>
                                                    <div class="panel-body">
                                                        <div class="col-lg-12 col-sm-12">
                                                            <table class="table table-striped table-bordered">
                                                                <tr>
                                                                    <th>Num.</th>
                                                                    <th>Nom</th>
                                                                    <th>Prénom</th>
                                                                    <th>Récupéré</th>
                                                                </tr>
                                                                <?php
                                                                for($i = 0; $i < count($nonPris); $i++){
                                                                    echo "<tr>
                                                                    <td>".(string)($i + 1)."</td>
                                                                    <td>".$nonPris[$i][0]."</td>
                                                                    <td>".$nonPris[$i][1]."</td>

                                                                    <td>
                                                                        <form method=\"POST\" action=\"goodies.php\">
                                                                            <input type=\"hidden\" name=\"goodieID\" value=\"".$nonPris[$i][2]."\"/>
                                                                            <div class=\"col-lg-12 col-sm-12\"><button class=\"btn btn-sm col-lg-12 col-sm-12 btn-info\" type=\"submit\"><i class=\"fa fa-check\"></i></button></div>
                                                                        </form>
                                                                    </td>";
                                                                    }
                                                                    ?>
                                                                    </tr>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-sm-12">
                                                <div class="panel panel-default">
                                                    <div class="panel-heading"><i class="fa fa-calendar"></i> Récupérés</div>
                                                    <div class="panel-body">
                                                        <div class="col-lg-12 col-sm-12">
                                                            <table class="table table-striped table-bordered">
                                                                <tr>
                                                                    <th>Num.</th>
                                                                    <th>Nom</th>
                                                                    <th>Prénom</th>
                                                                </tr>
                                                                <?php
                                                                for($i = 0; $i < count($Pris); $i++){
                                                                    echo "<tr>
                                                                    <td>".(string)($i + 1)."</td>
                                                                    <td>".$Pris[$i][0]."</td>
                                                                    <td>".$Pris[$i][1]."</td>
                                                                    </tr>";
                                                                }
                                                                ?>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->

              
                <!-- /.col-lg-4 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="../bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="../bower_components/raphael/raphael-min.js"></script>
    <script src="../bower_components/morrisjs/morris.min.js"></script>
    <script src="../js/morris-data.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>

</body>

</html>
