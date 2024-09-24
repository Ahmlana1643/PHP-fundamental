<?php

$title = "Create Users";
require "layout/header.php";

if (isset($_POST['submit'])) {
    if (store_user($_POST) > 0) {
        echo "<script>
                alert('user has been created');
                document.location.href = 'users.php';
            </script>";
    } else {
        echo "<script>
                alert('user has not been created');
                document.location.href = 'users-create.php';
            </script>";
}
}

?>

<main class="p-4">
      <div class="containter">
        <div class="row justify-content-center">
          <div class="col-md-8">
            <div class="card">
              <div class="card-header">
                <i class="bi bi-plus"></i>
                <?= $title; ?>
              </div>
              <div class="card-body shadow-sm">
                <form action="" method="POST">
                    <div class="mb-3">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" name="username" id="username" required>
                    </div>

                    <div class="mb-3">    
                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="email" id="email" required>
                    </div>

                    <div class="mb-3">    
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password" id="password" required>
                    </div>

                    <div class="float-end">
                        <button type="submit" class="btn btn-primary" name="submit"><i class="bi bi-upload"></i> Submit</button>
                    </div>
                    
                </form>
              </div>
            </div>
          </div>  
        </div>
      </div>
</main>

<?php require "layout/footer.php"; ?>