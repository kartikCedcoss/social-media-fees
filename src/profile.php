<?php
session_start();
require 'main.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/dashboard/">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

</head>
<body>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 ">
<?php
$uid = $_SESSION['userid'];
require_once 'php-activerecord/ActiveRecord.php';
ActiveRecord\Config::initialize(function($cfg)
{
    $cfg->set_model_directory('models');
    $cfg->set_connections(array(
  'development' => 'mysql://root:secret@mysql-server/db_social'));
});
echo '
        <div class="table-responsive" id="recentuser" >
          <table class="table table-striped table-sm">
        <thead>
          <tr>
            <th scope="col">USER ID</th>
            <th scope="col">USER NAME</th>
          </tr>
        </thead>
        <tbody>
          <tr>';
          $user = User::find_by_sql("SELECT * FROM users WHERE userid NOT IN($uid) ");
          foreach($user as $k){
            
           echo '<form method="POST" action="functions.php" ><td>'.$k->userid.'</td>
           <td>'.$k->username.'</td>
          <td>'.$k->userstatus.'</td>
           <td>';
          ?>
          <?php
            echo '<button class="btn btn-primary" type="submit" value="'.$k->userid.'" name="mute">Change</button></td>'; 
          ?>
          <?php
         echo  '</td>
        </tr></form>';   
          }
   echo "</tbody></table>";
?>
</div>
</main>
</body>
</html>
<?php 

require 'footer.php';
?>