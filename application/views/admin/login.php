<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In</title>
    <link rel="stylesheet" href="<?= base_url() ?>admin_assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>admin_assets/css/login.css">
    <link rel="stylesheet" href="<?= base_url() ?>admin_assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">

    <style>
        #email {
            text-transform: lowercase;
        }

        ::-webkit-input-placeholder {
            text-transform: initial;
        }

        .toggle_password {
            position: absolute;
            top: 5px;
            right: 18px;
            cursor: pointer;
        }

        .fa-eye-slash {
            margin-top: 5px;
        }
    </style>
</head>

<body>
    <div class="bg-gradient-form">
        <div class="container-fluid">
            <img src="<?= base_url() ?>admin_assets/images/shape.png" class="shape_left">
            <img src="<?= base_url() ?>admin_assets/images/shape.png" class="shape_right">
            <div class="form_container">
                <div class="card login-form-holder">
                    <div class="logo-inner">
                        <img class="login_img" src="<?= base_url() ?>admin_assets/images/logo.jpg" alt="" srcset="">
                    </div>
                    <h2 class="form-heading" style="text-align:center;">Log In</h2>
                    <div class="card-body">
                        <form method="post" id="login_form" name="login_form" novalidate="novalidate">
                            <div class="form-group">
                                <label for="email">Username</label>
                                <input type="text" name="email" id="email" class="form-control" placeholder="Username">
                            </div>
                            <div class="form-group">
                                <label for="password_field" class="control-label">Password</label>
                                <input id="password" type="password" class="form-control " name="password" placeholder="Password">
                                <span class="toggle_password"><i class="fa fa-eye-slash"></i></span>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <button type="submit" class="btn-login">Log In </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="<?= base_url() ?>admin_assets/js/bootstrap.bundle.min.js"></script>
</body>
<script src="<?= base_url() ?>admin_assets/js/jquery.js"></script>
<script src="<?= base_url() ?>admin_assets/js/jquery.validate.min.js"></script>
<script src="<?= base_url() ?>admin_assets/js/custom.js "></script>
<script>
    $('.toggle_password').click(function() {
        if ($('.toggle_password i').hasClass('fa-eye-slash')) {
            $('.toggle_password i').removeClass('fa-eye-slash');
            $('.toggle_password i').addClass('fa-eye');
            $('#password').attr('type', 'text');
        } else {
            $('.toggle_password i').removeClass('fa-eye');
            $('.toggle_password i').addClass('fa-eye-slash');

            $('#password').attr('type', 'password');

        }
    })
</script>
<script>
    $(document).ready(function() {
        $.validator.addMethod("noSpaceAtStart", function(value, element) {
            return this.optional(element) || /^\s/.test(value) === false;
        }, "First letter can not be space");
        $("#login_form").validate({
            rules: {
                email: {
                    required: true,
                    noSpaceAtStart: true
                },
                password: {
                    required: true
                }
            },
            messages: {
                email: {
                    required: "Please enter username !",
                    noSpaceAtStart: "Please enter valid username !"
                },
                password: {
                    required: "Please enter password !"
                }
            },
            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            },
            submitHandler: function(form) {
                form.submit();
            }
        });
    });
</script>
<?php if ($this->session->flashdata('success') != "") { ?>
    <div class="alert alert-success animated fadeInUp" style="color:#297401;">
        <strong style="color:#297401; "> <?= $this->session->flashdata('success') ?></strong>
    </div>
<?php } else if ($this->session->flashdata('message') != "") { ?>
    <div class="alert alert-danger animated fadeInUp" style="">
        <strong style=""> <?= $this->session->flashdata('message') ?></strong>
    </div>
<?php } elseif (validation_errors() != '') { ?>
    <div class="alert alert-danger animated fadeInUp">
        <strong> <?= validation_errors() ?></strong>
    </div>
<?php } ?>
<script>
    $(".alert").fadeTo(5000, 500).slideUp(500, function() {
        $(".alert").slideUp(500);
    });
</script>

</html>