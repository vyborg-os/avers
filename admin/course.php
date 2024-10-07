<?php
include_once('header.php');
if(isset($_POST['addcourse'])){
    $title = secure($_POST['title']);
    $code = secure($_POST['code']);
    $type = secure($_POST['type']);
    $unit = secure($_POST['unit']);
    if(!empty($title) || !empty($code) || !empty($unit)){
            try{
            $chk = add_course($title,$code,$type,$unit);
                if($chk==true){
                    //$success = "Account Created Successfully!";
                    echo '<script>
                            alert("Course Added Successfully!");
                    </script>';
                }else{
                    //$error = "Cannot Add try later";
                    echo '<script>
                            alert("Cannot Add try later");
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
                        <center><h2 class="card-title text-blue">Offered Courses</h2> </center>
                        <button data-bs-toggle="modal" data-bs-target="#exampleModalDefault" class="btn btn-blue" style="float: right;">Add New Course</button>                     
                    </div><!--end col-->
                </div>  <!--end row-->                                  
            </div><!--end card-header-->
            <div class="modal fade" id="exampleModalDefault" tabindex="-1" role="dialog" aria-labelledby="exampleModalDefaultLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header" style="background-color: blue;">
                            <h6 class="modal-title m-0" id="exampleModalDefaultLabel">Add Course</h6>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div><!--end modal-header-->
                        <div class="modal-body">
                            <div class="row">
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
                                            <label class="form-label" for="title">Course Title</label>
                                            <input type="text" class="form-control" id="title" name="title" placeholder="Enter Course Title">                               
                                        </div><!--end form-group--> 

                                        <div class="form-group mb-2">
                                            <label class="form-label" for="coursecode">Course Code</label>
                                            <input type="text" class="form-control" id="coursecode" name="code" placeholder="Enter Course Code">                               
                                        </div><!--end form-group--> 
                                        <div class="form-group mb-2">
                                            <label class="form-label" for="type">Course Type (C - Compulsory, E - Elective)</label>
                                            <input type="text" class="form-control" id="type" name="type" placeholder="Enter Course Type">                               
                                        </div><!--end form-group--> 
                                        <div class="form-group mb-2">
                                            <label class="form-label" for="coursecode">Course Unit</label>
                                            <input type="text" class="form-control" id="unit" name="unit" placeholder="Enter Course Unit">                               
                                        </div><!--end form-group--> 
        
                            </div><!--end row-->                                                      
                        </div><!--end modal-body-->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-blue btn-sm"><input type="hidden" name="addcourse"/> Submit</button>
                        </div><!--end modal-footer-->
                        </form><!--end form-->
                    </div><!--end modal-content-->
                </div><!--end modal-dialog-->
            </div><!--end modal-->
            <div class="card-body pt-0">
                <div class="table-responsive">
                    <table class="table datatable" id="datatable_1">
                        <thead class="table-light">
                            <tr>
                            <th>CourseTitle</th>
                            <th>CourseCode</th>
                            <th>CourseType</th>
                            <th>CourseUnit</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        $table = 'course';
                        $ft = fetchrecord($table);
                        if(mysqli_num_rows($ft) > 0){
                        while ($fetch = $ft->fetch_assoc()) { 
                            $course_id = $fetch['course_id'];
                            $title = ucfirst($fetch['title']);
                            $code = $fetch['code'];
                            $type = $fetch['type'];
                            $unit = $fetch['unit'];
                        ?>
                            <tr>
                                <td><?php echo $title; ?></td>
                                <td><?php echo $code; ?></td>
                                <td><?php echo $type; ?></td>
                                <td><?php echo $unit; ?></td>
                            </tr>
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


<?php
include_once('footer.php');
?>