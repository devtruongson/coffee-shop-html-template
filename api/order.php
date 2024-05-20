<?php
$connection = mysqli_connect("localhost", "root", null, "qlbanhang");

try {
    $email = $_POST['email'];
    $product = $_POST['product_id'];
    $count = $_POST['count'];
    $price = $_POST['price'];

    $query_user = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($connection, $query_user);

    if ($result && mysqli_num_rows($result) > 0) {
        while ($data = mysqli_fetch_assoc($result)) {
            $user_id = $data['id'];
            $query_insert = "INSERT INTO orders (user_id, product_id, count, price) VALUES ('$user_id', '$product', '$count', '$price')";
            mysqli_query($connection, $query_insert);
            echo $query_insert;
        }
    } else {
        echo "No user found with email: $email";
    }
} catch (\Throwable $th) {
    //throw $th;
}
