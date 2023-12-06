<?php
require_once 'classes/DbConfig.php';
require_once 'classes/User.php';
$user = new User();
if (isset($_GET['logout'])) {
    $user->logout();
}
?>

<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container">
        <a class="navbar-brand fw-bolder" href="index.php">Wishes.php</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarText">
            <?php
            if (DbConfig::getSession()) {
                echo '
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" href="index.php">Home</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Wishes
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="wishes.php">View</a></li>
                            <li><a class="dropdown-item" href="./form/form.create.php">Create</a></li>
                        </ul>
                    </li>
                </ul>
                ';
            } ?>
            <ul class="navbar-nav">
                <?php
                if (DbConfig::getSession()) {
                    echo '
                    <li class="nav-item">
                        <a class="nav-link" href="?logout=true">Logout</a>
                    </li>';
                } else {
                    echo
                    '
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">Login</a>
                    </li>';
                }
                ?>
            </ul>
        </div>
    </div>
</nav>