<?= $this->extend('/layout/templates'); ?>

<?= $this->section('content'); ?>

<style>
body {
    font-family: Arial, sans-serif;
    background-color: #f2f2f2;
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

.content-container {
    margin-top: 20px;
}

button {
    background-color: #4caf50;
    color: white;
    padding: 8px 16px;
    border: none;
    cursor: pointer;
    border-radius: 4px;
}

button:hover {
    background-color: #45a049;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

th, td {
    border: 1px solid #ddd;
    padding: 8px;
}

th {
    background-color: #4caf50;
    color: white;
}

td img {
    max-width: 100px;
    height: auto;
}

</style>
<div>
    <a href="/user/new">
        <button type="submit">Add New User</button>
    </a>
    <table style="width:100%;text-align:center">
        <thead>
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Created At</th>
                <th>Updated At</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if($users): ?>
            <?php $i = 1; ?>
            <?php foreach($users as $user): ?>
            <tr>
                <td><?= $i++; ?></td>
                <td><?= $user['name']; ?></td>
                <td><?= $user['email']; ?></td>
                <td><?= $user['role']; ?></td>
                <td><?= $user['created_at']; ?></td>
                <td><?= $user['updated_at']; ?></td>
                <td>
                    <div style="display:flex; justify-content: center; gap:3px;">
                        <a href="/user/edit/<?= $user['user_id']; ?>">
                            <button type="submit">Edit</button>
                        </a>
                        <form action="/user/delete/<?= $user['user_id']; ?>" method="post">
                            <button type="submit">Delete</button>
                        </form>
                    </div>
                </td>
            </tr>
            <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="7">No Data</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?= $this->endSection(); ?>