<?php
    $connect = mysqli_real_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    if(mysqli_connect_errno()){
        echo 'Failed to connect to database '. mysqli_connect_errno();
    } else {
        echo 'Connected to database';
    }