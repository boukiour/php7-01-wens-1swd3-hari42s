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
    <h5 class="card-title"><?= $_SESSION['user']['username'].' '.$_SESSION['user']['ID'];?></h5>
  </div>

  <h2 class="fw-bold text-left my-5">
        <?php 
            foreach ($wishes as $wish) {
                echo $wish->wish_name.'<br>'.$wish->wish_desc;
            }
        ?>
    </h2>
</main>
<?php require_once 'includes/footer.php' ?>