<?php
include_once('header.php');
if(isset($_POST['addsec'])){
    $matric_no = $matric;
    $lecturer_id = secure($_POST['lecturer']);
    $message = secure($_POST['message']);
    $status = 'pending';
 if(!empty($lecturer_id) || !empty($message)){
    try{
            $chk = add_com($lecturer_id, $matric_no, $message,$status);
                if($chk==true){
                    //$success = "Account Created Successfully!";
                    echo '<script>
                            alert("Complaints Submitted Successfully!");
                    </script>';
                }else{
                    //$error = "Cannot Add try later";
                    echo '<script>
                            alert("Cannot Submit Complaints try later");
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
    <div class="col-6">
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
                        <form class="my-4" action="<?php $_SERVER['PHP_SELF'];?>" method="post" enctype="multipart/form-data">            
                            <div class="form-group mb-2">
                                <label class="form-label" for="level">Lecturer</label> 
                                <select class="form-control" name="lecturer" id="lecturer" >
                                    <option selected disabled>Choose Lecturer...</option>
                                    <?php
                                    $table = 'lecturer';
                                    $ft = fetchrecord($table);
                                    while ($fetch = $ft->fetch_assoc()) { 
                                    $lect = $fetch['lecturer_id'];
                                    $lect_name = $fetch['fullname'];
                                    ?>
                                    <option value="<?php echo $lect; ?>"> <?php echo $lect_name; ?> </option>
                                    <?php
                                    }
                                    ?>
                                </select>                                           
                            </div><!--end form-group--> 
                            <div class="form-group mb-2">
                                <label class="form-label" for="semester">Message</label> 
                                <textarea class="form-control" name="message"></textarea>                                  
                            </div>
                            <div class="form-group mb-2">
                               <center> <button type="submit" class="btn btn-blue btn-lg"><input type="hidden" name="addsec"/> Submit</button>  </center>                          
                            </div><!--end form-group--> 
                                                                    
            </div><!--end modal-body-->
            </form><!--end form-->
            </div><!--end modal-->
        </div><!--end card--> 
    </div> <!--end col-->                                                       
</div><!--end row-->

<div class="col-lg-6 mb-3">
<?php
$matric_no = $matric;
$ft = getCom($matric_no);
if(mysqli_num_rows($ft) > 0){
while ($fetch = $ft->fetch_assoc()) { 
    $complaints_id = $fetch['complaints_id'];
    $lecturer_id = $fetch['lecturer_id'];
    $message = $fetch['message'];
    $status = $fetch['status'];
    $feedback = $fetch['feedback'];
    $date = $fetch['date'];
    ?>


        <div class="card">
            <div style="padding: 20px 20px;">
            <p><b>Date:</b> <?php echo $date; ?></p>
            <p><b>Lecturer Name:</b> <?php echo getLectName($lecturer_id); ?></p>
            <p><b>Message:</b> <?php echo $message; ?></p>
            <p><b>Feedback:</b> <?php echo $feedback; ?></p>
            <p><b>Status:</b> <?php if($status=='pending'){ ?> <span style="color: orange;"><?php echo ucfirst($status); ?></span> <?php }else{?><span style="color: blue;"><?php echo ucfirst($status); ?></span> <?php } ?></p>
            </div>
        </div>
  
 
<?php } }else{
    echo 'No complaints made yet!';
}
?>
  </div> 
<script src="./assets/js/jquery.min.js"></script>
<script type="text/javascript">
 $(document).ready(function(){
 $('.del').click(function(){
    var del = $(this).attr("id");
    if(confirm("Delete this Result?")){
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
</script> 
<?php
include_once('footer.php');
?>