<?php
    require('config/config.php');
    require('config/db.php');

    //check for submit
    if(isset($_POST['submit'])){
        // get form data
        $name = mysqli_real_escape_string($connect, $_POST['name']);
        $checked_at = mysqli_real_escape_string($connect, $_POST['checked_at']);

        // convert option into boolean value (1/0)
        $expiredBoolean = mysqli_real_escape_string($connect, $_POST['expired']);
        $expired = 0;
        if($expiredBoolean == 'yes'){
            $expired = 1;
        } elseif($expiredBoolean == 'no') {
            $expired = 0;
        }
        echo $expired;

        $notes = mysqli_real_escape_string($connect, $_POST['notes']);

        // upload image and create url string (not implemented atm)
        // $img = mysqli_real_escape_string($connect, $_POST['img']);

        $query = "INSERT INTO gear(name, expired, notes) VALUES('$name', '$expired', '$notes')";
        if(mysqli_query($connect, $query)){
            header('Location: '.ROOT_URL."");
        } else {
            echo 'Error'.mysqli_error($connect);
        }
    }

include 'templates/header.php';

?>

<h1>Add Article</h1>

<form class=" add-form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
    <div class="form-group">
        <label>Name</label>
        <input type="text" name="name" class="form-control">
    </div>
    <div class="form-group">
        <label>Checked at</label>
        <input type="date" name="checked_at" class="form-control">
    </div>
    <div class="form-group">
        <label>Worn out?</label>
        <!-- <input type="number" name="expired" class="form-control"> -->
        <select class="form-control" name="expired">
            <option value="no">no</option>
            <option value="yes">yes</option>
        </select>
    </div>
    <div class="form-group">
        <label>Notes</label>
        <input type="text" name="notes" class="form-control">
    </div>
    <div class="form-group">
        <label>Photo</label>
        <input type="text" name="img" class="form-control">
    </div>
    <input type="submit" value="Add" name="submit" class="btn btn-primary">
</form>

<?php
include 'templates/footer.php';
?>