<?php

$title = "Edit Film";
require "layout/header.php";

$id_film = (int)$_GET['id'];

$getFilm = query("SELECT f.*, c.title AS category_title FROM films f JOIN categories c ON f.category_id = c.id_category WHERE f.id_film = $id_film")[0];

$categories = query("SELECT * FROM categories ORDER BY created_at DESC"); 

if (isset($_POST['submit'])) {
    if (update_film($_POST) > 0) {
        echo "<script>
                alert('film has been created');
                document.location.href = 'films.php';
            </script>";
    } else {
        echo "<script>
                alert('film has not been created');
                document.location.href = 'films-create.php';
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

                    <input type="hidden" class="form-control" name="id_film" id="id_film" value="<?= (isset($getFilm['id_film'])) ? $getFilm['id_film'] : '' ?>" readonly>

                    <div class="mb-3">
                          <label for="url">Url <small>(copy from youtube)</small></label>
                          <input type="text" class="form-control" name="url" id="url" value="<?= (isset($getFilm['url'])) ? $getFilm['url'] : '' ?>" required>
                    </div>
                    
                  <div class="row">
                      <div class="mb-3 col-md-6">
                          <label for="title">Title</label>
                          <input type="text" class="form-control" name="title" id="title" value="<?= (isset($getFilm['title'])) ? $getFilm['title'] : '' ?>" required>
                      </div>
                      <div class="mb-3 col-md-6">    
                          <label for="slug">slug</label>
                          <input type="text" class="form-control" name="slug" id="slug" value="<?= (isset($getFilm['slug'])) ? $getFilm['slug'] : '' ?>" readonly>
                      </div>  
                  </div>

                    <div class="mb-3">
                      <label for="description">Description</label>
                      <textarea class="form-control" name="description" id="description" row="3"   required></textarea>
                    </div>

                    <div class="row">
                      <div class="mb-3 col-md-6">
                          <label for="release_date">Release Date</label>
                          <input type="date" class="form-control" name="release_date" id="release_date" required>
                      </div>
                      <div class="mb-3 col-md-6">    
                          <label for="studio">Studio</label>
                          <input type="text" class="form-control" name="studio" id="studio" value="<?= (isset($getFilm['studio'])) ? $getFilm['studio'] : '' ?>" required>
                      </div>  
                  </div>

                  <div class="row">
                      <div class="mb-3 col-md-6">
                          <label for="is_private">Private</label>
                          <select class="form-select" name="is_private" id="is_private"  required>
                            <?php foreach (['Public', 'Private'] as $key => $value) : ?>
                              <option value="<?= $key ?>" <?= $getFilm['is_private'] == $key ? 'selected' : '' ?>><?= $value ?></option>
                            <?php endforeach; ?>
                          </select> 
                      </div>

                      <div class="mb-3 col-md-6">    
                          <label for="category_id">Category</label>
                          <select name="category_id" id="category_id" class="form-select" required>
                              <option value="" hidden>-- Select --</option>
                                <?php foreach ($categories as $category) :
                                    $selected = ($getFilm['category_id'] == $category['category_id']) ? 'selected' : '';
                                ?>
                                <option value="<?= $category['id_category']; ?>" <?= $selected ?>><?= $category['title']; ?></option>
                                <?php endforeach; ?>
                          </select>
                      </div>  
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