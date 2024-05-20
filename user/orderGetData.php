<?php
$connection = mysqli_connect("localhost", "root", null, "qlbanhang");
$email = $_POST['email'];

$query_user = "SELECT * FROM users WHERE email = '$email'";
$result = mysqli_query($connection, $query_user);

if ($result && mysqli_num_rows($result) > 0) {
    while ($data = mysqli_fetch_assoc($result)) {
        $user_id = $data['id'];

        $query_select = "SELECT orders.id AS order_id, orders.price AS order_price, orders.*, users.*, products.* FROM orders LEFT JOIN users ON orders.user_id = users.id LEFT JOIN products ON orders.product_id = products.id where orders.user_id = $user_id";
        $result = mysqli_query($connection, $query_select);
        while ($data = mysqli_fetch_assoc($result)) {
?>
            <tr>
                <td class="text-center"><?php echo $data['id']; ?></td>
                <td><?php echo $data['fullName']; ?></td>
                <td>
                    <span style="max-width: 500px; display:block; overflow: hidden;">
                        <?php echo $data['name']; ?>
                    </span>
                </td>
                <td><?php echo $data['count']; ?></td>
                <td><?php echo number_format($data['order_price']); ?> VND</td>
                <td>
                    <div style="display: flex; gap: 6px; align-items: center;">
                        <form action="viewOrder.php" method="POST">
                            <input type="text" name="id" hidden value="<?php echo $data['order_id'] ?>">
                            <button data-id="<?php echo $data['order_id'] ?>" class="btn btn-secondary">Xem Chi Tiết</button>
                        </form>
                    </div>
                </td>
            </tr>
<?php
        }
    }
}


?>