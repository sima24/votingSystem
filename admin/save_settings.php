<?php
header('Content-Type: application/json');
include('../db_conn.php');

// Get JSON data from frontend
$data = json_decode(file_get_contents("php://input"), true);


if ($data) {
    $votingsDate = $data['votingsDate'];
    $votingeDate = $data['votingeDate'];
    $startTime = $data['startTime'];
    $endTime = $data['endTime'];
    $resultsDate=$data['resultsDate'];
    $resultsTime=$data['resultsTime'];
    $sql="UPDATE settings set s_date='{$votingsDate}', e_date='{$votingeDate}', s_time='{$startTime}', e_time='{$endTime}',pub_date='{$resultsDate}',pub_time='{$resultsTime}' where id=1";
    mysqli_query($conn, $sql);

    echo json_encode(["status" => "success", "message" => "Settings saved"]);
} else {
    echo json_encode(["status" => "error", "message" => "No data received"]);
}
?>