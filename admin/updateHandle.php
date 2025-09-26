<?php
include_once('../connect.php');

if($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST['update'])){
    $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
    $updateProduct = isset($_POST['updateProduct']) ? trim($_POST['updateProduct']) : '';

    //Update DB
    $statement = mysqli_prepare($connect, "UPDATE product_name SET nameProduct = ? WHERE id = ?");
    mysqli_stmt_bind_param($statement,'si', $updateProduct, $id);
    mysqli_stmt_execute($statement);
    mysqli_stmt_close($statement);

    echo "<script>alert('Update successfully!'); window.location.href='index.php';</script>";
    exit;
}

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$updateProduct = '';
if($id > 0){
    $sql = "SELECT * FROM product_name WHERE id = $id";
    $result = mysqli_query($connect,$sql);
    if($row = mysqli_fetch_assoc($result)){
        $updateProduct = $row['nameProduct'];
    } 
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Management</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <form action="" method="post" enctype="multipart/form-data" id="formUpdate">
        <h1>Product Manager</h1>
        <table>
            <tr>
                <th>Name</th> 
                <th>Action</th>
            </tr>
            <tr>
                <td>
                    <input type="text" name="updateProduct" id="updateProduct" 
                        value="<?php echo htmlspecialchars($updateProduct); ?>">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                </td>
                <td>
                    <div class="btn-up-re">
                        <button type="submit" name="update">Update</button>
                        <button type="reset">Cancel</button>
                    </div>    
                </td>
            </tr>
        </table>
    </form>
</body>
</html>