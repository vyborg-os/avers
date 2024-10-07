<?php
include_once('header.php');
?>
<div class="row justify-content-center">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="row align-items-center">
                    <div class="col">                      
                        <center><h2 class="card-title text-blue">Your Results</h2> </center>
                        </div><!--end col-->
                </div>  <!--end row-->                                  
            </div><!--end card-header-->
            <div class="card-body pt-0">
                <div class="table-responsive">
                    <?php 
                    $matric_no = $matric;
                    echo fetch_std_result($matric_no);
                    ?>
                </div>   
            </div><!--end card-body--> 
        </div><!--end card--> 
    </div> <!--end col-->                                                        
</div><!--end row-->


<?php
include_once('footer.php');
?>