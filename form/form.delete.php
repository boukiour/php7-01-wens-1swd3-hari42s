<?php 
require_once '../classes/DbConfig.php';
require_once '../classes/Wish.php';

if (!DbConfig::getSession()) {
    header('Location: login.php');
}

$wish = new Wish();

if (isset($_POST['submit'])) {
    echo $wish->delete($_GET['id']);
    header('Location: ../../wishes.php');
}

if (isset($_GET['back'])) {
    header('Location: ../../wishes.php');
}

?>
<?php require_once '../includes/header.php'; ?>
<main class="container mt-5">
    <form action="" method="POST">
        <h1 class="fw-bold text-center">Confirm</h1>
        <button class="w-100 btn btn-lg btn-danger" type="submit" name="submit">Delete</button>
        <a href="?back" class="w-100 btn btn-lg btn-outline-primary my-2">Cancel</a>
    </form>
</main>
<?php require_once '../includes/footer.php'; ?>