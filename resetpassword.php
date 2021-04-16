<?php
session_start();
if(isset($_POST['submit'])){
    $current_password = trim($_POST['password']);
    $new_password = trim($_POST['new_password']);
    $repeat_password = trim($_POST['new_password_repeat']);

    if(!empty($current_password) && !empty($new_password) && !empty($repeat_password)){
            if($new_password === $repeat_password){
                $id = $_SESSION['id'];
                $filename = 'file.db';  
                $file = fopen($filename, 'w'); 
                while(!feof($file)){
                    $file = json_decode($file,true);
                    foreach($file as $user){
                        $file["id"] = $user;
                        if($user===$id){
                            str_replace($password,$new_password,'password');
                            fclose($file); 

                        }
                    }

                }
              

               

            }else{
                echo "New password fields don't match";
            }
    }else{
        echo 'fill all fields';
    }

}

?>
<h2>Reset Password</h2><br><br>
<form method="post">
        Current password: <input type="password" name="password"><br><br>
        New password: <input type="password" name="new_password"><br><br>
        Repeat new password: <input type="password" name="new_password_repeat"><br><br>
        <input type="submit" name="submit" value="Reset password">
</form>