<?= $this->extend('layout/templates'); ?>

<?= $this->section('content'); ?>

<main>
    <div class="profile-container">
        <h2>Profile</h2>
        <div class="profile">
            <div class="profile-info">
                <h3><?= $user['name']; ?></h3>
                <p><?= $user['email']; ?></p>
                <a href="/profile/edit/<?= session()->get('user_id'); ?>">Edit Profile</a>
            </div>
        </div>
    </div>
    <div>
        <h1>Tabel Transaksi</h1>
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Game</th>
                    <th>Game ID</th>
                    <th>Metode Pembayaran</th>
                    <th>Total Pembayaran</th>
                    <th>Bukti Pembayaran</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($transactions) : ?>
                    <?php $i = 1; ?>
                    <?php foreach ($transactions as $transaction) : ?>
                        <tr>
                            <td><?= $i++; ?></td>
                            <td><?= $transaction['title']; ?></td>
                            <td><?= $transaction['gameuser_id']; ?></td>
                            <td><?= $transaction['payment_method']; ?></td>
                            <td><?= $transaction['total_payment']; ?></td>
                            <td>
                                <img src="assets/images/transactions/<?= $transaction['payment_image']; ?>" alt="" style="width:100px">
                            </td>
                            <td><?= $transaction['created_at']; ?></td>
                            <td><?= $transaction['updated_at']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="8">No Data</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</main>

<?= $this->endSection() ?>