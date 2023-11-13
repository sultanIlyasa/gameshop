<?= $this->extend('/layout/templates'); ?>

<?= $this->section('content'); ?>

<div>
    <a href="/transaction/new">
        <button type="submit">Add New transaction</button>
    </a>
    <table style="width:100%;text-align:center;">
        <thead>
            <tr>
                <th>No</th>
                <th>Game</th>
                <th>User</th>
                <th>Game ID</th>
                <th>Server</th>
                <th>Methode Payment</th>
                <th>Total Payment</th>
                <th>Payment Image</th>
                <th>Created At</th>
                <th>Updated At</th>
                <th>action</th>
            </tr>
        </thead>
        <tbody>
            <?php if($transactions): ?>
            <?php $i = 1; ?>
            <?php foreach($transactions as $transaction): ?>
            <tr >
                <td><?= $i++; ?></td>
                <td><?= $transaction['title']; ?></td>
                <td><?= $transaction['name']; ?></td>
                <td><?= $transaction['gameuser_id']; ?></td>
                <td><?= $transaction['game_location']; ?></td>
                <td><?= $transaction['payment_method']; ?></td>
                <td><?= $transaction['total_payment']; ?></td>
                <td>
                    <img src="/assets/images/transactions/<?= $transaction['payment_image']; ?>" alt="<?= $transaction['payment_image']; ?>" width="100px">
                </td>
                <td><?= $transaction['created_at']; ?></td>
                <td><?= $transaction['updated_at']; ?></td>
                <td>
                    <div style="display:flex; flex-direction:row; justify-content:center; gap:3px; align-items:center; ">
                        <a href="/transaction/edit/<?= $transaction['transaction_id']; ?>">
                            <button type="submit">Edit</button>
                        </a>
                        <form action="/transaction/delete/<?= $transaction['transaction_id']; ?>" method="post">
                            <button type="submit">Delete</button>
                        </form>
                    </div>
                </td>
            </tr>
            <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="11">No Data</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?= $this->endSection(); ?>