<!-- delete-order.php -->
<?php
require_once('config.php');
require_once('auth.php');
$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
$id = $_GET['id']; // get id through query string
$query = "delete from teokset where id = $id";
echo $id;
echo $query;
$del = $result = $mysqli->query($query); // delete query
if ($del) {
    mysqli_close($db); // Close connection
    header("location:admin-index2.php"); // redirects to all records page
    exit;
} else {
    echo "Error deleting record"; // display error message if not delete
}
?>