<?php
include_once('header.php');
if(isset($_POST['updaterec'])){
    $result_id = secure($_POST['result_id']);
    $matric_no = secure($_POST['matric_no']);
    $session = secure($_POST['session']);
    $semester = secure($_POST['semester']);
    $exam = secure($_POST['exam']);
    $test = secure($_POST['test']);
    if(!empty($matric_no) || !empty($exam) || !empty($test)){
        try{
        $chk = update_res($matric_no, $semester, $session, $test, $exam, $result_id);
            if($chk==true){
                //$success = "Account Created Successfully!";
                echo '<script>
                        alert("Result Updated Successfully!");
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
            <div class="card-header">
                <div class="row align-items-center">
                    <div class="col">                      
                        <center><h1 class="card-title text-blue">-- Student Results -- </h1> </center>
                        </div><!--end col-->
                </div>  <!--end row-->                                  
            </div><!--end card-header-->
            <div class="card-body pt-0">
                <div class="table-responsive">
                    <table class="table datatable" id="datatable_1">
                        <thead class="table-light">
                            <tr>
                            <th>MatricNo</th>
                            <th>Level</th>
                            <th>Session</th>
                            <th>Semester</th>
                            <th>Exam</th>
                            <th>Test</th>
                            <th>Total</th>
                            <th>Grade</th>
                            <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        $table = 'scoresheet';
                        $ft = fetch_data($table);
                        if(mysqli_num_rows($ft) > 0){
                        while ($fetch = $ft->fetch_assoc()) { 
                            $result_id = $fetch['id'];
                            $matric_no = $fetch['matric_no'];
                            $level = $fetch['level'];
                            $session = $fetch['session'];
                            $semester = $fetch['semester'];
                            $exam = $fetch['exam'];
                            $test = $fetch['test'];
                            $total = $exam + $test;
                            if($total >= 70){
                                $grade = 'A';
                            }
                             else if($total >= 60){
                                $grade = 'B';
                            }
                            else  if($total >= 50){
                                $grade = 'C';
                            }
                             else if($total >= 45){
                                $grade = 'D';
                            }
                            else  if($total >= 40){
                                $grade = 'E';
                            }
                            else{
                                $grade = 'F';
                            }
                            $date = $fetch['date'];
                        ?>
                            <tr>
                            <td><a style="color: blue;" href="view_user?matric_no=<?php echo $matric_no; ?>"><?php echo $matric_no; ?></a></td>
                                 <td><?php echo $level; ?></td>
                                <td><?php echo $session; ?></td>
                                <td><?php echo $semester; ?></td>
                                <td><?php echo $exam; ?></td>
                                <td><?php echo $test; ?></td>
                                <td><?php echo $total; ?></td>
                                <td><?php echo $grade; ?></td>
                                <td><a style="color: blue; color: white;" data-bs-toggle="modal" data-bs-target="#res<?php echo $result_id; ?>" class="btn btn-blue">Edit</a>  <a class="del btn btn-danger" id="<?php echo $result_id; ?>">X</a></td>
                            </tr>
                            <div class="modal fade" id="res<?php echo $result_id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalDefaultLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header" style="background-color: blue;">
                                                <h6 class="modal-title m-0" id="exampleModalDefaultLabel">Edit Result</h6>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div><!--end modal-header-->
                                            <div class="modal-body">
                                                        <form class="my-4" action="<?php $_SERVER['PHP_SELF'];?>" method="post" enctype="multipart/form-data">            
                                                            <div class="form-group mb-2">
                                                            <input type="hidden" name="result_id" value="<?php echo $result_id; ?>"> 
                                                                <label class="form-label" for="matric">Matric No</label>
                                                                <input type="text" class="form-control" id="matric" name="matric_no" placeholder="Enter Matric No" value="<?php echo $matric_no; ?>">                               
                                                            </div><!--end form-group--> 
                                                             <div class="form-group mb-2">
                                                                <label class="form-label" for="session">Session</label> 
                                                                <select class="form-control" name="session" id="session" >
                                                                    <option selected><?php echo $session; ?></option>
                                                                    <option>2019/2020</option>
                                                                    <option>2020/2021</option>
                                                                    <option>2021/2022</option>
                                                                    <option>2022/2023</option>
                                                                    <option>2023/2024</option>
                                                                    <option>2024/2025</option>
                                                                    <option>2025/2026</option>
                                                                    <option>2026/2027</option>
                                                                </select>                                           
                                                            </div><!--end form-group--> 
                                                            <div class="form-group mb-2">
                                                                <label class="form-label" for="semester">Semester</label> 
                                                                <select class="form-control" name="semester" id="semester" >
                                                                    <option selected><?php echo $semester; ?></option>
                                                                    <option>first</option>
                                                                    <option>second</option>
                                                                </select>                                           
                                                            </div><!--end form-group--> 
                                                            <div class="form-group mb-2">
                                                                <label class="form-label" for="coursecode">Test</label>
                                                                <input type="text" class="form-control" id="test" name="test" placeholder="Enter Test Score" value="<?php echo $test; ?>">                               
                                                            </div><!--end form-group--> 
                                                            <div class="form-group mb-2">
                                                                <label class="form-label" for="coursecode">Exam</label>
                                                                <input type="text" class="form-control" id="exam" name="exam" placeholder="Enter Exam Score" value="<?php echo $exam; ?>">                               
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
                            <?php }  }else{
                                echo 'No record yet!';
                            }  ?>                                                                                    
                        </tbody>
                        </table>
                </div>   
            </div><!--end card-body--> 
        </div><!--end card--> 
    </div> <!--end col-->                                                        
</div><!--end row-->

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