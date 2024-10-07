<?php
include_once('../model/controller.php');
//include_once('session.php');
   if (isset($_POST["loguser"])) {
    // Grab Variable Values And Escape String
    session_start();
    $username   = secure($_POST["username"]);
    $pass   = secure($_POST["password_hash"]);
    $email = secure($_POST["username"]);
    //Check if Values supplied are valid
    if (empty($username) || empty($pass)) {
        $error =  'Please Fill all details Before submitting';
    }else{
        try{
        $chk = user_exist($username,$email, 'lecturer');
        if ($chk==true) {
            $stmt = $mysqli->prepare("SELECT * FROM lecturer WHERE email = ? || username = ? ");
            $stmt->bind_param("ss", $username,$email);
            $stmt->execute();
            $result = $stmt->get_result();
            if($result->num_rows > 0){
                $fetch = $result->fetch_assoc();
                if(password_verify($pass, $fetch["password_hash"])){
                $_SESSION['username'] = $username;
                $_SESSION['email'] = $email;
                $success =  'Login Successful!';
                header("Location: ./dashboard");
                // $prv = getchkAdminUsr($username);
                //     if($prv==true){
                //         header("Location: ./dashboard");
                //     }else{
                //         header("Location: ./home");
                //     }
                }else{
                $error =  'Incorrect Account/Password';
                }
            }
        }else{
            $error =  'This username/email does not exist';
        }
        } catch(Exception $e){
            echo 'Message: '.$e->getMessage();
        }
    }

}

?>
<!DOCTYPE html>
<html lang="en" dir="ltr" data-startbar="light" data-bs-theme="light">

    
<head>
    <meta charset="utf-8" />
            <title>AVERS</title>
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
            <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
            <meta content="" name="author" />
            <meta http-equiv="X-UA-Compatible" content="IE=edge" />

            <!-- App favicon -->
            <link rel="shortcut icon" href="../assets/images/logo-sm.png">

    
        <!-- App css -->
        <link href="../assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="../assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <link href="../assets/css/app.min.css" rel="stylesheet" type="text/css" />

    </head>

    
    <!-- Top Bar Start -->
    <body style="background-color: #0F96F9;">
    <div class="container-xxl">
        <div class="row vh-100 d-flex justify-content-center">
            <div class="col-12 align-self-center">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6 mx-auto">
                            <div class="card">
                                <div class="card-body p-0 bg-blue auth-header-box rounded-top">
                                    <div class="text-center p-3">
                                        <a href="#" class="logo logo-admin">
                                            <img src="../assets/images/logo-sm.png" height="50" alt="logo" class="auth-logo">
                                        </a>
                                        <h4 class="mt-3 mb-1 fw-semibold text-white fs-18">Avers AAUA</h4>   
                                        <p class="text-white fw-medium mb-0">STAFF Sign-in Section.</p>  
                                    </div>
                                </div>
                                <div class="card-body pt-0">
                                <?php
                                if(isset($error)){
                                    echo '<center><h5 class="text-danger">'.$error.'</h5></center>';
                                }
                                if(isset($success)){
                                    echo '<center><h5 class="text-primary">'.$success.'</h5></center>';
                                }
                                ?>                                    
                                    <form class="my-4" action="<?php $_SERVER['PHP_SELF'];?>" method="post" enctype="multipart/form-data">            
                                        <div class="form-group mb-2">
                                            <label class="form-label" for="username">Username/Email</label>
                                            <input type="text" class="form-control" id="username" name="username" placeholder="Enter username/email">                               
                                        </div><!--end form-group--> 
            
                                        <div class="form-group">
                                            <label class="form-label" for="userpassword">Password</label>                                            
                                            <input type="password" class="form-control" name="password_hash" id="userpassword" placeholder="Enter password">                            
                                        </div><!--end form-group--> 
            
                                        <div class="form-group row mt-3">
                                            <div class="col-sm-6">
                                                <div class="form-check form-switch form-switch-success">
                                                    <input class="form-check-input" type="checkbox" id="customSwitchSuccess">
                                                    <label class="form-check-label" for="customSwitchSuccess">Remember me</label>
                                                </div>
                                            </div><!--end col--> 
                                        </div><!--end form-group--> 
            
                                        <div class="form-group mb-0 row">
                                            <div class="col-12">
                                                <div class="d-grid mt-3">
                                                    <button class="btn btn-danger" type="submit"><input type="hidden" name="loguser"/>Log In <i class="fas fa-sign-in-alt ms-1"></i></button>
                                                </div>
                                            </div><!--end col--> 
                                        </div> <!--end form-group-->                           
                                    </form><!--end form-->
                                </div><!--end card-body-->
                            </div><!--end card-->
                        </div><!--end col-->
                    </div><!--end row-->
                </div><!--end card-body-->
            </div><!--end col-->
        </div><!--end row-->                                        
    </div><!-- container -->
    </body>
    <!--end body-->

</html>