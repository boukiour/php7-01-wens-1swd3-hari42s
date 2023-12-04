<?php
require_once 'classes/DbConfig.php';
require_once 'classes/Wish.php';

if (!DbConfig::getSession()) {
    header('Location: login.php');
}

$wish = new Wish();
$data = $wish->read($_GET['id']);

if (!isset($_GET['id'])) {
    header('Location: ../wishes.php');
}

if (isset($_GET['back'])) {
    header('Location: ../wishes.php');
}
?>

<?php require_once 'includes/header.php'; ?>
<?php require_once 'includes/navbar.php'; ?>
<div class="container d-flex flex-column align-items-center justify-content-center mt-5">
    <div class="card" style="width: 18rem;">
        <div class="card-body">
            <h3 class="card-text text-primary text-bold"> <?= $data->title ?></h3>
            <h5 class="card-text text-muted"> <?= $data->description ?></h5>
        </div>
        <a href="?back" class="btn btn-outline-dark w-100 mt-5"><i class="fa-solid fa-arrow-left"></i>Back</a>
    </div>
</div>
<?php require_once 'includes/footer.php'; ?>