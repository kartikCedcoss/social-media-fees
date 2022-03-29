<?php
session_start();
require 'main.php';
?>
<?php
require_once 'php-activerecord/ActiveRecord.php';
  
ActiveRecord\Config::initialize(function($cfg)
{
    $cfg->set_model_directory('models');
    $cfg->set_connections(array(
  'development' => 'mysql://root:secret@mysql-server/db_social'));
});
if(isset($_POST['btnpost'])){
 $image = $_POST['image'];
 $video = $_POST['video'];
 $desc = $_POST['desc'];
 $userid = $_SESSION['userid'];
 $username=$_SESSION['username'];
 Feed::create(array('userid'=>$userid,'username'=>$username,'text'=>$desc,'fimage'=>$image,'fvideo'=>$video));
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>new post</title>
    <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/dashboard/">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> -->

</head>
<body>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 ">

<div class="bg-image" 
     style="background-image: url('https://mdbootstrap.com/img/Photos/Others/images/76.jpg');
            height: 100vh">
            <div class="container">
<div class="mt-3" >
	<div class="row">
	    
	    <div class="col-md-8 col-md-offset-2">
	        
    		<h1>Create post</h1>
    		
    		<form action="" method="POST">
    		    
    		    <div class="mb-3">
           <label for="formFile" class="form-label">Select an image</label>
           <input class="form-control" type="file" id="formFile" name="image">
           </div>
           <div class="mb-4">
           <label for="formFile" class="form-label">Select video</label>
           <input class="form-control" type="file" id="formFile" name="video">
           </div>
           
           <div class="form-group">
    		        <label for="description">Description</label>
    		        <textarea rows="5" class="form-control" name="desc" ></textarea>
    		    </div>
    		    
    		    <div class="form-group mt-3" >
    		        <button type="submit" class="btn btn-primary" name="btnpost">
    		          POST FEED
    		        </button>
    		        
    		    </div>
    		    
    		</form>
		</div>
		
	</div>
</div>
</div>


</div></main>
    
</body>
</html>