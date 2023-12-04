<?php

require_once 'classes/DbConfig.php';
require_once 'classes/User.php';
require_once 'classes/Wish.php';

if (DbConfig::getSession()) {
    header('Location: home.php');
}

$data = Wish::readAll();

?>
<?php require_once 'includes/header.php' ?>
<?php require_once 'includes/navbar.php' ?>
<div class="container">
    <h1 class="fw-bold text-center my-5">
        <?php 
            foreach ($data as $key) {
                echo $key->wish_name.'<br>'.$key->wish_desc;
            }
        ?>
    </h1>
</div>
<?php require_once 'includes/footer.php' ?>