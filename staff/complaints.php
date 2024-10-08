<?php
include_once('header.php');
if(isset($_POST['updatesec'])){
    $complaints_id = secure($_POST['complaints_id']);
    $feedback = secure($_POST['feedback']);
    $status = secure($_POST['status']);;
 if(!empty($feedback) || !empty($status)){
    try{
            $chk = update_com($complaints_id, $feedback, $status);
                if($chk==true){
                    //$success = "Account Created Successfully!";
                    echo '<script>
                            alert("Complaints Updated Successfully!");
                    </script>';
                }else{
                    //$error = "Cannot Add try later";
                    echo '<script>
                            alert("Cannot Update Complaints try later");
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
<div class="row">
    <div class="col-7">
        <div class="card">
            <div class="card-header">
                <div class="row align-items-center">
                    <div class="col">                      
                        <center><h1 class="card-title text-blue">-- Complaints -- </h1> </center>                      
                    </div><!--end col-->
                </div>  <!--end row-->                                  
            </div><!--end card-header-->
            <div class="row">
            <div class="col-lg-10 mx-auto">
                <div class="card">
                <?php
                    $complaints_id = $_GET['complaints_id'];
                    $ft = getComCid($complaints_id);
                    if(mysqli_num_rows($ft) > 0){
                    while ($fetch = $ft->fetch_assoc()) { 
                        $complaints_id = $fetch['complaints_id'];
                        $matric_no = $fetch['matric_no'];
                        $message = $fetch['message'];
                        $status = $fetch['status'];
                        $feedback = $fetch['feedback'];
                        $date = $fetch['date'];
                        ?>
                        <p><b>Date:</b> <?php echo $date; ?></p>
                        <p><b>Student Matric:</b> <a style="color: blue;" href="view_user?matric_no=<?php echo $matric_no; ?>"><?php echo $matric_no; ?></a></p>
                        <p><b>Message:</b> <?php echo $message; ?></p>
                        <form class="my-4" action="<?php $_SERVER['PHP_SELF'];?>" method="post" enctype="multipart/form-data"> 
                            <input type="hidden" name="complaints_id" value="<?php echo $complaints_id; ?>" />           
                            <div class="form-group mb-2">
                                <label class="form-label" for="feedback">Feedback</label> 
                                <textarea class="form-control" name="feedback"></textarea>                                  
                            </div>    
                        <div class="form-group mb-2">
                                <label class="form-label" for="status">Status</label> 
                                <select class="form-control" name="status" id="status" >
                                    <option selected disabled>Choose status...</option>
                                    <option>pending</option>
                                    <option>solved</option>
                                    <option>escalated</option>
                                </select>                                           
                            </div><!--end form-group--> 
                           
                            <div class="form-group mb-2">
                               <center> <button type="submit" class="btn btn-blue btn-lg"><input type="hidden" name="updatesec"/> Submit</button>  </center>                          
                            </div><!--end form-group--> 
                            <?php } } ?>
                                                                    
            </div><!--end modal-body-->
            </form><!--end form-->
            </div><!--end modal-->
        </div><!--end card--> 
    </div> <!--end col-->                                                       
</div><!--end row-->

<div class="col-lg-5 mb-3">
<?php
$lecturer_id = $user_id;
$ft = getComl($lecturer_id);
if(mysqli_num_rows($ft) > 0){
while ($fetch = $ft->fetch_assoc()) { 
    $complaints_id = $fetch['complaints_id'];
    $matric_no = $fetch['matric_no'];
    $message = $fetch['message'];
    $status = $fetch['status'];
    $feedback = $fetch['feedback'];
    $date = $fetch['date'];
        if($status=='pending'){ ?>
        <div class="card bg-pink-subtle" style="color: black;">
        <span class="bg-pink-subtle p-1 rounded text-pink fw-medium">New/Pending complaints</span>    
        <div style="padding: 20px 20px;">
            <p><b>Date:</b> <?php echo $date; ?></p>
            <p><b>Student Matric:</b> <a style="color: blue;" href="view_user?matric_no=<?php echo $matric_no; ?>"><?php echo $matric_no; ?></a></p>
            <p><b>Message:</b> <?php echo $message; ?></p>
            <p><b>Feedback:</b> <?php echo $feedback; ?></p>
            <p><b>Status:</b> <?php if($status=='pending'){ ?> <span style="color: red;"><?php echo ucfirst($status); ?></span> <?php }else{?><span style="color: blue;"><?php echo ucfirst($status); ?></span> <?php } ?></p>
            </div>
            <div class="row">
            <div class="col-lg-6">
            <a href="complaints?complaints_id=<?php echo $complaints_id; ?>" class="btn btn-pink btn-sm">View</a>
           
            <a class="delc btn btn-danger btn-sm" id="<?php echo $complaints_id; ?>">Delete</a>
            </div>
        </div>
        </div>
    <?php    
    }
        else{
        ?>
    <div class="card">
    <span class="bg-success-subtle p-1 rounded text-success fw-medium">Resolved complaints</span>    
            <div style="padding: 20px 20px;">
            <p><b>Date:</b> <?php echo $date; ?></p>
            <p><b>Student Matric:</b> <a style="color: blue;" href="view_user?matric_no=<?php echo $matric_no; ?>"><?php echo $matric_no; ?></a></p>
            <p><b>Message:</b> <?php echo $message; ?></p>
            <p><b>Feedback:</b> <?php echo $feedback; ?></p>
            <p><b>Status:</b> <?php if($status=='pending'){ ?> <span style="color: red;"><?php echo ucfirst($status); ?></span> <?php }else{?><span style="color: blue;"><?php echo ucfirst($status); ?></span> <?php } ?></p>
            </div>
            <div class="row">
            <div class="col-lg-6">
            <a href="complaints?complaints_id=<?php echo $complaints_id; ?>" class="btn btn-success btn-sm">View</a>
           
            <a class="delc btn btn-danger btn-sm" id="<?php echo $complaints_id; ?>">Delete</a>
            </div>
        </div>
        <?php
        }
        ?>
  
 
<?php } }else{
    echo 'No complaints made yet!';
}
?>
  </div> 
<script src="../assets/js/jquery.min.js"></script>
<script type="text/javascript">
 $(document).ready(function(){
 $('.delc').click(function(){
    var delc = $(this).attr("id");
    if(confirm("Delete this Complaint?")){
        $.ajax({
        url:'ajax.php',
        method:'POST',
        data:'delc='+delc,
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