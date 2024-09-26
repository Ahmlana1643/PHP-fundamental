<?php

$title = 'Edit User';
require "layout/header.php";

$id_user = (int)$_GET['id'] ?? 0;
$getUser = query("SELECT * FROM users WHERE id_user = $id_user")[0] ?? null;

if (!$getUser) {
    echo "<script>
                alert('User not found');
                document.location.href = 'users.php';
            </script>";
            
}

if (isset($_POST['submit'])) {
    $_POST['id_user'] = $id_user;

    if (update_user($_POST) > 0) {
        echo "<script>
                alert('User has been changed');
                document.location.href = 'users.php';
            </script>";
    } else {
        echo "<script>
                alert('User has not been updated');
                document.location.href = 'users-edit.php?id=$id_user';
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
                        <i class="bi bi-pen"></i>
                        <?= $title; ?>
                    </div>

                    <div class="card-body shadow-sm">
                        <form action="" method="POST">
                            <input type="hidden" name="id_User" value="<?= $getUser['id_user']; ?>">
                            <div class="mb-3">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" id="username" name="username" value="<?= $getUser['username']; ?>" required>
                            </div>

                            <div class="mb-3">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email" value="<?= $getUser['email']; ?>" required>
                            </div>

                            <div class="mb-3">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Enter new password" >
                            </div>

                            <div class="mb-3">
                            <?php if ($_SESSION['role'] == 'admin') : ?>
                                <label for="role">Role</label>
                                <select class="form-select" name="role" id="role" required>
                                    <option value="" hidden>-- Select --</option>
                                    <option value="admin" <?= $getUser['role'] == 'admin' ? 'selected' : '' ?>>Admin</option>
                                    <option value="operator" <?= $getUser['role'] == 'operator' ? 'selected' : '' ?>>Operator</option>
                                </select> 
                                <?php endif; ?>
                            </div>

                            <div class="float-end">
                                <button type="submit" class="btn btn-primary" name="submit"><i class="bi bi-repeat"></i> Change</button>
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
            $('#email').val(emailify($(this).val()));
        })
    });
</script>
<?php require "layout/footer.php"; ?>