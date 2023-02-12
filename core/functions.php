<?php
function conn(){
    $host_name = "localhost";
    $username = "root";
    $password = "";
    $db_name = "user_management";
    return mysqli_connect($host_name, $username, $password, $db_name);
};

function url(){
    return "http://{$_SERVER['HTTP_HOST']}/user_management/";
};

function file_patch(){
    return "{$_SERVER['DOCUMENT_ROOT']}/user_management/";
}

function runQuery($sql){
    return mysqli_query(conn(), $sql);
};
function runMultiQuery($sql){
    return mysqli_multi_query(conn(), $sql);
}

function linkTo($link){
    echo "<script>window.location=`$link`;</script>";
}

//auth start
function auth(){
        $username = mysqli_real_escape_string(conn(), $_POST['username']);
        $password = mysqli_real_escape_string(conn(), $_POST['password']);

        if ($username !='' and $password !=''){
            $query = "SELECT * FROM `users` WHERE `username` ='$username'";
            $result = mysqli_query(conn(), $query);
            $row = $result ->fetch_assoc();
            if ($row == null){
                return '
                <div class="alert alert-danger alert-dismissible" role="alert">
                   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    <div class="alert-message">
                       Invalid username or password!
                   </div>
                </div>
                ';
            }elseif ($row['is_active']!=1){
                return '
                <div class="alert alert-danger alert-dismissible" role="alert">
                   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    <div class="alert-message">
                       This account has been deactivated!
                   </div>
                </div>
                ';
            }
            else{
                if (password_verify($password, $row['password'])) {
                    session_start();
                    $_SESSION['loggedin'] = true;
                    $_SESSION['session_username'] = $username;
                    $_SESSION['user_id'] = $row['id'];
                    $_SESSION['session_role'] = $row['role_id'];
                    header('location:dashboard.php');
                } else {
                    return '
                <div class="alert alert-danger alert-dismissible" role="alert">
                   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    <div class="alert-message">
                       Invalid username or password!
                   </div>
                </div>
                ';
                }
            }
        }else{
            return '
                <div class="alert alert-danger alert-dismissible" role="alert">
                   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    <div class="alert-message">
                       You need to input!
                   </div>
                </div>
                ';
        }

}
//auth end

//user start
function create_user(){
    $prefix = isset($_POST['prefix'])  ? $_POST['prefix'] : null;
    $is_active = isset($_POST['is_active'])  ? 1 : 0; //1 value is active
    $gender = isset($_POST['gender']) ? $_POST['gender'] : null;

    $name = $prefix.' '.$_POST['firstName'].' '.$_POST['lastName'];
    $email = $_POST['email'];
    $phone = "09".$_POST['phone'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = isset($_POST['role']) ? $_POST['role'] : null;

    $secure_password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO `users`(`name`, `username`, `role_id`, `phone`, `email`, `password`, `gender`, `is_active`) VALUES ('$name', '$username', $role, '$phone', '$email', '$secure_password', $gender, $is_active)";

    if(runQuery($sql)){
        return linkTo('users.php');
    }else{
        return "Error";
    }
    
}

function edit_user(){
    $id = $_GET['id'];
    $prefix = isset($_POST['prefix'])  ? $_POST['prefix'] : null;
    $is_active = isset($_POST['is_active'])  ? 1 : 0; //1 value is active
    $gender = isset($_POST['gender']) ? $_POST['gender'] : null;

    $name = $prefix.' '.$_POST['firstName'].' '.$_POST['lastName'];
    $email = $_POST['email'];
    $phone = "09".$_POST['phone'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = isset($_POST['role']) ? $_POST['role'] : null;


    if($password == ''){
        $secure_password = password_hash($password, PASSWORD_DEFAULT);
        $sql = "UPDATE `users` SET `name` = '$name', `username` = '$username', `role_id` = '$role', `phone` = '$phone', `email` = '$email', `gender` = '$gender', `is_active` = '$is_active' WHERE `id` = $id";
        runQuery($sql);
        return linkTo('users.php');
        
    }else{
        $secure_password = password_hash($password, PASSWORD_DEFAULT);
        $sql = "UPDATE `users` SET `name` = '$name', `username` = '$username', `role_id` = '$role', `phone` = '$phone', `email` = '$email', `password` = '$secure_password', `gender` = '$gender', `is_active` = '$is_active' WHERE `id` = $id";
        runQuery($sql);
        return linkTo('users.php');
    }

}

function pwd_change(){
    $id = $_GET['id'];
    $current_pwd = $_POST['current_pwd'];
    $new_pwd = $_POST['new_pwd'];

    $row = fetch_user($id) -> fetch_assoc();



    if(password_verify($current_pwd, $row['password'])){
        $secure_password = password_hash($new_pwd, PASSWORD_DEFAULT);
        $sql = "UPDATE `users` SET `password` = '$secure_password' WHERE `id` = $id";
        runQuery($sql);
        return linkTo('profile.php');
    }else{
        return '
                <div class="alert alert-danger alert-dismissible" role="alert">
                   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    <div class="alert-message">
                       Incorrect password!
                   </div>
                </div>
                ';
    }


}

function delete_user(){
    $id = $_GET['deleteUser'];
    $sql = "DELETE FROM `users` WHERE `id` = $id";

    if(runQuery($sql)){   
        return linkTo('users.php');
    }
   
}

function fetch_all_user(){
    $sql = "SELECT * FROM `users`";
    return runQuery($sql);
}

function fetch_user($id){
    $sql = "SELECT * FROM `users` WHERE `id` = $id";
    return runQuery($sql);
};

function checkPrefix($name){
    if(str_starts_with($name, 'Mrs') == true){
        return 'Mrs';
     }elseif(str_starts_with($name, 'Mr') == true){
        return 'Mr';
     }elseif(str_starts_with($name, 'Miss') == true){
        return 'Miss';
     }else{
        return '';
     }
}

function usersCount(){
    $sql = "SELECT COUNT(id) FROM `users`";
    return mysqli_fetch_assoc(runQuery($sql));
}
//user end


//role start

function create_role(){
    $roleName = $_POST['name'];

    //Buttons
    $viewButtons = isset($_POST['viewButtons']) ? $_POST['viewButtons'] : null;
    

    //User
    $viewUser = isset($_POST['viewUser']) ? $_POST['viewUser'] : null;  
    $addUser = isset($_POST['addUser']) ? $_POST['addUser'] : null;
    $editUser = isset($_POST['editUser']) ? $_POST['editUser'] : null;
    $deleteUser = isset($_POST['deleteUser']) ? $_POST['deleteUser'] : null;  
    //Role
    $viewRole = isset($_POST['viewRole']) ? $_POST['viewRole'] : null;  
    $addRole = isset($_POST['addRole']) ? $_POST['addRole'] : null;
    $editRole = isset($_POST['editRole']) ? $_POST['editRole'] : null;
    $deleteRole = isset($_POST['deleteRole']) ? $_POST['deleteRole'] : null;    


    $sql = "INSERT INTO `roles` (`name`) VALUES ('$roleName')";
    

    if(runQuery($sql)){
        $sql = "SELECT `id` FROM `roles` WHERE `name` = '$roleName'";
        if($row = runQuery($sql) -> fetch_assoc()){
            $role_id = $row['id'];
            $sql = "INSERT INTO `role_permissions`(`role_id`, `permissions_id`) VALUES 
            ('$role_id','$viewButtons'), 
            ('$role_id','$viewUser'),
            ('$role_id','$addUser'), 
            ('$role_id','$editUser'),
            ('$role_id','$deleteUser'),
            ('$role_id','$viewRole'),
            ('$role_id','$addRole'), 
            ('$role_id','$editRole'),
            ('$role_id','$deleteRole')
            ";

            runMultiQuery($sql);
            return linkTo('roles.php');
        }
        
        
    }
    
}

function edit_role(){
    $id = $_GET['id'];
    $roleName = $_POST['name'];

    //Buttons
    $viewButtons = isset($_POST['viewButtons']) ? $_POST['viewButtons'] : null;


    //User
    $viewUser = isset($_POST['viewUser']) ? $_POST['viewUser'] : null;
    $addUser = isset($_POST['addUser']) ? $_POST['addUser'] : null;
    $editUser = isset($_POST['editUser']) ? $_POST['editUser'] : null;
    $deleteUser = isset($_POST['deleteUser']) ? $_POST['deleteUser'] : null;
    //Role
    $viewRole = isset($_POST['viewRole']) ? $_POST['viewRole'] : null;
    $addRole = isset($_POST['addRole']) ? $_POST['addRole'] : null;
    $editRole = isset($_POST['editRole']) ? $_POST['editRole'] : null;
    $deleteRole = isset($_POST['deleteRole']) ? $_POST['deleteRole'] : null;

    $sql = "UPDATE `roles` SET `name`='$roleName' WHERE `id` = $id";


    if(runQuery($sql)){
        $sql = "SELECT `id` FROM `roles` WHERE `name` = '$roleName'";
        if($row = runQuery($sql) -> fetch_assoc()){
            $role_id = $row['id'];

            $sql1 = "SELECT `id` FROM `role_permissions` WHERE `role_id` = $role_id";
            $data = runQuery($sql1);
            if ($data -> num_rows > 0){
                foreach ($data as $row1){
                    $role_permissions_id[]=$row1['id'];
                }
            }

            $sql = "UPDATE `role_permissions` SET `permissions_id`='$viewButtons' WHERE `id` = $role_permissions_id[0];
                    UPDATE `role_permissions` SET `permissions_id`='$viewUser' WHERE `id` = $role_permissions_id[1];
                    UPDATE `role_permissions` SET `permissions_id`='$addUser' WHERE `id` = $role_permissions_id[2];
                    UPDATE `role_permissions` SET `permissions_id`='$editUser' WHERE `id` = $role_permissions_id[3];
                    UPDATE `role_permissions` SET `permissions_id`='$deleteUser' WHERE `id` = $role_permissions_id[4];
                    UPDATE `role_permissions` SET `permissions_id`='$viewRole' WHERE `id` = $role_permissions_id[5];
                    UPDATE `role_permissions` SET `permissions_id`='$addRole' WHERE `id` = $role_permissions_id[6];
                    UPDATE `role_permissions` SET `permissions_id`='$editRole' WHERE `id` = $role_permissions_id[7];
                    UPDATE `role_permissions` SET `permissions_id`='$deleteRole' WHERE `id` = $role_permissions_id[8];";
            runMultiQuery($sql);
            return linkTo('roles.php');
        }


    }

}

function delete_role(){
    $id = $_GET['deleteRole'];
    $sql1 = "DELETE FROM `roles` WHERE `id` = $id";
    $sql2 = "DELETE FROM `role_permissions` WHERE `role_id` = $id";

    if(runQuery($sql1)&&runQuery($sql2)){
        return linkTo('roles.php');
    }
   
}

function fetch_all_role(){
    $sql = "SELECT * FROM `roles`";
    return runQuery($sql);
};

function fetch_role($id){
    $sql = "SELECT * FROM `roles` WHERE `id` = $id";
    return runQuery($sql);
};

function fetch_role_permissions($id){
    $sql = "SELECT * FROM `role_permissions` WHERE `role_id` = $id";
    return runQuery($sql);
}

function rolesCount(){
    $sql = "SELECT COUNT(id) FROM `roles`";
    return mysqli_fetch_assoc(runQuery($sql));
}
//role end
