<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>

<body>
    <style>
        body {
            font-family: "Comic Sans MS", sans-serif;
            background-color: #f0f0f0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .login-container {
            background: white;
            border: 2px solid #000;
            padding: 40px;
            width: 320px;
            box-shadow: 10px 10px 0 #000;
            text-align: center;
        }

        h1 {
            font-size: 28px;
            margin-bottom: 30px;
        }

        .input-group {
            margin-bottom: 20px;
            text-align: left;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-size: 16px;
        }

        input {
            width: 100%;
            padding: 12px;
            border: 2px solid #000;
            box-shadow: 3px 3px 0 #000;
            font-size: 14px;
        }

        button {
            background-color: #ffcc00;
            border: 2px solid #000;
            padding: 12px;
            width: 100%;
            cursor: pointer;
            box-shadow: 3px 3px 0 #000;
            font-size: 16px;
        }

        button:hover {
            background-color: #ffeb3b;
        }

        @media (max-width: 600px) {
            .login-container {
                width: 90%;
                padding: 30px;
            }
        }
    </style>
    <div class="login-container">
        <h1>Login</h1>
        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success flash-message">
                <?= session()->getFlashdata('success'); ?>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger flash-message">
                <?= session()->getFlashdata('error'); ?>
            </div>
        <?php endif; ?>
        <?php if (session()->getFlashdata('errors')): ?>
            <div class="alert alert-danger">
                <ul>
                    <?php foreach (session()->getFlashdata('errors') as $error): ?>
                        <li><?= esc($error); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>
        <form method="POST" action="<?= site_url('loginProcess') ?>">
            <?= csrf_field(); ?>
            <div class="input-group">
                <label for="username">Email</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="input-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit">Login</button>
        </form>
    </div>
</body>

</html>