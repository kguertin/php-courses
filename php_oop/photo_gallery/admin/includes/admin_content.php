<div class="container-fluid">

<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Admin
            <small>Subheading</small>
            <?php 
                $users = User::find_all_users();
                foreach($users as $user){
                    echo $user->username . "<br />";
                }

                // while($row = mysqli_fetch_array($result)){
                //     echo $row['username'] . "<br />";
                // }

                // $find_user = User::find_user_by_id(1);
                // $current_user = User::instantiation($find_user); 
                // echo $current_user->username;


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