<?php
include "db.php";
$search = isset($_GET['search']) ? $_GET['search'] :'';
$result = $conn->query("SELECT * FROM tbl_content WHERE descriptions LIKE '%$search%'");
$image = mysqli_query($conn, "SELECT * FROM tbl_content");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Title of Articel</title>
    <link rel="icon" href="favicon.ico">
</head>
<style>
  .floating-whatsapp {
  position: fixed;
  bottom: 20px;
  right: 20px;
  width: 50px;
  height: 50px;
  background-color: #25d366;
  border-radius: 50%;
  color: white;
  text-align: center;
  line-height: 50px;
  transition: all 0.3s ease; 
}

.floating-whatsapp:hover {
  transform: translateY(-5px); 
  box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2); 
}

.social-link {
  margin: 0 10px;
  color: #6c6c6c;
}

.social-link:hover {
  color: #007bff;
  transition: 0.5s;
  text-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
}

.floating-facebook {
  position: fixed;
  bottom: 80px;
  right: 20px;
  width: 50px;
  height: 50px;
  background-color: #3b5998;
  border-radius: 50%;
  color: white;
  text-align: center;
  line-height: 50px;
  transition: all 0.3s ease; 
}

.floating-facebook:hover {
  transform: translateY(-5px); 
  box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2); 
}

.floating-instagram {
  position: fixed;
  bottom: 140px;
  right: 20px;
  width: 50px;
  height: 50px;
  background-color: #e1306c;
  border-radius: 50%;
  color: white;
  text-align: center;
  line-height: 50px;
  transition: all 0.3s ease; 
}

.floating-instagram:hover {
  transform: translateY(-5px); 
  box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2); 
}
</style>
<body class="bg-dark">
<nav class="navbar navbar-expand-lg navbar-dark bg-primary navbar-scroll fixed-top">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">My Article</a>
      <button style="margin-left: 50px;" class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>     
      <div class="navbar">
        <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link text-white" href="admin">Login</a>
        </li>
        </ul>      
      </div> 
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav mt-3">
          <form class="d-flex" method="get" role="search">
            <input required class="form-control me-2" type="search" name="search" placeholder="Search Content..." aria-label="Search">
            <button class="btn btn-outline-success" type="submit">Search</button>
          </form> 
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="about.php">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#contact">Contact</a>
          </li>          
        </ul>        
      </div>      
    </div>
  </nav>
  <br><br><br>
  <section class="bg-light p-5 mb-4">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <h2 class="text-center mb-4">Website Sekolah</h2>
                    <p class="lead">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                    </p>
                    <p class="text-muted">
                        Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                    </p>                    
                </div>
            </div>
        </div>
    </section>
  <div id="carouselExampleIndicators" class="carousel slide mt-5" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <?php
            $imagecount = mysqli_num_rows($image);
            for ($i = 0; $i < $imagecount; $i++) {
                echo '<button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="' . $i . '"' . ($i == 0 ? ' class="active" aria-current="true"' : '') . ' aria-label="Slide ' . ($i + 1) . '"></button>';
            }
            ?>
        </div>
        <div class="carousel-inner">
            <?php
            $No = 1;
            mysqli_data_seek($image, 0); // Reset the result pointer
            while ($gambar = mysqli_fetch_array($image)) {
            ?>
                <div class="carousel-item<?php echo $No == 1 ? ' active' : ''; ?>">
                    <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($gambar['images']); ?>" class="d-block w-100" alt="Slide <?php echo $No; ?>">
                    <div class="carousel-caption d-block">
                        <h5>Slide Halaman <?php echo $No; ?></h5>
                        <p><?php echo $gambar['descriptions']; ?></p>
                    </div>
                </div>
            <?php
                $No++;
            }
            ?>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
<br>
  <div class="container mt-4">
    <div class="row">
      <?php
      if ($result->num_rows > 0) 
        while ($data = $result->fetch_assoc()):
          ?>
          <div class="col-md-4">
            <div class="card mb-4">
              <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($data['images']); ?>" class="card-img-top" alt="Gambar Artikel 1">
              <div class="card-body">
                <h5 class="card-title"><?php echo $data['title']; ?></h5>
                <p class="card-text"><?php echo $data['descriptions']; ?></p>
                <a href="title_content/index.php?title=<?php echo $data['title']; ?>" class="btn btn-primary">Read More</a>
              </div>
              <div class="card-footer text-muted">
                Created on <?php echo $data['date_created']; ?>, By <?php echo $data['creator']; ?>
              </div>
            </div>
          </div>
          <?php
        endwhile;
        else {
        echo "<script>document.location.href='404.php?search=$search';</script>";
      }
      ?>
      <a href="https://www.instagram.com/sirajameksikooo/" target="_blank" class="floating-instagram">
        <i class="fa fa-instagram fa-2x" style="margin-top: 10px;"></i>
      </a>
      <a href="#facebook" target="_blank" class="floating-facebook">
        <i class="fa fa-facebook fa-2x" style="margin-top: 10px;"></i>
      </a>
      <a href="https://wa.me/6281278727944" target="_blank" class="floating-whatsapp">
        <i class="fa fa-whatsapp fa-2x" style="margin-top: 10px;"></i>
      </a>     
    </div>
  </div>
  <footer class="footer mt-5 py-3 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <a href="#" class="social-link"><i class="fa fa-facebook fa-2x"></i></a>
                    <a href="#" class="social-link"><i class="fa fa-twitter fa-2x"></i></a>
                    <a href="#" class="social-link"><i class="fa fa-instagram fa-2x"></i></a>                    
                </div>
                <p class="text-muted text-center mt-3">Copyright &copy; By Hylmi 2024</p>
            </div>
        </div>
    </footer>
</body>
</html>