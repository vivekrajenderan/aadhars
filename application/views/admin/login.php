<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Aadhar </title>

        <!-- Bootstrap -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css">
        <script src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>  
        <!-- Font Awesome -->
        <link href="<?php echo base_url(); ?>assets/font-awesome/css/font-awesome.min.css" rel="stylesheet">   
        <!-- Custom Theme Style -->
        <link href="<?php echo base_url(); ?>assets/css/custom.min.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/css/custom.css" rel="stylesheet">
    </head>

    <body class="login">
        <div>
            <a class="hiddenanchor" id="signup"></a>
            <a class="hiddenanchor" id="signin"></a>

            <div class="login_wrapper">
                <div class="animate form login_form">
                    <section class="login_content">
                        <div class="alert alert-danger" style="display:none;">
                            <a class="close" data-dismiss="alert" href="#" aria-hidden="true">&times;</a>

                        </div>
                        <form method="post" autocomplete="off" id="login-form" action="<?php echo base_url() . 'admin/login/ajax_check'; ?>">
                            <h1>Login Form</h1>
                            <div class="form-group elVal">
                                <input type="text" class="form-control" name="email" id="email" placeholder="Email" required="" />
                            </div>
                            <div class="form-group elVal">
                                <input type="password" class="form-control" name="password" id="password" placeholder="Password" required="" />
                            </div>
                            <div>
                                <button type="submit" class="btn btn-default submit"> Log in</button>              
                            </div>

                            <div class="clearfix"></div>

                            <div class="separator">

                                <div class="clearfix"></div>
                                <br />

                                <div>
                                    <h1><i class="fa fa-paw"></i> Aadhar!</h1>
                                    <p>©2016 All Rights Reserved. Aadhar APP. Privacy and Terms</p>
                                </div>
                            </div>
                        </form>
                    </section>
                </div>

            </div>
        </div>
        <script src="<?php echo base_url(); ?>/assets/lib/jquery.validate.js"></script>
        <script>
            $(document).ready(function () {

                $("#login-form").validate({
                    highlight: function (element) {
                        $(element).closest('.elVal').addClass("form-field text-error");
                    },
                    unhighlight: function (element) {
                        $(element).closest('.elVal').removeClass("form-field text-error");
                    }, errorElement: 'span',
                    rules: {
                        email: {
                            required: true,
                            email: true
                        },
                        password: {
                            required: true,
                            minlength: 4
                        }
                    },
                    messages: {
                        email: {
                            required: "Please enter your email"

                        },
                        password: {
                            required: "Please enter your password"

                        }
                    },
                    errorPlacement: function (error, element) {
                        error.appendTo(element.closest(".elVal"));
                    },
                    submitHandler: function (form) {
                        var $form = $("#login-form");
                        $.ajax({
                            type: $form.attr('method'),
                            url: $form.attr('action'),
                            data: $form.serialize(),
                            dataType: 'json'
                        }).done(function (response) {
                            
                            if (response.status == "1")
                            {
                               window.location = "<?php echo base_url();?>admin/dashboard/";
                            }
                            else
                            {
                                $('.alert-danger').show();
                                $('.alert-danger').html(response.msg);
                                setTimeout(function () {
                                    $('.alert-danger').hide('slow');
                                }, 4000);
                            }
                        });
                        return false; // required to block normal submit since you used ajax
                    }
                });


                $.validator.addMethod("Alphaspace", function (value, element) {
                    return this.optional(element) || /^[a-z ]+$/i.test(value);
                }, "Username must contain only letters, numbers, or dashes.");

                $.validator.addMethod("Alphanumeric", function (value, element) {
                    return this.optional(element) || /^[a-z0-9]+$/i.test(value);
                }, "Username must contain only letters, numbers, or dashes.");

                $.validator.addMethod("nowhitespace", function (value, element) {
                    return this.optional(element) || /^\S+$/i.test(value);
                }, "Space are not allowed");

            });
        </script>
    </body>
</html>