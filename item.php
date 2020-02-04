<?php
    require('config/config.php');
    require('config/db.php');

    // get data from database
    $id = mysqli_escape_string($connect, $_GET['id']);
    $query = 'SELECT * FROM gear WHERE id='.$id;
    $result = mysqli_query($connect, $query);
    $item = mysqli_fetch_assoc($result);

    mysqli_free_result($result);
    mysqli_close($connect);

include 'templates/header.php';
?>

<div class="item">
    <?php if ($item['img'] !== null) : ?>
        <img src="<?php echo $item['img']; ?>" class="item-img">
    <?php else : ?>
        <img src="images/placeholder.png" class="item-img">
    <?php endif ?>
    <h2 class="item-title"><?php echo $item['name']; ?></h2>
    <ul>
        <li>Created: <?php echo $item['created_at']; ?></li>
        <?php if ($item['checked_at'] !== null) : ?>
            <li>Checked: <?php echo $item['created_at']; ?></li>
        <?php else : ?>
            <li>Checked: Never</li>
        <?php endif ?>
        <?php if ($item['expired'] !== null) : ?>
            <li class="expired"><?php echo $item['expired']; ?></li>
        <?php endif  ?>
    </ul>
    <p class="item-notes">Notes:</p>
    <a href="/" class="item-edit">Back</a>

</div>

<?php
include 'templates/footer.php';
?>