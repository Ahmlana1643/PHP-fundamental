<?php

$title = "Edit Categories";
require "layout/header.php";
require "config/app.php";

$id_category = (int)$_GET['id'];

$getDataById = query("SELECT * FROM categories WHERE id_category = $id_category")[0];

if (!$getDataById) {
  echo "<script>
          alert('Category not found');
          document.location.href = 'categories.php';
        </script>";
}

if (isset($_POST['update'])) {
    if (update_category($_POST) > 0) {
        echo "<script>
                alert('Category has been updated');
                document.location.href = 'categories.php';
            </script>";
    } else {
        echo "<script>
                alert('Category has not been updated');
                document.location.href = 'categories-edit.php';
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
                        <label for="id_category">Id</label>
                        <input type="hidden" class="form-control" name="id_category" id="id_category" value="<?= (isset($getDataById['id_category'])) ? $getDataById['id_category'] : '' ?>" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" name="title" id="title" value="<?= (isset($getDataById['title'])) ? $getDataById['title'] : '' ?>" required>
                    </div>
                    <div class="mb-3">    
                        <label for="slug">slug</label>
                        <input type="text" class="form-control" name="slug" id="slug" value="<?= (isset($getDataById['slug'])) ? $getDataById['slug'] : '' ?>" readonly>
                    </div>

                    <div class="float-end">
                        <button type="submit" class="btn btn-primary" name="update"><i class="bi bi-arrow-repeat"></i> Update</button>
                    </div>
                    
                </form>
              </div>
            </div>
          </div>  
        </div>
      </div>
</main>

<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

<script src="assets/js/helper.js"></script>

<script>
    $(document).ready(function() {
        $('#title').on('input', function() {
            $('#slug').val(slugify($(this).val()));
        })
    });

    
</script>

<?php require "layout/footer.php"; ?>

