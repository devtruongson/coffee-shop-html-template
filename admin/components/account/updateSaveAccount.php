<?php
include '../../connectDB.php';

try {
    $id = $_POST['id'];
    $fullName = $_POST['fullName'];
    $role = $_POST['role'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query_insert = "UPDATE users set fullName = '$fullName' , role = '$role', email = '$email', password='$password' where id = '$id'";
    mysqli_query($connection, $query_insert);
    echo $query_insert;
} catch (Throwable $th) {
}

?>

<script>
    const href = JSON.parse(localStorage.getItem('origin')) || null;
    if (href) {
        alert("Bạn đã chỉnh sửa thành công!");
        window.location.href = href.replace(href.split("?")[1], "active=account");
    }
</script>