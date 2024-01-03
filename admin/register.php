
<body>
        <div class="container">
            <form name="login" onsubmit="return login()" action="" method="post">
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Tên Đăng Nhập</label>
                    <div class="col-sm-10">
                        <input type="text" name="username" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Mật Khẩu</label>
                    <div class="col-sm-10">
                        <input type="password" name="password" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Mật Khẩu</label>
                    <div class="col-sm-10">
                        <input type="password" name="passwordR" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <input type="email" name="email" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Phone</label>
                    <div class="col-sm-10">
                        <input type="number" name="phone" required>
                    </div>
                </div>
                <input type="submit" class="btn btn-primary" name="submit" value="Đăng ký"></input>

            </form>

            <a href="login.php">Đăng Nhập</a>
        </div>

</body>

</html>