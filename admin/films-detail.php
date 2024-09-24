<?php
    $title = "detail films";
    require "layout/header-datatable.php";

    $id_film = (int)$_GET['id'];

$film = query("SELECT f.*, c.title AS category_title FROM films f JOIN categories c ON f.category_id = c.id_category WHERE f.id_film = $id_film")[0];

if (!$film) {
  echo "<script>
          alert('Film not found');
          document.location.href = 'films.php';
        </script>";
}

    // $films = query("SELECT * FROM films ORDER BY created_at DESC"); 
    // $films = query("SELECT f.* AS category_title FROM films f JOIN categories c ON f.category_id = c.id_category WHERE f.id_film = $id_film");

?>

<!-- main -->
<main class="p-4">
      <div class="containter">
        <div class="row justify-content-center">
          <div class="col-md-8">
            <div class="card">
              <div class="card-header">
                <i class="bi bi-film"></i>
                <?= $title; ?>
              </div>
              <div class="card-body shadow-sm">
                <div class="table-responsive">
                <table class="table table-bordered table-responsive table-striped">
                    <tr>
                      <th>Video</th>
                      <td>
                      <iframe src="<?= $film['video'] ?>" frameborder="0" ></iframe>
                      <video src=""></video>
                      </td>
                    </tr>
                    <tr>
                      <th>Title</th>
                      <td><?= $film['title'] ?></td>
                    </tr>
                    <tr>
                      <th>Category</th>
                      <td><?= $film['category_title'] ?></td>
                    </tr>
                    <tr>
                      <th>Slug</th>
                      <td><?= $film['slug'] ?></td>
                    </tr>
                    <tr>
                      <th>Description</th>
                      <td><?= $film['description'] ?></td>
                    </tr>
                    <tr>
                      <th>Release Date</th>
                      <td><?= $film['release_date'] ?></td>
                    </tr>
                    <tr>
                      <th>Studio</th>
                      <td><?= $film['studio'] ?></td>
                    </tr>
                    <tr>
                      <th>Private</th>
                      <td><?= $film['is_private'] ? 'Private' : 'Public' ?></td>
                    </tr>
                </table>
                <div class="float-end">
                  <a href="films.php" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Back</a>
                </div>
                </div>
              </div>
            </div>
          </div>  
        </div>
      </div>
</main>

<?php require "layout/footer-datatable.php"; ?>