<?= $this->extend('layout/templates'); ?>

<?= $this->section('content'); ?>
<style>

body {
    font-family: Arial, sans-serif;
    background-color: #f2f2f2;
    margin: 0;
    padding: 0;
}

header {
    background-color: #333;
    color: white;
    padding: 10px 0;
    text-align: center;
}

header h1 {
    margin: 0;
}

ul {
    list-style: none;
    padding: 0;
    margin: 0;
    display: flex;
    justify-content: center;
    gap: 10px;
}

li {
    display: flex;
    justify-content: center;
    gap: 10px;
}

a {
    text-decoration: none;
    color: white;
    font-weight: bold;
    padding: 5px 10px;
    border-radius: 5px;
    transition: background-color 0.3s ease;
}

a:hover {
    background-color: #555;
}

.container {
    margin-top: 20px;
    display: flex;
    flex-direction: column;
    align-items: center;
}

button {
    background-color: #4caf50;
    color: white;
    padding: 8px 16px;
    border: none;
    cursor: pointer;
    border-radius: 4px;
    margin-top: 10px;
}

button:hover {
    background-color: #45a049;
}

form {
    display: flex;
    flex-direction: column;
    gap: 10px;
    margin-top: 20px;
    width: 500px;
    margin: 20px auto;

label {
    font-size: 14px;
    color: #555;
}

input {
    width: 100%;
    padding: 8px;
    box-sizing: border-box;
    border: 1px solid #ccc;
    border-radius: 4px;
    font-size: 14px;
}

footer {
    background-color: #333;
    color: white;
    text-align: center;
    padding: 10px 0;
    position: fixed;
    bottom: 0;
    width: 100%;
}

</style>

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