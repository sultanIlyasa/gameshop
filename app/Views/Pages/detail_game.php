<?= $this->extend('layout/templates'); ?>

<?= $this->section('content'); ?>

<?php $paymentMethods = [
    [
        "title" => "DANA",
        "NO" => "089732314123"
    ],
    [
        "title" => "OVO",
        "NO" => "08912831231"
    ],
    [
        "title" => "GOPAY",
        "NO" => "689131232"
    ],
    [
        "title" => "BANK BCA",
        "NO" => "90009323"
    ],
    [
        "title" => "BANK BNI",
        "NO" => "098885722"
    ],
    [
        "title" => "BANK BRI",
        "NO" => "880057732"
    ],
    [
        "title" => "BANK MANDIRI",
        "NO" => "990007422"
    ]

];
// dd($paymentMethods) 
?>



<main>
    <h1>Detail Game</h1>
    <div style="display:flex; justify-content:start; align-items:center; gap:5vh">
        <?php if ($game) : ?>
            <div style="display:flex; flex-direction:column; align-items:start">
                <img src="/assets/images/games/<?= $game['game_image']; ?>" alt="<?= $game['title']; ?>" width="100%">
                <h3><?= $game['title']; ?></h3>
                <p><?= $game['description']; ?></p>
            </div>
        <?php else : ?>
            <p>No Data</p>
        <?php endif; ?>
    </div>
    <div>
        <form action="/checkout/<?= $game['slug']; ?>" method="post" enctype="multipart/form-data">
            <div>
                <h1>Masukan informasi ID</h1>
                <label for="gameuser_id">Player ID</label>
                <input type="text" name="gameuser_id" id="gameuser_id" placeholder="Masukan Player ID" required>
                <label for="game_location">Server</label>
                <input type="text" name="game_location" id="game_location" placeholder="Masukan server (jika tidak ada kosongkan)" required>
            </div>
            <div>
                <h1>Pilih Top Up</h1>
                <select name="price" id="price">
                    <?php if ($topups) : ?>
                        <option value="" selected disabled>Pilih Top Up</option>
                        <?php foreach ($topups as $topup) : ?>
                            <option value="<?= $topup['price']; ?>"><?= $topup['topup_title']; ?>, Rp <?= $topup['price']; ?></option>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <option value="" selected disabled>No Data</option>
                    <?php endif; ?>
                </select>
            </div>
            <div>
                <h1>Pilih Pembayaran</h1>
                <select name="payment_method" id="payment_method">
                    <?php if ($paymentMethods) : ?>
                        <?= $i = 0; ?>
                        <option value="" selected disabled>Pilih Pembayaran</option>
                        <?php foreach ($paymentMethods as $payment) : ?>
                            <option value="<?= $payment['title'] ?>"><?= $payment['title']; ?> No Rek <?= $payment['NO'] ?></option>
                            <?= $i++; ?>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <option value="" selected disabled>No Data</option>
                    <?php endif; ?>
                </select>
            </div>
            <div>
                <h1>Bukti Pembayaran</h1>
                <label for="image">Upload Bukti Pembayaran</label>
                <input type="file" name="image" id="image" required>
            </div>
            <button type="submit">
                Beli
            </button>
        </form>
    </div>
</main>

<?= $this->endSection(); ?>