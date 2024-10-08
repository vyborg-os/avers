<?php
include_once('header.php');
?>
<div class="row justify-content-center">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="row align-items-center">
                    <div class="col">                      
                        <center><h2 class="card-title text-blue">Your Outstanding Courses</h2> </center>
                        </div><!--end col-->
                </div>  <!--end row-->                                  
            </div><!--end card-header-->
            <div class="card-body pt-0">
                <div class="table-responsive">
                    <?php 
                    $matric_no = $matric;
                    $ft = getOutstanding($matric_no);
                    if(mysqli_num_rows($ft) > 0){
                        echo "<table border='1' class='table table-hoverable'>
							<tr style='background-color: #0F96F9;'>
								<th style='color: white;'>Course</th>
								<th style='color: white;'>Level</th>
								<th style='color: white;'>Exam</th>
								<th style='color: white;'>Test</th>
								<th style='color: white;'>Total</th>
								<th style='color: white;'>Grade</th>
							</tr>";
                        while ($fetch = $ft->fetch_assoc()) { 
                            $course_id = $fetch['course_id'];
                            $course_code = $fetch['course_code'];
                            $test = $fetch['test'];
                            $exam = $fetch['exam'];
                            $level = $fetch['level'];
                            $total = $exam + $test;
                            if ($total >= 70) {
                                $grade =  'A';
                            } elseif ($total >= 60) {
                                $grade =  'B';
                            } elseif ($total >= 50) {
                                $grade =  'C';
                            } elseif ($total >= 45) {
                                $grade =  'D';
                            } elseif ($total >= 40) {
                                $grade =  'E';
                            } else {
                                $grade = 'F';
                            }
                            
                            echo "
						     <tr>
								<td>$course_code</td>
								<td>$level</td>
								<td>$exam</td>
								<td>$test</td>
								<td>$total</td>
								<td>$grade</td>
							  </tr> </table>";
                        }
                    }else{ echo 'No outstanding courses';}
                    ?>
                </div>   
            </div><!--end card-body--> 
        </div><!--end card--> 
    </div> <!--end col-->                                                        
</div><!--end row-->


<?php
include_once('footer.php');
?>