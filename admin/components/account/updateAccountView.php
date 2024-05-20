<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css" integrity="sha512-NmLkDIU1C/C88wi324HBc+S2kLhi08PN5GDeUVVVC/BVt/9Izdsc9SVeVfA1UZbY3sHUlDSyRXhCzHfr6hmPPw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="./assets/styles/style.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

<?php
include '../../connectDB.php';

echo ' <form method="post" action="updateSaveAccount.php">';
echo '<div class="modal" tabindex="-1" id="onload">';
echo '    <div class="modal-dialog">';
echo '        <div class="modal-content">';
echo '            <div class="modal-header">';
echo '                <h5 class="modal-title">Chỉnh sửa người dùng</h5>';
echo '                <button type="button" class="btn-close btn-close-modal-update" data-bs-dismiss="modal" aria-label="Close"></button>';
echo '            </div>';
echo '            <div class="modal-body row">';
echo layThongTin($_POST['id']);
echo '            </div>';
echo '            <div class="modal-footer">';
echo '                <button type="button" id="close_update" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>';
echo '               <button type="submit" class="btn btn-primary">Lưu Thay Đổi</button>';
echo '            </div>';
echo '        </div>';
echo '    </div>';
echo '</div>';
echo '</form>';



function layThongTin($id = 1)
{
    global $connection;
    $query_select = "select * from users where id=$id";
    $result = mysqli_query($connection, $query_select);
    while ($data = mysqli_fetch_assoc($result)) {
?>
        <div class="mb-3 col-6">
            <label for="id" class="form-label">Mã Tài Khoản</label>
            <input type="number" value="<?php echo $data['id']; ?>" name="id" hidden>
            <input type="number" disabled value="<?php echo $data['id']; ?>" class="form-control" id="id" placeholder="Enter your id id" required>
        </div>
        <div class="mb-3 col-6">
            <label for="name" class="form-label">Tên Người Dùng</label>
            <input type="text" name="fullName" value="<?php echo $data['fullName']; ?>" class="form-control" id="name" placeholder="Enter your fullName" required>
        </div>
        <div class="mb-3 col-6">
            <label for="role" value="<?php echo $data['role']; ?>" class="form-label">Quyền Người Dùng</label>
            <select name="role" class="form-control" required>
                <option value="USER">Người Dùng</option>
                <option value="ADMIN">Quản Trị</option>
            </select>
        </div>
        <div class="mb-3 col-6">
            <label for="email" class="form-label">Email</label>
            <input placeholder="Nhập Email Của Bạn" value="<?php echo $data['email']; ?>" type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="mb-3 col-12">
            <label for="password" class="form-label">Password</label>
            <input placeholder="Nhập Password Của Bạn" value="<?php echo $data['password']; ?>" type="text" class="form-control" id="password" name="password" required>
        </div>
<?php
    }
}

?>

<script type="text/javascript">
    window.onload = () => {
        const myModal = new bootstrap.Modal('#onload');
        myModal.show();
    }

    const btn = document.querySelector('#close_update');
    if (btn) {
        btn.addEventListener('click', () => {
            const href = JSON.parse(localStorage.getItem('origin')) || null;
            if (href) {
                window.location.href = href
            }
        })
    }
    const btnClose = document.querySelector('.btn-close-modal-update');
    if (btnClose) {
        btnClose.addEventListener('click', () => {
            const href = JSON.parse(localStorage.getItem('origin')) || null;
            if (href) {
                window.location.href = href
            }
        })
    }
</script>