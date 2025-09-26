<?php
include_once('../connect.php');

// Xử lý thêm sản phẩm
if (isset($_POST['add'])) {
    $nameProduct = isset($_POST['nameProduct']) ? trim($_POST['nameProduct']) : '';
    if ($nameProduct !== '') {
        $statement = mysqli_prepare($connect, "INSERT INTO product_name (nameProduct) VALUES (?)");
        if ($statement) {
            mysqli_stmt_bind_param($statement, "s", $nameProduct);
            mysqli_stmt_execute($statement);
            mysqli_stmt_close($statement);
        }
        // Reload lại trang để cập nhật bảng
        header("Location: index.php");
        exit();
    } else {
        echo "<script>alert('Product name cannot be empty');</script>";
    }
}

// Lấy dữ liệu từ CSDL
$sql = "SELECT * FROM product_name ORDER BY id ASC";
$result = mysqli_query($connect,$sql);
if(!$result){
    die("Error: Could not able to execute $sql ." . mysqli_error($connect));
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
    <form action="" method="post" enctype="multipart/form-data">
        <h1>Product Manager</h1>
        <table>
            <tr>
                <th>STT</th>
                <th>Name</th> 
                <th>Action</th>
            </tr>

            <?php while($row = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><label for=""> <?php echo htmlspecialchars($row['nameProduct']); ?></label></td>

                <td>
                    <div class="btn-group">
                        <a href="./deleteHandle.php?id=<?php echo $row['id']; ?>" class="btn btn-de" onclick="return comfirm('Are you to delete?')">Delete</a>
                        <a href="./updateHandle.php?id=<?php echo $row['id']; ?>" class="btn btn-up">Update</a>
                    </div>    
                </td>
            </tr>

            <?php endwhile; ?>
        </table>

        <div class="container">
            <label for="name">Product name: </label>
            <input type="text" name="nameProduct" id="nameProduct">
            <button type="submit" name="add" id="add">Add</button>
        </div>
    </form>
</body>
</html>