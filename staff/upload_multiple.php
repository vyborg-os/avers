<?php
include_once('header.php');
if(isset($_POST['addrec'])){
    if (isset($_FILES['csv_file']) && $_FILES['csv_file']['error'] == 0) {
        $fileTmpPath = $_FILES['csv_file']['tmp_name'];
        $fileName = $_FILES['csv_file']['name'];
        $fileType = $_FILES['csv_file']['type'];
        $fileSize = $_FILES['csv_file']['size'];
        $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        // Check file extension
        if ($fileExtension === 'csv') {
            // Open the file and read its contents
            if (($handle = fopen($fileTmpPath, 'r')) !== FALSE) {
                // Skip the header row if needed
                fgetcsv($handle);

                $lecturer_id = $user_id;
                $session = secure($_POST['session']);
                $semester = secure($_POST['semester']);
                $level = secure($_POST['level']);
                $course_code = secure($_POST['course_code']);
                // $course_id = fetch_course($course_code);

                if(!empty($matric_no) || !empty($course_code) || !empty($level)){
                    try{
                         // Track successful inserts
                        $successCount = 0;
                        $errorCount = 0;
                        while (($data = fgetcsv($handle, 1000, ',')) !== FALSE) {
                            // Extract dynamic values (matric_no, test, exam)
                            $matric_no = secure($data[0]);
                            $test = secure($data[1]);
                            $exam = secure($data[2]);
                            $chk = add_result($matric_no, $semester, $session, $level, $test, $exam, $lecturer_id, $course_code);
                                if($chk==true){
                                    $successCount++;
                                }else{
                                    $errorCount;;
                                }
                            }
                            fclose($handle);
                            echo '<script>
                            alert("'.$successCount.' records inserted successfully!");
                            </script>';
                            if ($errorCount > 0) {
                                echo '<script>
                            alert("'.$errorCount.' records inserted successfully!");
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
            } else {
                echo '<script>
                alert("Error opening the file.");
            </script>';
            }
        } else {
            echo '<script>
            alert("Invalid file format. Please upload a CSV file.");
        </script>';
        }
    } else {
        echo '<script>
            alert("Error uploading file.");
        </script>';
    }
}
?>
<div class="row justify-content-center">
    <div class="col-8">
        <div class="card">
            <div class="card-header">
                <div class="row align-items-center">
                    <div class="col">                      
                        <center><h1 class="card-title text-blue">-- Student Results (Upload Multiple) -- </h1> </center>                      
                    </div><!--end col-->
                </div>  <!--end row-->                                  
            </div><!--end card-header-->
            <div class="row">
            <div class="col-lg-10 mx-auto">
                <div class="card">
                        <form class="my-4" action="<?php $_SERVER['PHP_SELF'];?>" method="post" enctype="multipart/form-data">            
                            <div class="form-group mb-2">
                                <label class="form-label" for="level">Course Code</label> 
                                <select class="form-control" name="course_code" id="course_code" >
                                    <option selected disabled>Choose Course Code...</option>
                                    <?php
                                    $ft = fetch_course_code();
                                    while ($fetch = $ft->fetch_assoc()) { 
                                    $code = $fetch['code'];
                                    ?>
                                    <option> <?php echo $code; ?> </option>
                                    <?php
                                    }
                                    ?>
                                </select>                                           
                            </div><!--end form-group--> 
                            <div class="form-group mb-2">
                                <label class="form-label" for="level">Level</label> 
                                <select class="form-control" name="level" id="level" >
                                    <option selected disabled>Choose Level...</option>
                                    <option>100</option>
                                    <option>200</option>
                                    <option>300</option>
                                    <option>400</option>
                                    <option>500</option>
                                    <option>600</option>
                                </select>                                           
                            </div><!--end form-group--> 
                                <div class="form-group mb-2">
                                <label class="form-label" for="session">Session</label> 
                                <select class="form-control" name="session" id="session" >
                                    <option selected disabled>Choose Session...</option>
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
                                    <option selected disabled>Choose Semester...</option>
                                    <option>first</option>
                                    <option>second</option>
                                </select>                                           
                            </div>
                            <div class="form-group mb-2">
                                    <div class="d-grid">
                                        <p class="text-muted">Upload your csv file (it must contain 3 columns, matric_no, test, exam)</p>
                                        <input type="file" class="form-control" id="input-file" name="csv_file" accept="csv/*" onchange={handleChange()} />
                                    </div>             
                                </div><!--end card-body--> 
                            <div class="form-group mb-2">
                               <center> <button type="submit" class="btn btn-blue btn-lg"><input type="hidden" name="addrec"/> Submit</button>  </center>                          
                            </div><!--end form-group--> 
                                                                    
            </div><!--end modal-body-->
            </form><!--end form-->
            </div><!--end modal-->
        </div><!--end card--> 
    </div> <!--end col-->                                                        
</div><!--end row-->

<script src="../assets/js/jquery.min.js"></script>
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