<?php
require('config/config.php');
require('config/db.php');

//check for submit
if (isset($_POST['submit'])) {
    // get form data
    $delete_id = mysqli_real_escape_string($connect, $_POST['delete_id']);
    
    $delete_query = "DELETE FROM gear WHERE id= {$delete_id}";

    if(mysqli_query($connect, $delete_query)){
        header('Location: '.ROOT_URL."");
    } else {
        echo 'Error: '. mysqli_error($connect);
    }
}

// get data from db
$query = 'SELECT * FROM gear';
$result = mysqli_query($connect, $query);
$data = mysqli_fetch_all($result, MYSQLI_ASSOC);

// free result and close connection
mysqli_free_result($result);
mysqli_close($connect);

include 'templates/header.php';
?>

<div class="grid">
    <?php foreach ($data as $item) : ?>
        <div class="item">
            <h2 class="item-title"><?php echo $item['name']; ?></h2>
            <ul class="item-desc">
                <li>Created: <?php echo $item['created_at']; ?></li>
                <?php if ($item['checked_at'] !== null) : ?>
                    <li>Checked: <?php echo $item['checked_at']; ?></li>
                <?php else : ?>
                    <li>Checked: Never</li>
                <?php endif ?>
                <?php if ($item['expired'] == 0) : ?>
                    <li class="expired">Expired: no</li>
                <?php else : ?>
                    <li class="expired">Expired: yes</li>
                <?php endif  ?>
            </ul>
            <p class="item-notes">Notes:</p>
            <form class="item-delete" action="<?php echo $_SERVER['REQUEST_URI'] ?>" method="post">
                <input type="hidden" name="delete_id" value="<?php echo $item['id']; ?>">
                <input class="btn btn-danger" type="submit" name="submit" value="Delete">
            </form>
            <a class="item-edit btn btn-primary" href="edit.php?id=<?php echo $item['id']; ?>">Edit</a>
        </div>
    <?php endforeach ?>

    <?php
    include 'templates/footer.php';
    ?>