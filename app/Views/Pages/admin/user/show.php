<?= $this->extend('/layout/templates'); ?>

<?= $this->section('content'); ?>

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