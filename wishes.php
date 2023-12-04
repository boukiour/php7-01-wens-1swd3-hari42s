<?php
require_once 'classes/DbConfig.php';
require_once 'classes/Wish.php';

if (!DbConfig::getSession()) {
    header('Location: index.php');
}

$wishes = Wish::readAll();
$wish = new Wish();

?>
<?php require_once 'includes/header.php' ?>
<?php require_once 'includes/navbar.php'; ?>
<div class="container">
    <h1 class="h3 mt-3 fw-normal">List of Wishes</h1>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Title</th>
                    <th scope="col">Desc</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($wishes as $p) {
                    echo '
                  <tr>
                    <th scope="row">' . $p->id . '</th>
                    <td>' . $p->title . '</td>
                    <td>' . $p->description . '</td>
                    <td>
                        <a href="wish.php/?id=' . $p->id . '" class="text-success ms-2"><i class="fa-solid fa-eye"></i></a>
                        <a href="form/form.update.php/?id=' . $p->id . '" class="text-primary ms-2"><i class="fa-regular fa-pen-to-square"></i></a>
                        <a href="form/form.delete.php/?id=' . $p->id . '" class="text-danger ms-2"><i class="fa-solid fa-trash-can"></i></a>
                    </td>
                  </tr>
				';
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php require_once 'includes/footer.php' ?>