<?php
session_start();
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.88.1">
    <title>BLOGGERS Home</title>
    <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/dashboard/">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>

    
    
    <link href="dashboard.css" rel="stylesheet">
  </head>
  <body>
    
<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
  <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#">SOCIAL Rockers</a>
  <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">
  <div class="navbar-nav">
      <form  method="POST" action="functions.php">
    <div class="nav-item text-nowrap">
<?php
     if(isset($_SESSION['userid'])){
     echo '<button class="nav-link px-3 btn"  name="signout" >Sign out</button>';
     }
     else{
        echo '<a class="nav-link px-3 btn" href="userlogin.php">Sign In</a>';
     }
     ?>
    </div>
    </form>
  </div>
</header>

<div class="container-fluid">
 
  <div class="row">
    <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
      <div class="position-sticky pt-3">
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link " aria-current="page" href="index.php">
              <span data-feather="home"></span>
              Friend Feed
              </a></>
             </li>
             <li class="nav-item">
            <a class="nav-link " aria-current="page" href="index2.php">
              <span data-feather="file"></span>
              My Feed
              </a></>
             </li>
             <li class="nav-item">
            <a class="nav-link " aria-current="page" href="find.php">
              <span data-feather="file"></span>
              Find Friends
              </a></>
             </li>
             <li class="nav-item">
            <a class="nav-link " aria-current="page" href="profile.php">
              <span data-feather="file"></span>
              My Profile
              </a></>
             </li>
             <?php  if(isset($_SESSION['userid']))
             {
               echo '<li class="nav-item">
               <a class="nav-link " aria-current="page" href="newpost.php">
                 <span data-feather="file"></span>
               
               New Post
               </a>
             </li>';
              } 
              ?>
          <li class="nav-item">
          <h4 class="h4 text-secondary">
            <a class="nav-link active text-secondary" aria-current="page" href="index.php">
              <span data-feather="user"></span>
              <?php echo $_SESSION['username']  ?>
              </a>
          </h4></li>
        </ul>
        <ul class="nav flex-column mb-2">
        </ul>
      </div>
    </nav>
<link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/dashboard/">
    <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
    <script src="myscript.js"></script>  
    <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script><script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script><script src="dashboard.js"></script>
  </body>
</html>
