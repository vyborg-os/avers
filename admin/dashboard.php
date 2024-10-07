<?php
include_once('header.php');
?>
<div class="row justify-content-center">
<div class="col-md-6 col-lg-3">
    <div class="card" style="background-color: blue; color: white">
        <div class="card-body">
            <div class="row d-flex justify-content-center border-dashed-bottom pb-3">
                <div class="col-9">
                    <p class="text-white mb-0 fw-semibold fs-14">Total Results</p>
                    <h3 class="mt-2 mb-0 fw-bold">
                        <?php
                        $table = 'scoresheet';
                        $ft = fetchrecord($table);
                        echo mysqli_num_rows($ft);
                        ?>
                    </h3>
                </div>
                <!--end col-->
                <div class="col-3 align-self-center">
                    <div class="d-flex justify-content-center align-items-center thumb-xl bg-light rounded-circle mx-auto">
                        <i class="iconoir-user h1 align-self-center mb-0 text-secondary"></i>
                    </div>
                </div>
                <!--end col-->
            </div>
            <!--end row-->
        </div>
        <!--end card-body-->
    </div>
    <!--end card-->
</div>
<!--end col-->
<div class="col-md-6 col-lg-3">
    <div class="card" style="background-color: grey; color: white;">
        <div class="card-body">
            <div class="row d-flex justify-content-center border-dashed-bottom pb-3">
                <div class="col-9">
                    <p class="text-white mb-0 fw-semibold fs-14">Total Lecturers</p>
                    <h3 class="mt-2 mb-0 fw-bold">
                    <?php
                        $table = 'lecturer';
                        $ft = fetchrecord($table);
                        echo mysqli_num_rows($ft);
                        ?>
                    </h3>
                </div>
                <!--end col-->
                <div class="col-3 align-self-center">
                    <div class="d-flex justify-content-center align-items-center thumb-xl bg-light rounded-circle mx-auto">
                        <i class="iconoir-clock h1 align-self-center mb-0 text-secondary"></i>
                    </div>
                </div>
                <!--end col-->
            </div>
            <!--end row-->
        </div>
        <!--end card-body-->
    </div>
    <!--end card-->
</div>
<!--end col-->
<div class="col-md-6 col-lg-3">
    <div class="card" style="background-color: orange; color: white">
        <div class="card-body">
            <div class="row d-flex justify-content-center border-dashed-bottom pb-3">
                <div class="col-9">
                    <p class="text-white mb-0 fw-semibold fs-14">Total Students</p>
                    <h3 class="mt-2 mb-0 fw-bold">
                    <?php
                        $table = 'students';
                        $ft = fetchrecord($table);
                        echo mysqli_num_rows($ft);
                        ?>
                    </h3>
                </div>
                <!--end col-->
                <div class="col-3 align-self-center">
                    <div class="d-flex justify-content-center align-items-center thumb-xl bg-light rounded-circle mx-auto">
                        <i class="iconoir-percentage-circle h1 align-self-center mb-0 text-secondary"></i>
                    </div>
                </div>
                <!--end col-->
            </div>
        </div>
        <!--end card-body-->
    </div>
    <!--end card-->
</div>
<div class="col-md-6 col-lg-3">
    <div class="card" style="background-color: lightblue; color: white">
        <div class="card-body">
            <div class="row d-flex justify-content-center border-dashed-bottom pb-3">
                <div class="col-9">
                    <p class="text-white mb-0 fw-semibold fs-14">Total Course</p>
                    <h3 class="mt-2 mb-0 fw-bold">
                    <?php
                        $table = 'course';
                        $ft = fetchrecord($table);
                        echo mysqli_num_rows($ft);
                        ?>
                    </h3>
                </div>
                <!--end col-->
                <div class="col-3 align-self-center">
                    <div class="d-flex justify-content-center align-items-center thumb-xl bg-light rounded-circle mx-auto">
                        <i class="iconoir-percentage-circle h1 align-self-center mb-0 text-secondary"></i>
                    </div>
                </div>
                <!--end col-->
            </div>
        </div>
        <!--end card-body-->
    </div>
    <!--end card-->
</div>
<!--end col-->
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-5 offset-lg-1 align-self-center">
                        <div class="p-3">
                            <span class="bg-pink-subtle p-1 rounded text-pink fw-medium"><?php echo 'Date: '.date('Y-m-d'); ?> </span>
                            <h1 class="my-4 font-weight-bold">Welcome to AVERS <span class="text-blue">AAUA</span>.</h1>
                            
                            <a href="results" class="btn btn-blue">View Student Results</a>
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