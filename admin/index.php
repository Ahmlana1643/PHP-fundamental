<?php

session_start();

if (!isset($_SESSION['login'])) {
  echo "<script> 
          alert('Please login first!');
          window.location.href = 'login.php'; 
        </script>";
  exit;
}

  $title = "Dashboard";
  
  require "layout/header.php";

?>
<!-- main -->
<main class="py-5">
      <div class="containter">
        <div class="row justify-content-center">
          <div class="col-md-8">
            <div class="card shadow-sm">
              <div class="card-header">
                <i class="bi bi-pie-chart-fill"></i>
                
                <?= $title; ?> Welcome <?= $_SESSION['username']; ?>

              </div>

              <div class="card-body">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Omnis, facilis nostrum exercitationem vero animi necessitatibus ipsum. Est molestiae at voluptas dignissimos, neque recusandae, quia earum, praesentium dolores quibusdam nesciunt corrupti.
              </div>

              <div class="card-footer">
                footer
              </div>
            </div>
          </div>  
        </div>
      </div>
</main>
<?php
  require "layout/footer.php";
?>