<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view('template/meta') ?>
    <?php $this->load->view('template/js') ?>
</head>

<body class="hold-transition login-page">
    <?php if ($this->session->userdata('isLogin') === true) {
        redirect(base_url('C_home'));
    } ?>
    <div class="login-box" style="width: 450px !important">
        <div class="login-logo">
            <a href="#"><b>Sistem Prediksi Petshop</b> </a>
        </div>

        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Sign in to start your session</p>

                <form id="basic">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Username" name="username" id="username" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user-circle"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Password" name="password" id="password" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <button type="button-submit" class="btn btn-primary btn-block" onclick="login()">Sign In</button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
    <script>
        function login() {
            $("#basic").submit(function(e) {
                $.ajax({
                    type: "POST",
                    url: baseUrl + "C_login/login",
                    data: $(e.target).serialize(),
                    dataType: "json",
                    success: function(data) {
                        if (data.status === true) {
                            swal({
                                title: "Berhasil",
                                text: "Login Berhasil",
                                icon: "success",
                                button: "OK",
                            }).then(function(isConfirm) {
                                window.location = baseUrl + "C_home";
                            });
                        } else {
                            swal({
                                title: "Error",
                                text: "Login Gagal",
                                icon: "error",
                                button: "OK",
                            });
                            $("#username").val(null).trigger("change");
                            $("#password").val(null).trigger("change");
                        }
                    },
                });
                return false;
            });
        }
    </script>
</body>

</html>