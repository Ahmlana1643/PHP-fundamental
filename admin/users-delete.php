<?php

require 'config/app.php';

if (!isset($_SESSION['login'])) {
    echo "<script> 
            alert('Please login first!');
            window.location.href = 'login.php'; 
          </script>";
    exit;
  }

$id_user = (int)$_GET['id'];

// $getUser = query("SELECT * FROM users WHERE id_user = $id_user")[0];

// if (!$getuser) {
//     echo "<script>
//                 alert('user not found');
//                 document.location.href = 'users.php';
//             </script>";
// }

    if (delete_user($id_user) > 0) {
        echo "<script>
                alert('user has been deleted');
                document.location.href = 'users.php';
            </script>";
    } else {
        echo "<script>
                alert('user has not been deleted');
                document.location.href = 'users.php';
            </script>";
}
