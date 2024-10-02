<?php
include "db.php";
session_start();
session_destroy();
echo "
<div class='alert alert-success fade show alert-dismissible'></div>
<script>document.location.href='index.php';</script>";
?>
<script src="node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>