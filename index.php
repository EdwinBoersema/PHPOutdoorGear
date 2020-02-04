<?php
    require('config/config.php');
    require('config/db.php');

    // get data from db
    $query = 'SELECT * FROM gear';
    $result = mysqli_query($connect, $query);
    $data = mysqli_fetch_all($result, MYSQLI_ASSOC);

    // free result and close connection
    mysqli_free_result($result);
    mysqli_close($connect);

include 'templates/header.php';
?>

<h1>Index Page</h1>

<div class="grid">
    <?php foreach($data as $item): ?>
        <div class="item">
        <?php if($item['img'] !== null): ?>
            <img src="<?php echo $item['img']; ?>" class="item-img">
        <?php else: ?>
            <img src="images/placeholder.png" class="item-img">
        <?php endif ?>
        <h2 class="item-title"><?php echo $item['name']; ?></h2>
        <ul>
            <li>Created: <?php echo $item['created_at']; ?></li>
            <?php if($item['checked_at'] !== null): ?>
                <li>Checked: <?php echo $item['created_at']; ?></li>
            <?php else: ?>
                <li>Checked: Never</li>
            <?php endif ?>
            <?php if($item['expired'] !== null): ?>
                <li class="expired"><?php echo $item['expired']; ?></li>
            <?php endif  ?>
        </ul>
        <p class="item-notes">Notes:</p>
        </div>
    <?php endforeach ?>

<?php
include 'templates/footer.php';
?>