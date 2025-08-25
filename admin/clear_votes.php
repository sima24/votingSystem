<?php
include '../db_conn.php';  


$sql = "DELETE FROM votes";

if (mysqli_query($conn, $sql)) {
    echo json_encode(["success" => true, "message" => "All votes cleared successfully."]);
} else {
    echo json_encode(["success" => false, "message" => "Error: " . mysqli_error($conn)]);
}
?>
