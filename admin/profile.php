<?php
include_once('header.php');
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
                                <b>Email:</b>
                                <p class="text-muted mb-0 fw-medium"><?php echo $mail; ?></p>
                                </div>
                            </div>                                       
                    </div><!--end col-->
            </div><!--end row-->               
            </div><!--end card-body--> 
        </div><!--end card--> 
    </div> <!--end col-->                                  
</div><!--end row-->


<?php
include_once('footer.php');
?>