<?php
include_once('header.php');
?>
<div class="row justify-content-center">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <?php
                if(isset($_GET['matric_no'])){
                    $matric_no = $_GET['matric_no'];
                    $ft = fetch_u_data($matric_no);
                    if(mysqli_num_rows($ft) > 0){
                        while ($fetch = $ft->fetch_assoc()) { 
                            $student_id = $fetch['student_id'];
                            $fullname = ucfirst($fetch['fullname']);
                            $mail = $fetch['email'];
                            $department = $fetch['department'];
                            $faculty = $fetch['faculty'];
                            $level = $fetch['level'];
                            $matric = ucfirst($fetch['matric_no']);
                            $date = $fetch['date'];

                
                ?>
                <div class="row">
                    <div class="col-lg-4 align-self-center mb-3 mb-lg-0">
                        <div class="d-flex align-items-center flex-row flex-wrap">
                            <div class="position-relative me-3">
                                <h5 style="color: #570861;">Student Information</h5>
                            </div>
                            <div class="">
                                <h5 class="fw-semibold fs-22 mb-1"><?php echo $fullname; ?></h5>                                                        
                                <p class="mb-0 fw-medium" style="color: red;"><?php echo $level; ?> Level</p>                                                        
                            </div>
                        </div>                                                
                    </div><!--end col-->
                    
                    <div class="col-lg-8 ms-auto align-self-center">
                        <div class="row">
                            <div class="border-dashed rounded border-theme-color p-2 me-2 flex-grow-1 flex-basis-0">
                            <b>Faculty:</b>
                            <p class="text-muted mb-0 fw-medium"><?php echo $faculty; ?></p>
                            </div>
                            <div class="border-dashed rounded border-theme-color p-2 me-2 flex-grow-1 flex-basis-0">
                            <b>Department:</b>
                            <p class="text-muted mb-0 fw-medium"><?php echo $department; ?></p>
                            </div>
                        </div> 
                        <div class="row mt-3">
                            <div class="border-dashed rounded border-theme-color p-2 me-2 flex-grow-1 flex-basis-0">
                            <b>Mail:</b>
                            <p class="text-muted mb-0 fw-medium"><?php echo $mail; ?></p>
                            </div>
                            <div class="border-dashed rounded border-theme-color p-2 me-2 flex-grow-1 flex-basis-0">
                            <b>Matric No:</b>
                            <p class="text-muted mb-0 fw-medium"><?php echo $matric_no; ?></p>
                            </div>
                        </div>                              
                    </div><!--end col-->
                    
                </div><!--end row-->  
                <div class="row mt-3 border-dashed rounded border-theme-color">
                            <?php 
                            $matric_no = $matric;
                            echo fetch_std_result($matric_no); ?>
                        </div>   
                <?php } }else{echo 'No Records';}  } ?>        
            </div><!--end card-body--> 
        </div><!--end card--> 
    </div> <!--end col-->                                  
</div><!--end row-->

<script src="./assets/js/jquery.min.js"></script>
<script type="text/javascript">
 $(document).ready(function(){
 $('.del').click(function(){
    var del = $(this).attr("id");
    if(confirm("Confirm Delete?")){
        $.ajax({
        url:'ajax.php',
        method:'POST',
        data:'del='+del,
        success:function(data){
            alert(data);
            location.reload();
        },
        error: function(data){
            alert(data);
            location.reload();
        }
        });
                            
    }
});
 })
 $(document).ready(function(){
 $('.cls').click(function(){
    var cls = $(this).attr("id");
    if(confirm("Close Case?")){
        $.ajax({
        url:'ajax.php',
        method:'POST',
        data:'cls='+cls,
        success:function(data){
            alert(data);
            location.reload();
        },
        error: function(data){
            alert(data);
            location.reload();
        }
        });
                            
    }
});
 })
</script> 
<?php
include_once('footer.php');
?>