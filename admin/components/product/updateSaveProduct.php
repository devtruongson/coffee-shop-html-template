<?php
include '../../connectDB.php';

try {
    $masp = $_POST['id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];
    $thumbnaiil = $_POST['thumbnaiil'];

    $query_insert = "UPDATE products set name = '$name' , description = '$description', price = '$price', stock='$stock', thumbnaiil='$thumbnaiil' where id = '$masp'";
    mysqli_query($connection, $query_insert);
    echo $query_insert;
} catch (Throwable $th) {
}

?>

<script>
    const href = JSON.parse(localStorage.getItem('origin')) || null;
    if (href) {
        alert("Bạn đã chỉnh sửa thành công!");
        window.location.href = href.replace(href.split("?")[1], "active=product");
    }
</script>