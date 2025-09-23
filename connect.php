<?php 
$connect = mysqli_connect('localhost', 'root', 'Nguyen31072006!', 'product_manager');
if(! $connect) {
    die('Connection Failed'. mysqli_connect_error());
}
mysqli_set_charset($connect,'utf8');
?>