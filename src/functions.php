<?php

session_start();
$username=$_SESSION['username'];
require_once 'php-activerecord/ActiveRecord.php';
ActiveRecord\Config::initialize(function($cfg)
{
    $cfg->set_model_directory('models');
    $cfg->set_connections(array(
  'development' => 'mysql://root:secret@mysql-server/db_social'));
});
 
if(isset($_POST['btnreg'])){
  $funame = $_POST['fullname'];
  $username =$_POST['username'];
  $email = $_POST['email'];
  $pass = $_POST['pass'];
  $mob = $_POST['mob'];
  $city = $_POST['city'];
  $country =$_POST['country'];
  $pin = $_POST['pincode'];

  User::create(array('fullname'=>$funame,'username'=>$username,'email'=>$email,'passw'=>$pass,'mobnumber'=>$mob,'city'=>$city,'country'=>$country,'pincode'=>$pin,'userstatus'=>'Unmute'));
  header("location:userlogin.php");
  exit();
}
if(isset($_POST['userlogin'])){
  $lmail = $_POST['lemail'];
  $lpass = $_POST['lpass'];
  
$user = User::find_by_sql("SELECT * FROM users");
foreach($user as $k ){
   if($k->email==$lmail && $k->passw == $lpass){
     $_SESSION['userid']=true;
     $_SESSION['userid']=$k->userid;
     $_SESSION['username'] = true;
     $_SESSION['username'] = $k->username;
     header("Location:index.php");
  }
  else if($k->email==$lmail && $k->passw != $lpass){
  ?>
  <script>
   alert("you have entered the wrong password");
   location.href = "userlogin.php";
  </script>
   <?php
  } 
}
}
if(isset($_POST['signout'])){
  unset($_SESSION['user']);
  unset($_SESSION['username']);
  header("location:userlogin.php");
}
if(isset($_POST['mute'])){
   $muteid = $_POST['mute'];
   $user = User::find_by_userid($muteid);
   if($user->userstatus=="Mute"){
     unset($_SESSION['mute']);
      $user->userstatus="Unmute";
      $user->save();
   }
   elseif($user->userstatus=="Unmute"){
     $_SESSION['mute']=$muteid;
       $user->userstatus = "Mute";
       $user->save();
   }
   header("location:profile.php");
}

if(isset($_POST['btncomnt'])){
  $username=$_SESSION['username'];
   $feedid = $_SESSION['feedid'];
   $comnt = $_POST['txtcomnt'];    
Comment::create(array('feedid'=>$feedid,'username'=>$username,'text'=>$comnt));
header("location:comment.php");

}

if (isset($_POST['btnupdate'])){
      $updateid= $_POST['btnupdate'];
      $uptext = $_POST['upcomnt'];
      $comment = Comment::find_by_commentid($updateid);
      $comment->text = $uptext;
      $comment->save(); 
      header("location:mycomment.php");

}
if(isset($_POST['deletecomnt'])){
    
     $deleteid= $_POST['deletecomnt'];
     $comment = Comment::find_by_commentid($deleteid);
     $comment->delete();
     header("location:mycomment.php");
 
}
if(isset($_POST['btncomnt2'])){
  $username=$_SESSION['username'];
   $feedid = $_SESSION['feedid'];
   $comnt = $_POST['txtcomnt'];    
Comment::create(array('feedid'=>$feedid,'username'=>$username,'text'=>$comnt));
header("location:mycomment.php");

}


?>