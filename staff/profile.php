<?php
include_once('header.php');
if(isset($_POST['updaterec'])){
    $user_id = secure($_POST['lecturer_id']);
    $fullname = secure($_POST['fullname']);
    $email = secure($_POST['email']);
    if(!empty($fullname) || !empty($email)){
        try{
        $chk = update_prof($fullname, $email, $user_id);
            if($chk==true){
                //$success = "Account Created Successfully!";
                echo '<script>
                        alert("Profile Updated Successfully!");
                </script>';
            }else{
                //$error = "Cannot Add try later";
                echo '<script>
                        alert("Cannot Update try later");
                </script>';
            }
            } catch(Exception $e){
            echo 'Message: '.$e->getMessage();
            }    
    }else{
       //$error = "All fields are mandatory!";
       echo '<script>
            alert("All fields are mandatory!");
        </script>';
    }
}
?>
<div class="row justify-content-center">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-4 align-self-center mb-3 mb-lg-0">
                        <div class="d-flex align-items-center flex-row flex-wrap">
                            <div class="position-relative me-3">
                                <img src="../assets/images/avatar.png" alt="" height="120" class="rounded-circle">
                                <a href="#" class="thumb-md justify-content-center d-flex align-items-center bg-primary text-white rounded-circle position-absolute end-0 bottom-0 border border-3 border-card-bg">
                                    <i class="fas fa-camera"></i>
                                </a>
                            </div>
                            <div class="">
                                <h5 class="fw-semibold fs-22 mb-1"><?php echo $usn; ?></h5>                                                        
                                <p class="mb-0 text-muted fw-medium"><?php echo 'Lecturer'; ?></p>                                                        
                            </div>
                        </div>                                                
                    </div><!--end col-->
                    
                    <div class="col-lg-8 ms-auto align-self-center">
                        <div class="row">
                                <div class="border-dashed rounded border-theme-color p-2 me-2 flex-grow-1 flex-basis-0">
                                <b>Fullname:</b>
                                <p class="text-muted mb-0 fw-medium"><?php echo $fullname; ?></p>
                                </div>
                                <div class="border-dashed rounded border-theme-color p-2 me-2 flex-grow-1 flex-basis-0">
                                <b>Faculty:</b>
                                <p class="text-muted mb-0 fw-medium"><?php echo $faculty; ?></p>
                                </div>
                                <div class="border-dashed rounded border-theme-color p-2 me-2 flex-grow-1 flex-basis-0">
                                <b>Department:</b>
                                <p class="text-muted mb-0 fw-medium"><?php echo $department; ?></p>
                                </div>
                                <div class="border-dashed rounded border-theme-color p-2 me-2 flex-grow-1 flex-basis-0">
                                <b>Email:</b>
                                <p class="text-muted mb-0 fw-medium"><?php echo $mail; ?></p>
                                </div>
                            </div>                                       
                    </div><!--end col-->
                    <center><button data-bs-toggle="modal" data-bs-target="#res" class="col-lg-4 btn btn-blue">Update Profile</button></center>
                    <div class="modal fade" id="res" tabindex="-1" role="dialog" aria-labelledby="exampleModalDefaultLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header" style="background-color: blue;">
                                                <h6 class="modal-title m-0" id="exampleModalDefaultLabel">Edit Profile</h6>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div><!--end modal-header-->
                                            <div class="modal-body">
                                                        <form class="my-4" action="<?php $_SERVER['PHP_SELF'];?>" method="post" enctype="multipart/form-data">            
                                                            <div class="form-group mb-2">
                                                            <input type="hidden" name="lecturer_id" value="<?php echo $user_id; ?>"> 
                                                                <label class="form-label" for="matric">FullName</label>
                                                                <input type="text" class="form-control" id="fullname" name="fullname" placeholder="Enter Fullname" value="<?php echo $fullname; ?>">                               
                                                            </div><!--end form-group--> 
                                                            <div class="form-group mb-2">
                                                                <label class="form-label" for="email">Email</label>
                                                                <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email Address" value="<?php echo $mail; ?>">                               
                                                            </div><!--end form-group--> 
                                                                                                 
                                            </div><!--end modal-body-->
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-blue btn-sm"><input type="hidden" name="updaterec"/> Submit</button>
                                            </div><!--end modal-footer-->
                                            </form><!--end form-->
                                        </div><!--end modal-content-->
                                    </div><!--end modal-dialog-->
                                </div><!--end modal-->
                    
                </div><!--end row-->               
            </div><!--end card-body--> 
        </div><!--end card--> 
    </div> <!--end col-->                                  
</div><!--end row-->


<?php
include_once('footer.php');
?>