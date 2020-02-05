<?php
require('config/config.php');
require('config/db.php');

$url = $_SERVER['REQUEST_URI'];

// check for submit
if (isset($_POST['submit'])) {
    // get form data
    $update_id = mysqli_real_escape_string($connect, $_POST['update_id']);
    $name = mysqli_real_escape_string($connect, $_POST['name']);
    $checked_at = mysqli_real_escape_string($connect, $_POST['checked_at']);
    $expired = mysqli_real_escape_string($connect, $_POST['expired']);
    $notes = mysqli_real_escape_string($connect, $_POST['notes']);

    if($expired == 'yes') {
        $expired = 1;
    } else {
        $expired = 0;
    }

    $update_query;
    if(strtotime($checked_at) === false){
        $update_query = "UPDATE gear SET
                            name= '$name',
                            expired='$expired',
                            Notes='$notes'
                                WHERE id= {$update_id}";
        echo $update_query;
    } else {
        $update_query = "UPDATE gear SET
                            name= '$name',
                            checked_at='$checked_at',
                            expired='$expired',
                            Notes='$notes'
                                WHERE id= {$update_id}";
        echo $update_query;
    }

    if(mysqli_query($connect, $update_query)){
        header('Location: '.ROOT_URL."");
    } else {
        echo 'Error: '. mysqli_error($connect);
    }
}

// get data from database
$id = mysqli_escape_string($connect, $_GET['id']);
$query = 'SELECT * FROM gear WHERE id=' . $id;
$result = mysqli_query($connect, $query);
$item = mysqli_fetch_assoc($result);

mysqli_free_result($result);
mysqli_close($connect);

include 'templates/header.php';
?>

<form class="item" action="<?php echo $url; ?>" method="post">
    <input type="hidden" name="update_id" value="<?php echo $item['id'] ?>">
    <h2><input class="item-title" type="text" name="name" value="<?php echo $item['name']; ?>"></h2>
    <ul class="item-desc">
        <li>
            <label>Checked:</label>
            <input class="form-control" type="date" name="checked_at" value="">
        </li>
        <li>
            <label>Expired:</label>
            <select class="form-control" name="expired">
                <?php if ($item['expired'] == 0) : ?>
                    <option value="no">No</option>
                    <option value="yes">Yes</option>
                <?php else : ?>
                    <option value="yes">Yes</option>
                    <option value="no">No</option>
                <?php endif  ?>
            </select>

        </li>
    </ul>
    <p class="item-notes">
        Notes:
        <textarea class="form-control" name="notes">
        <?php if ($item['Notes'] !== null) {
            echo $item['Notes'];
        } ?>
        </textarea>
    </p>
    <input class="btn btn-primary item-edit" type="submit" name="submit" value="Edit">
</form>

<?php
include 'templates/footer.php';
?>