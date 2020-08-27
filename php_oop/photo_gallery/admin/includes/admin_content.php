<div class="container-fluid">

<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Admin
            <small>Subheading</small>
            <?php 
            // $user = new User();
            // $user->username = 'test';
            // $user->user_password = 'pass';
            // $user->user_first_name = 'john';
            // $user->user_last_name = 'son';

            // $user->save();

            $user = User::find_user_by_id(1);
            $user->username = 'sneepo';
            $user->save();
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