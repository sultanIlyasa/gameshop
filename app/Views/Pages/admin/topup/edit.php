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
    <a href="/topup">
        <button>Back</button>
    </a>
    <form action="/topup/update/<?= $topup['topup_id']; ?>" method="post" style="display:flex; flex-direction:column; gap:5px" enctype="multipart/form-data">
        <?= csrf_field(); ?>
        <label for="game_id">Game</label>
        <select name="game_id" id="game_id"  required>
            <?php if($games): ?>
                <?php foreach($games as $game): ?>
                    <option value="<?= $game['game_id']; ?>" <?php if($game['game_id'] == $topup['game_id']) echo 'selected'; ?>>
                        <?= $game['title']; ?>
                    </option>
                <?php endforeach; ?>
             <?php else: ?>
                <option value="" disabled>No Data</option>
            <?php endif; ?>
        </select>
        <label for="title">Name</label>
        <input type="text" name="title" id="title" placeholder="26 Diamond" value="<?= $topup['topup_title']; ?>" required>
        <label for="price">Price</label>
        <input type="number" name="price" id="price" placeholder="Price" value="<?= $topup['price']; ?>" required>
        <button type="submit">Update topup</button>
    </form>
</div>

<?= $this->endSection(); ?>