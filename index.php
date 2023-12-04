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
    <div class="py-3">
        <?php
        foreach ($data as $key) {
            echo '<h3 class="fw-bold text-primary">' . $key->wish_name . '</h3>';
            echo '<p class="fw-semibold text-muted">' . $key->wish_desc . '</p>';
        }
        ?>
    </div>
</div>
<?php require_once 'includes/footer.php' ?>