<?php
$title = $_GET['title'];
include "../db.php";
$result = mysqli_query($conn, "SELECT * FROM tbl_content WHERE title = '$title'");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title?> - My Website</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <style>
        body {
            padding-top: 60px;
        }
        .navbar-brand {
            font-weight: bold;
        }
        .content-image {
            max-height: 400px;
            object-fit: cover;
            width: 100%;
        }
        .sidebar {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 5px;
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
        .instagram-link {
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .instagram-link i {
            background: #f09433;
            background: linear-gradient(45deg, #f09433 0%, #e6683c 25%, #dc2743 50%, #cc2366 75%, #bc1888 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            display: inline-block;
            padding: 10px;
            border-radius: 10px;
            transition: all 0.3s ease;
        }

        .instagram-link:hover i {
            background: linear-gradient(45deg, #bc1888 0%, #cc2366 25%, #dc2743 50%, #e6683c 75%, #f09433 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            text-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            transform: scale(1.1);
        }
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

          .color-icon {
              color: black;
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
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">My Website</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="../index.php">Home</a>
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
    </nav>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-8">
                <?php
                while ($data = mysqli_fetch_assoc($result)):
                ?>
                <article>
                    <h1 class="mb-4"><?php echo $title; ?></h1>
                    <a target="_blank" href="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($data['images']); ?>" target="_blank">
                    <img class="img-fluid rounded content-image mb-4" src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($data['images']); ?>" alt="<?php echo $title; ?>">
                    </a>                      
                    <div class="content">
                        <?php echo $data['descriptions']; ?>
                    </div>
                </article>
                <?php
                endwhile;
                ?>
                <a href="#facebook" target="_blank" class="floating-facebook">
                  <i class="fab fa-facebook fa-2x" style="margin-top: 9px;"></i>
                </a>
                <a href="https://wa.me/6281278727944" target="_blank" class="floating-whatsapp">
                  <i class="fab fa-whatsapp fa-2x" style="margin-top: 9px;"></i>
                </a> 
            </div>
            <div class="col-md-4">
                <div class="sidebar">
                <h4>Recent Posts</h4>
                  <?php
                    $result = mysqli_query($conn, "SELECT * FROM tbl_content ORDER BY date_created DESC LIMIT 5");
                    while ($data = mysqli_fetch_assoc($result)):
                  ?>                    
                    <ul class="list-unstyled">
                        <li><a href="?title=<?php echo $data['title']; ?>"><?php echo $data['title']; ?></a></li>
                    </ul>
                    <?php
                    endwhile;
                    ?>
                    <h4>Categories</h4>
                    <ul class="list-unstyled">
                        <li><a href="#">Category 1</a></li>
                        <li><a href="#">Category 2</a></li>
                        <li><a href="#">Category 3</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <footer class="footer mt-5 py-3 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <a href="#" class="social-link"><i class="fab fa-facebook fa-2x"></i></a>
                    <a href="#" class="social-link"><i class="fab fa-twitter fa-2x"></i></a>
                    <a href="#" class="social-link"><i class="fab fa-instagram fa-2x"></i></a>                    
                </div>
                <p class="text-muted text-center mt-3">Copyright &copy; By Hylmi 2024</p>
            </div>
        </div>
    </footer>
</body>
</html>