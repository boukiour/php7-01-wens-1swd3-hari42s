<?php 
    require_once 'classes/DbConfig.php';
    require_once 'classes/User.php'; 

    if(isset($_POST['submit'])) {
        $user = new User();
        $user->register($_POST);
    }
?>
<?php require_once 'includes/header.php' ?>
<?php require_once 'includes/navbar.php' ?>
<div class="container">
    <h1 class="fw-bold">Register</h1>
    <form method="post" action="">
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Username</label>
            <input type="text" class="form-control" name="username" id="exampleInputEmail1" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input type="password" name="password" class="form-control" id="exampleInputPassword1">
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
<?php require_once 'includes/footer.php' ?>