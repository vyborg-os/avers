<?php
include_once('header.php');
if(isset($_POST['reg'])){
    $username = secure($_POST['username']);
    $email = secure($_POST['email']);
    $pass = secure($_POST['password_hash']);
    $password_hash = password_hash($pass, PASSWORD_BCRYPT);
    $role = secure($_POST['role']);
    $table = 'users';
    if(!empty($email) || !empty($username) || !empty($pass)){
        if(user_exist($username, $email, $table)==true){
        //    $error = "Account Already Exist!";
           echo '<script>
                alert("Account Already Exist!");
           </script>';
        }else{
            try{
            $chk = add_user_($username,$email,$password_hash,$role);
                if($chk==true){
                    //$success = "Account Created Successfully!";
                    echo '<script>
                            alert("Account Created Successfully!");
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
                        <center><h2 class="card-title text-blue">Students Record</h2> </center>
                        </div><!--end col-->
                </div>  <!--end row-->                                  
            </div><!--end card-header-->
            <div class="card-body pt-0">
                <div class="table-responsive">
                    <table class="table datatable" id="datatable_1">
                        <thead class="table-light">
                            <tr>
                            <th>Fullname</th>
                            <th>Matric No</th>
                            <th>Faculty</th>
                            <th>Department</th>
                            <th>Level</th>
                            <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        $table = 'students';
                        $ft = fetchrecord($table);
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
                            <tr>
                                <td><?php echo $fullname; ?></td>
                                <td><?php echo $matric; ?></td>
                                <td><?php echo $faculty; ?></td>
                                <td><?php echo $department; ?></td>
                                <td><?php echo $level; ?></td>
                                <td><a class="btn btn-secondary" href="view_user?matric_no=<?php echo $matric; ?>">View</a></td>
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