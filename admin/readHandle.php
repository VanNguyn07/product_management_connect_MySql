<?php 
include_once('../connect.php');

// Lấy dữ liệu từ CSDL
$sql = "SELECT * FROM product_name ORDER BY id ASC";
$result = mysqli_query($connect,$sql);
if(!$result){
    die("Error: Could not able to execute $sql ." / mysqli_error($connect));
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

                <td><button type="submit" onclick="return confirm('Are you to delete?'); ">Delete</button>
                    <button type="submit">Update</button>
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