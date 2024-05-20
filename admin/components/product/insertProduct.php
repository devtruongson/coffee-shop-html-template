<?php
include '../../connectDB.php';

try {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];
    $thumbnaiil = $_POST['thumbnail'];

    $query_insert = "INSERT INTO products (name, description, price, stock, thumbnaiil) VALUES ('$name', '$description', '$price', $stock, '$thumbnaiil')";
    mysqli_query($connection, $query_insert);
    echo $query_insert;
} catch (Throwable $th) {
    echo $th;
}

?>

<script>
    const href = JSON.parse(localStorage.getItem('origin')) || null;
    if (href) {
        alert("Ban da tao thanh cong!")
        window.location.href = href.replace(href.split("?")[1], "active=product");
    }
</script>