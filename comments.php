<?php
session_start();

if (!$_SESSION['username']) {
    header("Location: /index.html?error=noperms");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>UCL CS feedback- home page</title>

    <!-- Bootstrap Core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Theme CSS -->
    <link href="css/freelancer.min.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body id="page-top" class="index">
    <br>
    <br>
    <br>
    <br>
    <img src="img/ucllogo.png" width="100%"/>

    <!-- Navigation -->
    <nav id="mainNav" class="navbar navbar-default navbar-fixed-top navbar-custom">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span> Menu <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand" href="#page-top">UCL CS Feedback</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li class="hidden">
                        <a href="#page-top"></a>
                    </li>
                    <li class="page-scroll">
                        <a href="index.php">Home</a>
                    </li>
                    <li class="page-scroll">
                        <a href="feedback.php">Feedback</a>
                    </li>
                    <li class="page-scroll">
                        <a href="contactus.php">Contact Us</a>
                    </li>
                    <?php
                    
                    session_start();

                    if ($_SESSION['username']) {
                        echo '<li class="page-scroll"><a href="comments.php">Comments</a></li>';
                        echo "<li class='page-scroll'><a href='actions/logout.php'>Logout</a></li>";
                    }

                    ?>
                   
                </ul>
                
            </div>
            <!-- /.navbar-collapse -->
            <ul class="nav navbar-nav navbar-right">
                <form>
                    <input type="text" name="search" placeholder="Search.."  >
                </form>
            </ul>
        </div>
            
        <!-- /.container-fluid -->
    </nav>
    <br>
    <br>
        
        <div class="container">
        <div class="row">
                <div class="col-lg-12 text-center">
                    <h2>Comments</h2>
                    <hr class="star-primary">
                </div>
            </div>
            <table class="table">
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>Course</th>
                    <th>Comment</th>
                    <th>Delete</th>
                </tr>
<?php
                
$root = "";
require 'models/comment.php';

if ($_SESSION['username'] === 'Admin') {
    $comment = new Comment(NULL, NULL, NULL, NULL, NULL, NULL);
}
else {
    $comment = new Comment(NULL, NULL, NULL, $_SESSION['username'], NULL, NULL);
}
                
$result = $comment->search();

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["name"]. "</td><td>" . $row["email"]. "</td><td>" . $row["phonenumber"] . "</td><td>" . $row["course"] . "</td><td>" . $row["comment"] . '</td><td><a href="actions/deleteComment.php?id=' . $row['id'] . '"><i class="fa fa-trash" aria-hidden="true"></i></a></td></tr>';
    }
}

?>
                
            </table>
        </div>
    <br>
    <br>
    <br>
    <br>

    <!-- Footer -->
    <footer class="text-center">
        <div class="footer-above">
            <div class="container">
                <div class="row">
                    <div class="footer-col col-md-4">
                        <h3>Location</h3>
                        <p>Gower St <br> Kings Cross<br>London WC1E 6BT</p>
                    </div>
                    <div class="footer-col col-md-4">
                    </div>
                    <div class="footer-col col-md-4">
                        <h3>About the Creators</h3>
                        <p>Pius Jude, Alex Hale and Pierce Grannell</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-below">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        Copyright &copy; UCL Feedback 2017
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scroll to Top Button (Only visible on small and extra-small screen sizes) -->
    <div class="scroll-top page-scroll hidden-sm hidden-xs hidden-lg hidden-md">
        <a class="btn btn-primary" href="#page-top">
            <i class="fa fa-chevron-up"></i>
        </a>
    </div>

    
    <!-- jQuery -->
    <script src="vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>

    <!-- Contact Form JavaScript -->
    <script src="js/jqBootstrapValidation.js"></script>
    <script src="js/contact_me.js"></script>

    <!-- Theme JavaScript -->
    <script src="js/freelancer.min.js"></script>

</body>

</html>
