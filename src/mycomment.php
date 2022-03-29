<?php
session_start();
require 'main.php';
if(isset($_POST['comment'])){
    $_SESSION['feedid']=true;
    $_SESSION['feedid'] = $_POST['comment'];
}
  function  display(){
    $feedid=  $_SESSION['feedid'];
    $feed = Feed::find_by_sql("SELECT * FROM feeds WHERE feedid =$feedid");
    foreach($feed as $k){
    if (!$k->fvideo && $k->fimage){
          echo  '<div class="box-header with-border">
               <div class="user-block">  <span class="username"><a href="#" data-abc="true">'.$k->username.'</a></span>  </div>
               <div class="box-tools">  </div>
           </div>
           <div class="box-body"> <img class="img-responsive pad " src="image/'.$k->fimage.'" alt="Photo" width="250" >
                <p>'.$k->text.'</p> 
           </div>';
   }
   elseif(!$k->fimage && $k->fvideo){
       echo  '<div class="box-header with-border">
       <div class="user-block">  <span class="username"><a href="#" data-abc="true">'.$k->username.'</a></span>  </div>
       <div class="box-tools">  </div>
   </div>
   <div class="box-body"> <video class="img-responsive pad " width="250" controls > <source src="video/'.$k->fvideo.'"  type="video/mp4"  ></video>
        <p>'.$k->text.'</p> 
   </div>';
   }
   elseif (!$k->fvideo && !$k->fimage){
       echo  '<div class="box-header with-border">
       <div class="user-block">  <span class="username"><a href="#" data-abc="true">'.$k->username.'</a></span>  </div>
       <div class="box-tools">  </div>
   </div>
   <div class="box-body"> 
        <p>'.$k->text.'</p> 
   </div>';
   }
 }             
}
function displaycomment(){
    $feedid=  $_SESSION['feedid'];
  $comment =  Comment::find_by_sql("SELECT * FROM comments WHERE feedid = $feedid");
foreach ($comment as $k){
    echo '<div class="box-footer box-comments">
    <div class="box-comment"> 
        <div class="comment-text"> <span class="username"><mark><b>'.$k->username.'</b></mark>  </span><span>:- '.$k->text.'</span><button class="btn btn-outline-warning border-0" value="'.$k->commentid.'" name="editcomnt">EDIT</button><button class="btn btn-outline-danger border-0" name="deletecomnt" value="'.$k->commentid.'" >DELETE</button> </div>
        
        </div>
</div>';
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comments</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/dashboard/">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 ">
<div class="page-content page-container" id="page-content">
    <div class="padding">
        <div class="row container d-flex justify-content-center mt-4">
            <div class="">
                <div class="box box-widget">
<form method="POST" action="" >
    
                <?php
                 require_once 'php-activerecord/ActiveRecord.php';
                 ActiveRecord\Config::initialize(function($cfg)
                 {
                     $cfg->set_model_directory('models');
                     $cfg->set_connections(array(
                   'development' => 'mysql://root:secret@mysql-server/db_social'));
                 });

        $username = $_SESSION['username'];
             $feedid= $_POST['comment'];
              display();
              displaycomment();

                     if(isset($_POST['btncomnt'])){
                     $feedid = $_SESSION['feedid'];
                     $comnt = $_POST['txtcomnt'];                    
                  Comment::create(array('feedid'=>$feedid,'username'=>$username,'text'=>$comnt));
                }
                  echo   '<div class="box-footer">
                  <form action="functions.php" method="post"> 
                      <div class="img-push"> <input type="text" class="form-control input-sm" placeholder=" post comment" name="txtcomnt" > 
                     <button type="submit" class="btn btn-primary form-control mt-1" value="'.$feedid.'" name="btncomnt2">Comment</button>     
                  </div></form>';   
                  if(isset($_POST['editcomnt'])){
                      $comntid= $_POST['editcomnt'];
                     $comment = Comment::find_by_commentid($comntid);
                     echo   '<div class="box-footer">
                    <form action="functions.php" method="post"> 
                         <div class="img-push"> <input type="text" class="form-control input-sm" value="'.$comment->text.'" name="upcomnt" > 
                        <button type="submit" class="btn btn-primary form-control mt-1" value="'.$comment->commentid.'" name="btnupdate">Update Comment</button>     
                     </div></form>';
                  }
                
                        ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</main>
</body>
</html>