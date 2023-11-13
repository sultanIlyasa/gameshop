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
    <a href="/game">
        <button>Back</button>
    </a>
    <form action="/game/update/<?= $game['slug']; ?>" method="post" style="display:flex; flex-direction:column; gap:5px" enctype="multipart/form-data">
        <?= csrf_field(); ?>
        <label for="title">Judul</label>
        <input type="text" name="title" id="title" placeholder="Judul" value="<?= $game['title']; ?>" required>
        <label for="description">Deskripsi</label>
        <input type="text" name="description" id="description" placeholder="Deskripsi" value="<?= $game['description']; ?>" required>
        <label for="image">Image</label>
        <input type="file" name="image" id="image" placeholder="Image">
        <button type="submit">Add Game</button>
    </form>
</div>

<?= $this->endSection(); ?>