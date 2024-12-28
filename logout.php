<?php
session_start();
session_unset();  // Menghapus semua session variables
session_destroy();  // Menghancurkan session
header("Location: ./TES/INDEX.PHP");  // Redirect ke halaman login setelah logout
exit();
?>
