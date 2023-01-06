<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login / Register</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/css/bootstrap.min.css"
          integrity="sha512-SbiR/eusphKoMVVXysTKG/7VseWii+Y3FdHrt0EpKgpToZeemhqHeZeLWLhJutz/2ut2Vw1uQEj2MbRF+TVBUA=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link rel="stylesheet" href="./assets/style/auth-style.css">

</head>
<body>
<!-- partial:index.partial.html -->
<div id="background">
    <?php
    if (isset($msg)) : ?>
        <div class="errMsg alert alert-<?= $msg['color'] ?> m-2">
            <?= $msg['msg'] ?>
        </div>
        <?php unset($msg); ?>
    <?php endif; ?>
    <div id="panel-box">
        <div class="panel">
            <div class="auth-form on" id="login">
                <div id="form-title">Log In</div>
                <form action="<?= siteUrl('auth.php?action=login'); ?>" method="POST">
                    <input name="username" type="text" required="required" placeholder="Username"/>
                    <input name="password" type="password" required="required" placeholder="Password"/>
                    <button type="submit">Log In</button>
                </form>
            </div>
            <div class="auth-form" id="signup">
                <div id="form-title">Register</div>
                <form action="<?= siteUrl('auth.php?action=register'); ?>" method="POST">
                    <input name="username" type="text" required="required" placeholder="Username"/>
                    <input name="email" type="email" required="required" placeholder="Email"/>
                    <input name="password" type="password" required="required" placeholder="Password"/>
                    <button type="Submit">Sign Up</button>
                </form>
            </div>
        </div>
        <div class="panel">
            <div id="switch">Sign Up</div>
            <div id="image-overlay"></div>
            <div id="image-side"></div>
        </div>
    </div>
</div>
<!-- partial -->
<script src='https://code.jquery.com/jquery-3.3.1.min.js'></script>
<script src="./assets/js/auth-script.js"></script>

</body>
</html>
