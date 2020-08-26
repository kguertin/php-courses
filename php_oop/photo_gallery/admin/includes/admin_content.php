<div class="container-fluid">

<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Admin
            <small>Subheading</small>
            <?php 
                $user = User::find_user_by_id(4);
                $user->username = 'changed';
                $user->save();

                $user2 = new User();
                $user2->username = 'yeep';
                $user2->user_password = 'yip';
                $user2->user_first_name = 'al';
                $user2->user_last_name = 'bert';
                $user2->save();
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