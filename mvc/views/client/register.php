
<div class="px-5">

    <?php if (!empty($_SESSION['email'])): ?>
        <div class="alert alert-info" role="alert">
            <?php echo $_SESSION['email']; ?>
            <?php unset($_SESSION['email']); ?>
        </div>
    <?php endif; ?>

    <form action="?url=register-post" method="post">
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Email address</label>
            <input autocomplete="false" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email">
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input type="password" class="form-control" id="exampleInputPassword1" name="password">
        </div>
        <button type="submit" class="btn btn-primary">Đăng Ký</button>
    </form>

    <hr>
    <a class="btn btn-primary" href="?url=login">Đăng nhập</a>
</div>
