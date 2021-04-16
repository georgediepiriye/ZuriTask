<?php 
session_start();
     if(isset($_POST['register'])){
         $firstname = trim($_POST['firstname']);
         $lastname = trim($_POST['lastname']);
         $username = trim($_POST['username']);
         $email = trim($_POST['email']);
         $country = trim($_POST['country']);
         $password = trim($_POST['password']);
         $repeat_password = trim($_POST['repeat_password']);
     

         if(!empty($firstname) && !empty($lastname) && !empty($username)
         && !empty($email) && !empty($country) && !empty($password) && !empty($repeat_password)){

            if($password === $repeat_password){
                $id = $username . $password;
                $file = file_get_contents('file.db');
                $file = json_decode($file,true);
                if(empty($file)){
                    $user = array(
                        $id => array(
                            'firstname' => "$firstname",
                            'lastname' => "$lastname",
                            'username' => "$username",
                            'email' => "$email",
                            'country' => "$country",
                            'password' => "$password"
                        )
                     );
                     $userdb = $user;
                     $db =json_encode($userdb, JSON_FORCE_OBJECT);
                } else if (is_array($file)){  
                    $user =  array(
                        'firstname' => "$firstname",
                        'lastname' => "$lastname",
                        'username' => "$username",
                        'email' => "$email",
                        'country' => "$country",
                        'password' => "$password"
                    );
                    $file["$id"] = $user;
                    $db =json_encode($file,JSON_FORCE_OBJECT);
                    }
                       $filename = 'file.db';  
                    $handle = fopen($filename, 'w'); 
                     fwrite($handle, $db); 
                     fclose($handle); 
                     header("Location: index.php?status=registered");
                      exit();

            }else{
                echo "Passwords don't match";
            }

         }else{
             $echo = 'Empty input field';
         }



     }


   ?>  
 <h2>SignUp</h2><br><br>
<form method="post">
     <input type="text" name="firstname" placeholder="Enter Firstname" required><br><br>
     <input type="text" name="lastname" placeholder="Enter Lastname" required><br><br>
     <input type="text" name="username" placeholder="Enter Username" required><br><br>
     <input type="email" name="email" placeholder="Enter Email" required><br><br>
    <input type="text" name="country" placeholder="Enter Country" required><br><br>
    <input type="password" name="password" placeholder="Enter Password" required><br><br>
    <input type="password" name="repeat_password" placeholder="Repeat Password" required><br><br>
    <input type="submit" name="register" value="Register">
</form><br><br>
