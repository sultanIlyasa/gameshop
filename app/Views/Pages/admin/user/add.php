<?= $this->extend('layout/templates'); ?>

<?= $this->section('content'); ?>

<div>
    <a href="/user">
        <button>Back</button>
    </a>
    <form action="/user/create" method="post" style="display:flex; flex-direction:column; gap:5px" enctype="multipart/form-data">
        <?= csrf_field(); ?>
        <label for="name">Name</label>
        <input type="text" name="name" id="name" placeholder="Name" required>
        <label for="email">Email</label>
        <input type="email" name="email" id="email" placeholder="Email" required>
        <label for="password">Password</label>
        <input type="password" name="password" id="password" placeholder="Password" required>
        <label for="confirm_password">Password Confirm</label>
        <input type="password" name="confirm_password" id="password_confirm" placeholder="Password Confirm" required>
        <button type="submit">Add User</button>
    </form>
</div>

<?= $this->endSection(); ?>