<?= $this->extend('layout/templates'); ?>

<?= $this->section('content'); ?>
    
<div>
    <a href="/profile">
        <button>Back</button>
    </a>
    <form action="/profile/update/<?= session()->get('user_id'); ?>" method="post" style="display:flex; flex-direction:column; gap:5px" enctype="multipart/form-data">
        <?= csrf_field(); ?>
        <label for="name">Name</label>
        <input type="text" name="name" id="name" placeholder="Name" value="<?= $user['name']; ?>" required>
        <label for="email">Email</label>
        <input type="email" name="email" id="email" placeholder="Email" value="<?= $user['email']; ?>" required>
        <button type="submit">update User</button>
    </form>
    <form action="/profile/update-password/<?= $user['user_id']; ?>" method="post" style="display:flex; flex-direction:column; gap:5px" enctype="multipart/form-data">
        <?= csrf_field(); ?>
        <label for="old_password">Password Lama</label>
        <input type="password" name="old_password" id="old_password" placeholder="Password Lama" required>
        <label for="password">Password</label>
        <input type="password" name="password" id="password" placeholder="Password" required>
        <label for="confirm_password">Konfirmasi Password</label>
        <input type="password" name="confirm_password" id="confirm_password" placeholder="Konfirmasi Password" required>
        <button type="submit">Update Password</button>
    </form>
</div>

<?= $this->endSection(); ?>