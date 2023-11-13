<?= $this->extend('/layout/templates'); ?>

<?= $this->section('content'); ?>
<style>
    /* styles.css */

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
                <th>Action</th>
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