<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">


<div class="container py-3">
    <div style="display: flex; justify-content: center; align-items: center; height: 100vh">
        <form style="width: 50vw;" method="POST" action="Auth.php">
            <div id="render-auth"></div>
            <a href="#">Bạn muốn <span id="text-toggle">đăng ký</span>? <button type="button" class="btn btn-danger ms-2" id="toggle-register-login" data-id="1">tại đây</button></a>
        </form>
    </div>
</div>

<script>
    const form = document.querySelector('form > #render-auth');
    const span = document.querySelector("#text-toggle")
    span.innerHTML = "Đăng ký"

    form.innerHTML = `
            <h2>Đăng nhập tài khoản của bạn</h2>
            <input type="hidden" name="type" value="login" />
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input  name="email" type="email" class="form-control" id="email" required placeholder="Bạn hãy nhập email">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input name="password" type="password" class="form-control" id="password" required placeholder="Bạn hãy nhập password">
            </div>
            <button type="submit" class="btn btn-primary">Đăng Nhập</button>`

    const btn = document.querySelector("#toggle-register-login");
    let isLogin = true;

    btn.addEventListener("click", (e) => {
        if (isLogin) {
            btn.dataset.id = "2";
            span.innerHTML = "Đăng nhập"
            form.innerHTML = `
        <h2>Đăng Ký tài khoản của bạn</h2>
        <input type="hidden" name="type" value="register" />
        <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input type="email" name="email" class="form-control" id="email" required placeholder="Bạn hãy nhập email">
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" class="form-control" id="password" required placeholder="Bạn hãy nhập password">
        </div>
        <div class="mb-3">
            <label for="fullName" class="form-label">fullName</label>
            <input type="fullName" class="form-control" id="fullName" required placeholder="Bạn hãy nhập fullName" name="fullName">
        </div>
        <button type="submit" class="btn btn-primary">Đăng Ký</button>`;
            isLogin = false;
        } else {
            btn.dataset.id = "1";
            span.innerHTML = "Đăng ký"
            form.innerHTML = `
            <h2>Đăng nhập tài khoản của bạn</h2>
            <input type="hidden" name="type" value="login" />
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input  name="email" type="email" class="form-control" id="email" required placeholder="Bạn hãy nhập email">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input name="password" type="password" class="form-control" id="password" required placeholder="Bạn hãy nhập password">
            </div>
            <button type="submit" class="btn btn-primary">Đăng Nhập</button>`;
            isLogin = true;
        }
    });
</script>