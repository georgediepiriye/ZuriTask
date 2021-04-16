<?php 

session_start();
if(isset($_SESSION['id'])){
    header('Location: home.php');
    exit();
}else{
    if(isset($_POST['login'])){
       $username = trim($_POST['username']);
       $password = trim($_POST['password']);

             if(!empty($username) && !empty($password)){
                $id = $username . $password;
                $file = file_get_contents('file.db');
                 $file = json_decode($file, true);
                     if (array_key_exists($id,$file)){
                        session_start();
                        $_SESSION['id'] = $id;
                         header('Location:home.php');

                    }else{
                          echo 'Wrong credentials';
                     }

               }else{
                   echo 'fill both fields';
               }
    }
}
   

?>
   <h2>Login</h2><br><br>
   <form method="post">
    Username: <input type="text" name="username"><br><br>
    Password: <input type="password" name="password"><br><br>
    <input type="submit" name="login" value="Login">
   </form>
<a href="register.php">SignUp</a>
<br><br>
<?php
     if(isset($_GET['status'])){
         if($_GET['status']==="registered"){
             echo 'Registration successful,please login';
         }
     }

?>