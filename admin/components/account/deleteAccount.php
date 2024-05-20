<?php
include '../../connectDB.php';

$id = $_POST['id'];
$sql = "DELETE FROM users WHERE id= $id";

if ($connection->query($sql) === TRUE) {
    echo "Record deleted successfully";
} else {
    echo "Error deleting record: " . $connection->error;
}

$connection->close();
?>

<script>
    const href = JSON.parse(localStorage.getItem('origin')) || null;
    if (href) {
        alert("Bạn đã xóa thành công!");
        window.location.href = href.replace(href.split("?")[1], "active=account");
    }
</script>