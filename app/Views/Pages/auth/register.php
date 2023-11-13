<?= $this->extend('layout/templates'); ?>

<?= $this->section('content'); ?>

<main>
    <div class="register-container">
        <h2>Register</h2>
        <form action="/register" method="post" class="register-form">
            
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>

            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>

            <div class="form-group">
                <label for="confirm_password">Konfirmasi Password:</label>
                <input type="password" id="confirm_password" name="confirm_password" required>
            </div>


            <div class="form-group">
                <input type="submit" value="Register">
            </div>
        </form>
        <p>Sudah memiliki akun? <a href="/login">Login</a></p>
    </div>
</main>

<?= $this->endSection(); ?>