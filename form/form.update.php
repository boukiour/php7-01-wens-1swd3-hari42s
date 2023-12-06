<?php 
    require_once '../classes/DbConfig.php';
    require_once '../classes/Wish.php';

    if (!DbConfig::getSession()) {
        header('Location: login.php');
    }

    $wish = new Wish();
    $data = $wish->read($_GET['id']);

    if(!isset($_GET['id'])) {
        header('Location: ../wishes.php');
    }

    if (isset($_POST['submit'])) {
        echo $wish->update($_POST, $_GET['id']);
        header('Location: ../../wish.php/?id=' . $_GET["id"] . '');
    }

    if (isset($_GET['back'])) {
        header('Location: ../../wishes.php');
    }
?>
<?php require_once '../includes/header.php'; ?>
<main class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="form-signin">
                <form action="" method="POST">
                    <h1 class="h3 mb-3 fw-normal">Update Wish</h1>
                    <a href="?back" class="btn btn-outline-dark w-100 mt-5"><i class="fa-solid fa-arrow-left"></i>Back</a>
                    <div class="form-floating m-2">
                        <input type="text" class="form-control" name="wish_name" id="floatingTitle" value="<?= $data->title ?>">
                        <label for="floatingTitle">Title</label>
                    </div>

                    <div class="form-floating m-2">
                        <input type="text" class="form-control" name="wish_desc" id="floatingDesc" value="<?= $data->description ?>">
                        <label for="floatingDesc">Description</label>
                    </div>

                    <div class="m-2 mt-2 mb-3">
                        <button class="w-100 btn btn-lg btn-dark" type="submit" name="submit">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
<?php require_once '../includes/footer.php'; ?>