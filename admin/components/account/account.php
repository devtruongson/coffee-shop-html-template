<?php
include '../../connectDB.php';
?>

<div>
    <div>
        <form action="components/account/insertAccount.php" method="POST">
            <div class="row">
                <div class="mb-3 col-6">
                    <label for="fullName" class="form-label">Họ Và Tên</label>
                    <input placeholder="Nhập tên của bạn" type="text" class="form-control" id="fullName" name="fullName" required>
                </div>
                <div class="mb-3 col-6">
                    <label for="role" class="form-label">Quyền Người Dùng</label>
                    <select name="role" class="form-control" required>
                        <option value="USER">Người Dùng</option>
                        <option value="ADMIN">Quản Trị</option>
                    </select>
                </div>
                <div class="mb-3 col-6">
                    <label for="email" class="form-label">Email</label>
                    <input placeholder="Nhập Email Của Bạn" type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="mb-3 col-6">
                    <label for="password" class="form-label">Password</label>
                    <input placeholder="Nhập Password Của Bạn" type="text" class="form-control" id="password" name="password" required>
                </div>
            </div>
            <div class="d-flex justify-content-end">
                <button class="btn btn-primary">Thêm Tài Khoản</button>
            </div>
        </form>
        <div>
            <div class="mt-5">
                <h2 class="my-2 mb-3" style="font-size: 17px;">Danh Sách Tài Khoản</h2>
                <table class="table table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col" style="white-space: nowrap;">Mã người dùng</th>
                            <th scope="col">Tên Người Dùng</th>
                            <th scope="col">Quyền Người Dùng</th>
                            <th scope="col">Email</th>
                            <th scope="col">Password</th>
                            <th scope="col">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        xuatDataTaiKhoan();
                        ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>


<?php

function xuatDataTaiKhoan()
{
    global $connection;
    $query_select = "select * from users";
    $result = mysqli_query($connection, $query_select);
    while ($data = mysqli_fetch_assoc($result)) {
?>
        <tr>
            <td class="text-center"><?php echo $data['id']; ?></td>
            <td><?php echo $data['fullName']; ?></td>
            <td>
                <span style="max-width: 500px; display:block; overflow: hidden;">
                    <?php echo $data['role']; ?>
                </span>
            </td>
            <td><?php echo $data['email']; ?></td>
            <td><?php echo $data['password']; ?></td>
            <td>
                <div style="display: flex; gap: 6px; align-items: center;">
                    <form action="components/account/deleteAccount.php" method="POST">
                        <input type="text" name="id" hidden value="<?php echo $data['id'] ?>">
                        <button data-action="delete" data-id="<?php echo $data['id'] ?>" class="btn btn-primary">Xóa</button>
                    </form>
                    <form action="components/account/updateAccountView.php" method="POST">
                        <input type="text" name="id" hidden value="<?php echo $data['id'] ?>">
                        <button data-action="update" data-bs-toggle="modal" data-bs-target="#modal_update" data-id="<?php echo $data['id'] ?>" class="btn btn-secondary">Sửa</button>
                    </form>
                </div>
            </td>
        </tr>
<?php
    }
}
?>