<?php 
include_once('../connect.php');

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if($id > 0){
    $stmt = mysqli_prepare($connect,"DELETE FROM product_name WHERE id = ?");
    mysqli_stmt_bind_param($stmt,'i',$id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    // Chuyển hướng về lại danh sách với thông báo
    echo "<script>alert('Delete sucessfilly'); window.location.href='index.php';</script>";
    exit;
} else {
    echo "<script>alert('ID is unable'); window.location.href='index.php';</script>";
    exit;
}
?>