<?php
require_once "dbconnection.php";
// Connect to database
// Check if id is set or not if true toggle,
// else simply go back to the page
if (isset($_GET['id'])) {

    // Store the value from get to a
    // local variable "course_id"
    $id = $_GET['id'];

    // SQL query that sets the status
    // to 1 to indicate activation.
    $sql = "UPDATE orders SET
			status=1 WHERE id=$id";

    // Execute the query
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    header('location: orders.php');
}
