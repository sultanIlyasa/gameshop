<?= $this->extend('layout/templates'); ?>

<?= $this->section('content'); ?>

<main>
    <div class="register-container">
        <h2>Lupa Password</h2>
        <form action="/forgot-password" method="post" class="register-form">
            
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
                <input type="submit" value="Lupa Password">
            </div>
        </form>
    </div>
</main>

<?= $this->endSection(); ?>