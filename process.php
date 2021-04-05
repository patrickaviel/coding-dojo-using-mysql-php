<!-- PATRICK AVIEL PERALTA -->
<?php
    session_start();

    require('new-connection.php');

    if(isset($_POST['action'])&&$_POST['action']=='register'){
        var_dump($_POST);
        register_user($_POST);
    }elseif(isset($_POST['action'])&&$_POST['action']=='login'){
        var_dump($_POST);
        login_user($_POST);
    }else{
        session_destroy();
        header('location:index.php');
    }

    function register_user($post){
        $error=0;
        if(empty($post['first_name'])){
            $_SESSION['fname_error']="Please enter your first name!";
            $error++;
        }
        if(is_numeric($post['first_name'])){
            $_SESSION['fname_error']="Name cannot contain numbers!";
            $error++;
        }
        if(strlen($post['first_name'])<2){
            $_SESSION['fname_error']="Name must contain more than 2 characters!";
            $error++;
        }
        if(empty($post['last_name'])){
            $_SESSION['lname_error']="Please enter your last name!";
            $error++;
        }
        if(strlen($post['last_name'])<2){
            $_SESSION['lname_error']="Name must contain more than 2 characters!";
            $error++;
        }
        if(is_numeric($post['last_name'])){
            $_SESSION['lname_error']="Name cannot contain numbers!";
            $error++;
        }
        if(empty($post['password'])){
            $_SESSION['pass_error']="Please enter your password!";
            $error++;
        }
        if(strlen($post['password'])<8){
            $_SESSION['pass_error']="Password must be at least 8 characters long!";
            $error++;
        }
        if(empty($post['c_password'])){
            $_SESSION['cpass_error']="Please enter your password!";
            $error++;
        }
        if($post['password']!=$post['c_password']){
            $_SESSION['pass_error']="Passwords do not match!";
            $_SESSION['cpass_error']="Passwords do not match!";
            $error++;
        }
        if(!filter_var($post['email'], FILTER_VALIDATE_EMAIL)){
            $_SESSION['email_error']="Invalid email!";
        }
        if($error>0){
            header('Location:index.php');
            die();
        }else{
            $check_query="SELECT * FROM users WHERE users.email = '{$post['email']}'";
            $user = fetch_all($check_query);
            if(count($user)>0){
                $_SESSION['reg_message']="User already exists!";
                header('location:index.php');
                die();
            }else{
                $encrypted_password = md5($post['password']);
                $query="INSERT INTO users (first_name,last_name,email,password,created_at,updated_at) VALUES 
                    ('{$post['first_name']}','{$post['last_name']}','{$post['email']}','$encrypted_password',
                    NOW(),NOW())";
                run_mysql_query($query);
                $_SESSION['message']="User successfully created!";
                header('location:index.php');
                die();
            }
        }
    }

    function login_user($post){
        $error=0;
        if(!filter_var($post['email'], FILTER_VALIDATE_EMAIL)){
            $_SESSION['lg_email_error']="Invalid email!";
        }
        if(empty($post['password'])){
            $_SESSION['lg_pass_error']="Invalid password!";
           
            $error++;
        }
        if($error>0){
            header('Location:index.php');
            die();
        }else{
            $password = md5($post['password']);
            $check_query="SELECT * FROM users WHERE users.email = '{$post['email']}' AND users.password = '$password'";
            $user = fetch_all($check_query);
            if(count($user)>0){
                $_SESSION['user_id']= $user[0]['id'];
                $_SESSION['first_name']= $user[0]['first_name'];
                $_SESSION['email']= $user[0]['email'];
                $_SESSION['logged_in']= true;
                header('location:success.php');
                die();
                
            }else{
                $_SESSION['lg_error']="User not found!";
                header('location:index.php');
                die();
            }
        }
    }
?>