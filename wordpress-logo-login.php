// Replaces the WordPress logo on the login page

function wpb_login_logo() { ?>
    <style type="text/css">
        #login h1 a, .login h1 a {
            background-image: url(/wp-content/uploads/2024/03/choctaw-websites-wordpress-login-icon.png);
        height:150px;
        width:150px;
        background-size: 150px 150px;
        background-repeat: no-repeat;
        padding-bottom: 10px;
        }
    </style>
<?php }
add_action( 'login_enqueue_scripts', 'wpb_login_logo' );
