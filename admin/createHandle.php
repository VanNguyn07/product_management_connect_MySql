<?php
include_once('../connect.php');

$add = isset($_POST['add']);
if ($add) {
    $nameProduct = isset($_POST['nameProduct']) ? trim($_POST['nameProduct']) : '';
    if ($nameProduct !== '') {
        // Insert into database using prepared statement 
        $statement = mysqli_prepare($connect, "INSERT INTO product_name (nameProduct) VALUES (?)");
        if (!$statement) {
            die("Prepare Error: " . mysqli_error($connect));
        }

        mysqli_stmt_bind_param($statement, "s", $nameProduct); // Chỉ có 1 biến, kiểu string
        $ok = mysqli_stmt_execute($statement);
        $err = mysqli_error($connect);
        mysqli_stmt_close($statement);

        if ($ok) {
            echo "<script>alert('Added successfully in database'); window.location.href='readHandle.php';</script>";
            exit;
        } else {
            echo "<script>alert('Error add new: $err'); window.location.href='readHandle.php';</script>";
            exit;
        }
    } else {
        echo "<script>alert('Product name cannot be empty'); window.location.href='readHandle.php';</script>";
        exit;
    }
} else {
    echo "<script>alert('Error: Add button not clicked'); window.location.href='readHandle.php';</script>";
    exit;
}
?>