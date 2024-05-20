<?php
include '../../connectDB.php';

try {
    $fullName = $_POST['fullName'];
    $role = $_POST['role'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query_insert = "INSERT INTO users (fullName, role, email, password) VALUES ('$fullName', '$role', '$email', '$password')";
    mysqli_query($connection, $query_insert);
} catch (Throwable $th) {
    echo $th;
}

?>

<script>
    const href = JSON.parse(localStorage.getItem('origin')) || null;
    if (href) {
        alert("Ban da tao thanh cong!")
        window.location.href = href.replace(href.split("?")[1], "active=account");
    }
</script>