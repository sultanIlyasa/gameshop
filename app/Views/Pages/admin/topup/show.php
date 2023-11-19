<?= $this->extend('/layout/templates'); ?>

<?= $this->section('content'); ?>
<div>
    <a href="/topup/new">
        <button type="submit">Add New topup</button>
    </a>
    <table style="width:100%;text-align:center">
        <thead>
            <tr>
                <th>No</th>
                <th>Game</th>
                <th>Topup</th>
                <th>Price</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if($topups): ?>
            <?php $i = 1; ?>
            <?php foreach($topups as $topup): ?>
            <tr>
                <td><?= $i++; ?></td>
                <td><?= $topup['title']; ?></td>
                <td><?= $topup['topup_title']; ?></td>
                <td><?= $topup['price']; ?></td>
                <td>
                    <div style="display:flex; justify-content: center; gap:3px;">
                        <a href="/topup/edit/<?= $topup['topup_id']; ?>">
                            <button type="submit">Edit</button>
                        </a>
                        <form action="/topup/delete/<?= $topup['topup_id']; ?>" method="post">
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