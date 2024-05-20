
<?php
$connection = mysqli_connect("localhost", "root", null, "qlbanhang");

$type = $_POST['type'];
$email = $_POST['email'];
$password = $_POST['password'];
$fullName = $_POST['fullName'];

if ($type == "login") {
    try {
        $query = "select * from users where email= '$email' and password= '$password'";
        $result = mysqli_query($connection, $query);

        if (mysqli_num_rows($result) == 0) {
            echo "<script>alert('Sai mật khẩu hoặc email')</script>";
        } else {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<script> alert('Bạn đã đăng nhập thành công!'); 
                localStorage.setItem('isLogin', JSON.stringify(true));     
                localStorage.setItem('user', JSON.stringify({email : '" . $row['email'] . "',role : '" . $row['role'] . "'})); window.location.href = JSON.parse(localStorage.getItem('origin_production'));</script>
                ";
            }
        }
    } catch (\Throwable $th) {
    }
} else {
    $query = "select * from users where email= '$email'";
    $result = mysqli_query($connection, $query);

    if (mysqli_num_rows($result) == 0) {
        $query_insert = "insert into users (fullName, role, email, password ) values ('$fullName', 'USER', '$email', '$password')";
        mysqli_query($connection, $query_insert);
        echo "<script> alert('Bạn đã đăng ký thành công!'); 
                localStorage.setItem('isLogin', JSON.stringify(true));     
                localStorage.setItem('user', JSON.stringify({email : '" . $email . "',role : 'USER'})); window.location.href = JSON.parse(localStorage.getItem('origin_production'));</script>
                ";
    } else {

        echo "<script> alert('Email đã được đăng ký!'); 
         window.location.href = JSON.parse(localStorage.getItem('origin_production'));</script>
        ";
    }
}

?>
