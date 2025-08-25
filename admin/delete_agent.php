<?php
include '../db_conn.php';
$id = $_GET['id'];
$sql= "delete from agent where id='{$id}'";
$run= mysqli_query($conn, $sql);
if($run){
    echo "<script>alert('deleted successfully'); window.location.href='all_agent.php';</script>";
}else{
    echo "<script>alert('unable to delete'); window.location.href='all_agent.php';</script>";
}
?>