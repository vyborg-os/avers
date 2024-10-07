<?php
include_once('header.php');
?>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-5 offset-lg-1 align-self-center">
                        <div class="p-3">
                            <span class="bg-pink-subtle p-1 rounded text-pink fw-medium"><?php echo 'Date: '.date('Y-m-d'); ?> </span>
                            <h1 class="my-4 font-weight-bold">Welcome to AVERS <span class="text-blue">AAUA</span>.</h1>
                            
                            <a href="uploaded_results" class="btn btn-blue">View Student Results</a>
                        </div>
                    </div><!--end col-->
                    <div class="col-lg-5">
                        <img src="../assets/images/logo-sm.png" width="250px" style="float: right;"/>
                    </div>
                </div><!--end row-->
            </div><!--end card-body-->
        </div><!--end card-->
    </div><!--end col-->
</div><!--end row-->
<?php
include_once('footer.php');
?>