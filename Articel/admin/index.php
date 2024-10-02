<?php
include "../db.php";
session_start();
// include "../login.php";
if (isset($_SESSION['admin'])) {
    // echo "<script>alert('Anda Menggunakan Akun dengan $_SESSION[user] !!!')</script>";
    // header("Location: ../login.php");
    // exit;
}
if (!isset($_SESSION['admin']))
{
    echo "<script>alert('Anda Harus Login Dahulu');document.location.href='../login.php';</script>";
}

$search = isset($_GET['search']) ? $_GET['search'] : '';
$result = $conn->query("SELECT * FROM tbl_content WHERE descriptions LIKE '%$search%'");
$resultforid = mysqli_query($conn, "SELECT * FROM tbl_content");
while ($iddelete = mysqli_fetch_assoc($resultforid)):
$iddel = $iddelete['ID'];
echo "<script>console.log($iddel);</script>";
endwhile;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
</head>
<style>
  span {
    margin-left: 23rem;
    display: flex;
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
  /* .my-popup {
  position: fixed;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  background-color: #fff;
  border: 1px solid #ddd;
  padding: 20px;
  z-index: 9999; 
  display: none;
}

.close-popup {
  position: absolute;
  top: 10px;
  right: 10px;
  font-size: 24px;
  margin-top: 30px;
}

.close-popup:hover {
  cursor: pointer;
} */

.edit-btn:hover {
  color: orange;
  text-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
}

.logout-btn:hover {
  color: red;
}

.add-btn:hover {
  color: blue;
}
</style>
<body>
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-warning" id="exampleModalLabel">Warning</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Yakin Mau Keluar
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
        <a href="../logout.php"><button type="button" class="btn btn-success">Ya</button></a>
      </div>
    </div>
  </div>
</div>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark navbar-scroll fixed-top">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">My Website</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
      <form class="d-flex mt-3" method="get" role="search">
        <input class="form-control me-2" type="search" name="search" placeholder="Search Content Here..." aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
        <li class="nav-item mt-3">
          <a class="nav-link active" aria-current="page" href="index.php">Home</a>
        </li>
        <li class="nav-item mt-3">
          <a class="nav-link" href="../about.php">About</a>
        </li>
        <li class="nav-item mt-3">
          <a class="nav-link" href="#contact">Contact</a>
        </li>
        <li class="nav-item mt-3 dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Admin
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="add_content.php">Add Content</a></li>
            <li><a class="dropdown-item edit-btn" href="edit_about.php?about=About">Edit About</a></li>
            <li><a class="dropdown-item logout-btn" data-bs-toggle="modal" data-bs-target="#exampleModal"  href="../logout.php">Logout</a></li>
          </ul>
        </li>
      </ul>      
      <div class="navbar-nav ms-auto">
        <span class="navbar-text">
          User:
        <?php echo $_SESSION['user'];?>
        </span>
      </div>
    </div>
  </div>
</nav><br><br><br>
<div class="container mt-3">
        <div class="row">
                <?php
                    if ($result->num_rows > 0) 
                    while ($data = $result->fetch_assoc()):
                ?>
            <div class="col-md-6 mt-3">
                <div class="card mb-4">
                    
                    <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($data['images']); ?>" class="card-img-top" alt="Gambar Artikel">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $data['title'];?></h5>
                        <p class="card-text"><?php echo $data['descriptions'];?></p>
                        <a href="title_content.php?title=<?php echo $data['title']; ?>" class="btn btn-primary">Baca Selengkapnya</a>
                        <a href="delete.php?id=<?php echo $data['ID'];?>" onclick="return confirm('Kamu Yakin Ingin Menghapus ?')"><button class="btn btn-danger" data-bs-toggle="modal"  data-id="<?php echo $data['ID'];?>" data-bs-target="#ModalForDelete">Hapus</button></a>                      
                        <a href="edit_content.php?id=<?php echo $data['ID'];?>"><button class="text-light btn btn-warning">Edit</button></a>
                    </div>
                    <div class="card-footer text-muted">
                        Diposting pada: <?php echo $data['date_created'];?>
                        Created By <?php echo $data['creator'];?>
                    </div>                    
                </div>
            </div>
            <?php
                endwhile;
                else {
                    echo "<div role='alert' class='alert alert-danger alert-dismissable fade show'>Data Not Found like $search</div>";
                }
            ?>
        </div>
    </div>
  <!-- <div class="modal fade" id="ModalForDelete" tabindex="-1" aria-labelledby="ModalLabelForDelete" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-danger" id="ModalLabelForDelete">Warning</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Yakin Mau Hapus
      </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
      <a href="delete.php?id=<?php echo $iddel?>"><button type="button" class="btn btn-danger">Ya</button></a>
    </div>
    </div>
  </div> -->
  <footer class="footer mt-5 py-3 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <a href="#" class="social-link"><i class="fab fa-facebook fa-2x"></i></a>
                    <a href="#" class="social-link"><i class="fab fa-twitter fa-2x"></i></a>
                    <a href="#" class="social-link"><i class="fab fa-instagram fa-2x"></i></a>                    
                </div>
                <p class="text-muted text-center mt-3">Powered &copy; By Hylmi 2024</p>
            </div>
        </div>
    </footer>
</div>
</body>
</html>