<?php
$title = $_GET['title'];
include "../db.php";
session_start();
if(!isset($_SESSION['admin']))
{
    echo "<script>alert('Kamu Jangan Coba-coba bypass ya !!!');document.location.href='../login.php';</script>";
}
$result = mysqli_query($conn, "SELECT * FROM tbl_content WHERE title = '$title'");
while ($data = mysqli_fetch_assoc($result)):
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title?> - My Website</title>
</head>
<style>
    .sidebar {
      background-color: #f1f1f1;
      padding: 20px;
      width: 200px;
    }

    .color-icon {
        color: white;
    }
</style>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary navbar-scroll fixed-top">
  <div class="container-fluid text-black">
    <a class="navbar-brand" href="#">My Website</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" aria-current="page" onclick="window.history.back()" href="#home">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../about.php">About</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#contact">Contact</a>
        </li>
      </ul>
    </div>
  </div>
</nav><br><br><br>
<div class="container">
    <div class="row">
        
      <div class="col-md-9">
        <h2><?php echo $title;?></h2>
        <img class="img-fluid" src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($data['images']); ?>" alt="Gambar Konten">
        <p><?php echo $data['descriptions'];?></p>
        <!-- <div class="card">
          <img src="..." class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title">Card title</h5>
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            <a href="#" class="btn btn-primary">Go somewhere</a>
          </div>
        </div> -->
        <?php
            endwhile;
        ?>
      </div>
    </div>
  </div>
  <footer class="footer mt-auto py-3 bg-secondary">
    <div class="container">
        <div class="row">
        <div class="col-md-12 text-center">
          <a href="#" class="social-link"><i class="color-icon fa fa-facebook"></i></a>
          <a href="#" class="social-link"><i class="color-icon fa fa-twitter"></i></a>
          <a href="#" class="social-link"><i class="color-icon fa fa-instagram"></i></a>
        </div>
        <p class="text-muted">Copyright &copy; By Hylmi 2024</p>
        <!-- <span class="text-muted">&copy; 2024 Your Company</span> -->
        </div>        
    </div>
  </footer>
  <script>
  </script>
</body>
</html>