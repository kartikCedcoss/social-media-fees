<?php
require 'main.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>social</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/dashboard/">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> 
<link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 ">
<div class="container mt-4 mb-5">
    <div class="d-flex justify-content-center row">
        <div class="col-md-8">
            <div class="feed p-2">
              <form action="comment.php" method="POST">
            <?php
require_once 'php-activerecord/ActiveRecord.php';
ActiveRecord\Config::initialize(function($cfg)
{
    $cfg->set_model_directory('models');
    $cfg->set_connections(array(
  'development' => 'mysql://root:secret@mysql-server/db_social'));
});
$usnm = $_SESSION['mute'];
$userid = $_SESSION['userid'];
$feed = Feed::find_by_sql("SELECT * FROM feeds WHERE userid NOT IN ('$usnm')  ORDER BY feedid DESC");
foreach($feed as $k ) {
  if (!$k->fimage && $k->fvideo){
    echo    '<div class="bg-white border mt-2">
    <div>
         <div class="d-flex flex-row justify-content-between align-items-center p-2 border-bottom">
             <div class="d-flex flex-row align-items-center feed-text px-2">
               <div class="d-flex flex-column flex-wrap ml-2"><span class="font-weight-bold">'.$k->username.'</span><span class="text-black-50 time">40 minutes ago</span></div>
             </div>
             <div class="feed-icon px-2"><i class="fa fa-ellipsis-v text-black-50"></i></div>
        </div>
    </div>
   
    <div ><video class="img-fluid img-responsive" width="250" controls ><source src="video/'.$k->fvideo.'"  type="video/mp4"  ></video>
    <div class="p-2 px-3"><span>'.$k->text.'</span></div>
     <div class="d-flex justify-content-end socials p-2 py-3"><button type="submit" class="btn btn-default btn-xs" name="comment" value="'.$k->feedid.'">
     <i class="fa fa-comment"></i> Comments</button>';
     ?>
     <?php
     $like = Like::find_by_feedid($k->feedid);
     if($k->userid==$userid){
     echo '<button type="submit" class="btn btn-primary btn-xs" value="'.$k->feedid.'" name="btnlike"><i class="fa fa-thumbs-o-up"></i> Like<span class="badge badge-light">'. $like->likes.'</span></button> </div>';
     }
     else{
      echo '<button type="submit" class="btn btn-default btn-xs" value="'.$k->feedid.'" name="btnlike"><i class="fa fa-thumbs-o-up"></i> Like<span class="badge badge-light">'. $like->likes.'</span></button> </div>';

     }
echo  '</div>
</div>';
  }
  elseif (!$k->fvideo && $k->fimage){
    echo    '<div class="bg-white border mt-2">
                     <div>
                          <div class="d-flex flex-row justify-content-between align-items-center p-2 border-bottom">
                              <div class="d-flex flex-row align-items-center feed-text px-2">
                                <div class="d-flex flex-column flex-wrap ml-2"><span class="font-weight-bold">'.$k->username.'</span><span class="text-black-50 time">40 minutes ago</span></div>
                              </div>
                              <div class="feed-icon px-2"><i class="fa fa-ellipsis-v text-black-50"></i></div>
                         </div>
                     </div>
                     <div class="image"><img class="img-fluid img-responsive" src="image/'.$k->fimage.'" width="250" ></div>
                     <div >
                     <div class="p-2 px-3"><span>'.$k->text.'</span></div>
                      <div class="d-flex justify-content-end socials p-2 py-3"><button type="submit" class="btn btn-default btn-xs"  name="comment" value="'.$k->feedid.'" >
                      <i class="fa fa-comment"></i> Comments</button>';
                      ?>
                      <?php
                      $like = Like::find_by_feedid($k->feedid);
                      if($k->userid==$userid){  
                      echo '<button type="submit" class="btn btn-primary btn-xs" value="'.$k->feedid.'" name="btnlike"><i class="fa fa-thumbs-o-up"></i> Like<span class="badge badge-light">'. $like->likes.'</span></button> </div>';
                      }
                      else{
                       echo '<button type="submit" class="btn btn-default btn-xs" value="'.$k->feedid.'" name="btnlike"><i class="fa fa-thumbs-o-up"></i> Like<span class="badge badge-light">'. $like->likes.'</span></button> </div>';
                      }
                 echo  '</div>
                 </div>';
                   }
  elseif(!$k->fimage && !$k->fvideo ) {
    echo    '<div class="bg-white border mt-2">
    <div>
         <div class="d-flex flex-row justify-content-between align-items-center p-2 border-bottom">
             <div class="d-flex flex-row align-items-center feed-text px-2">
               <div class="d-flex flex-column flex-wrap ml-2"><span class="font-weight-bold">'.$k->username.'</span><span class="text-black-50 time">40 minutes ago</span></div>
             </div>
             <div class="feed-icon px-2"><i class="fa fa-ellipsis-v text-black-50"></i></div>
        </div>
    </div>
    <div >
    <div class="p-2 px-3"><span>'.$k->text.'</span></div>
     <div class="d-flex justify-content-end socials p-2 py-3"><button type="submit" class="btn btn-default btn-xs"  name="comment" value="'.$k->feedid.'">
     <i class="fa fa-comment"></i> Comments</button> ';
     ?>
     <?php
     $like = Like::find_by_feedid($k->feedid);
     if($k->userid==$userid){
     echo '<button type="submit" class="btn btn-primary btn-xs" value="'.$k->feedid.'" name="btnlike"><i class="fa fa-thumbs-o-up"></i> Like<span class="badge badge-light">'. $like->likes.'</span></button> </div>';
     }
     else{
      echo '<button type="submit" class="btn btn-default btn-xs" value="'.$k->feedid.'" name="btnlike"><i class="fa fa-thumbs-o-up"></i> Like<span class="badge badge-light">'. $like->likes.'</span></button> </div>';

     }
echo  '</div>
</div>';
  }
}
?>         
              </form>
        </div>
    </div>
</div>
  </main>
</body>
</html>
<?php 

require 'footer.php';
?>