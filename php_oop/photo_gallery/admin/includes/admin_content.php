<div class="container-fluid">

<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Admin
            <small>Subheading</small>
            <?php 

            $test = new User();
            $test->username = 'pestering';
            $test->user_first_name = 'Kevin';
            $test->user_last_name = 'Test';
            $test->user_password = 123;

            $test->create();
            echo $test->user_id
            ?>
        </h1>
        <ol class="breadcrumb">
            <li>
                <i class="fa fa-dashboard"></i>  <a href="index.html">Dashboard</a>
            </li>
            <li class="active">
                <i class="fa fa-file"></i> Blank Page
            </li>
        </ol>
    </div>
</div>
<!-- /.row -->

</div>