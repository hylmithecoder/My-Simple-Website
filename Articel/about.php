<?php
include "db.php";
$query = mysqli_query($conn, "SELECT * FROM tbl_about");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Our Articel</title>
</head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
<style>
    body {
        margin-top: 70px;
    }
    .social-link {
       margin: 0 10px;
       color: #6c757d;
    }
    .social-link:hover {
        color: #007bff;
        transition: 0.5s;
        text-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
    }
</style>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary navbar-scroll fixed-top">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">My Article Web With Database</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="about.php">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#contact">Contact</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="admin">Login</a>
          </li>
        </ul>        
      </div>
    </div>
  </nav>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
      <?php
        while($data = mysqli_fetch_array($query)) :
    ?>
        <h1 class="text-center"><?php echo $data['Title'];?></h1>
        <hr>
      </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <p><?= $data['About'] ?></p>
        </div>
    </div>
    <?php
        endwhile;
    ?>
  </div>
  <footer class="footer mt-5 py-3 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <a href="#" class="social-link"><i class="fab fa-facebook fa-2x"></i></a>
                    <a href="#" class="social-link"><i class="fab fa-twitter fa-2x"></i></a>
                    <a href="https://www.instagram.com/sirajameksikooo/" class="social-link"><i class="fab fa-instagram fa-2x"></i></a>                    
                </div>
                <p class="text-muted text-center mt-3">Copyright &copy; By Hylmi 2024</p>
            </div>
        </div>
    </footer>
</body>
</html>