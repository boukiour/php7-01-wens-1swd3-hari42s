<?php
require_once './classes/DbConfig.php';
require_once './classes/User.php';
require_once './classes/Wish.php';

if (!DbConfig::getSession()) {
  header('Location: login.php');
}

$user = new User();

$users = User::readAll();
$wishes = Wish::readAll();

?>
<?php require_once './includes/header.php' ?>
<?php require_once './includes/navbar.php' ?>
<main class="container">
  <h1 class="h3 mt-3 fw-normal">Home</h1>
  <div class="p-3 mb-3 border border-dark rounded">
    <h5 class="card-title"><?= $_SESSION['user']['username'] . ' ' . $_SESSION['user']['id']; ?></h5>
  </div>

  <div class="py-3">
  <h1 class="h3 mt-3 fw-normal">All Wishes</h1>
    <?php
    foreach ($wishes as $wish) {
      echo '<h3 class="fw-bold text-primary">' . $wish->title . '</h3>';
      echo '<p class="fw-semibold text-muted">' . $wish->description . '</p>';
    }
    ?>
  </div>
</main>
<?php require_once 'includes/footer.php' ?>