<?= $this->extend('layout/templates'); ?>

<?= $this->section('content'); ?>
<style>
    /* styles.css */

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
}

label {
    font-size: 14px;
    color: #555;
}

input, textarea {
    width: 100%;
    padding: 8px;
    box-sizing: border-box;
    border: 1px solid #ccc;
    border-radius: 4px;
    font-size: 14px;
}

input[type="file"] {
    border: none;
    padding: 0;
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
    <a href="/transaction">
        <button>Back</button>
    </a>
    <form action="/transaction/update/<?= $transaction['transaction_id'] ?>" method="post" style="display:flex; flex-direction:column; gap:5px" enctype="multipart/form-data">
        <?= csrf_field(); ?>
        <label for="game_id">Game</label>
        <select name="game_id" id="game_id" required>
            <?php if($games): ?>
                <?php foreach($games as $game): ?>
                    <option value="<?= $game['game_id']; ?>" <?php if($game['game_id'] == $transaction['game_id']) echo 'selected'; ?>><?= $game['title']; ?></option>
                <?php endforeach; ?>
            <?php else: ?>
                <option value="" disabled>No Data</option>
            <?php endif; ?>
        </select>
         <label for="user_id">Game</label>
        <select name="user_id" id="user_id" required>
            <option value="">-- Select User --</option>
            <?php if($users): ?>
                <?php foreach($users as $user): ?>
                    <option value="<?= $user['user_id']; ?>" <?php if($user['user_id'] == $transaction['user_id']) echo 'selected'; ?>><?= $user['name']; ?></option>
                <?php endforeach; ?>
            <?php else: ?>
                <option value="" disabled>No Data</option>
            <?php endif; ?>
        </select>
        <label for="gameuser_id">Game ID</label>
        <input type="text" name="gameuser_id" id="gameuser_id" placeholder="13092844" value="<?= $transaction['gameuser_id']; ?>" required>
        <label for="game_location">Server</label>
        <input type="text" name="game_location" id="game_location" placeholder="Server" value="<?= $transaction['game_location']; ?>" required>
        <label for="payment_method">Payment Method</label>
        <input type="text" name="payment_method" id="payment_method" placeholder="Payment Method" value="<?= $transaction['payment_method']; ?>" required>
        <label for="total_payment">Total Payment</label>
        <input type="number" name="total_payment" id="total_payment" placeholder="Total Payment" value="<?= $transaction['total_payment']; ?>" required>
        <label for="image">Payment Image</label>
        <input type="file" name="image" id="image" value="<?= $transaction['payment_image']; ?>" >
        <button type="submit">Add transaction</button>
    </form>
</div>

<?= $this->endSection(); ?>