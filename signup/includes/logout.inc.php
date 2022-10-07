<?php

include "../classes/dbh.class.php";

include '../classes/logout.class.php';

session_start();
session_unset();
session_destroy();

// Go back to index
// echo not header because JS
echo "index.php";