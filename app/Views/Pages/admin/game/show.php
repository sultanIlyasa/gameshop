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
    <a href="/game/new">
        <button type="submit">Add New game</button>
    </a>
    <table style="width:100%;text-align:center;">
        <thead>
            <tr>
                <th>No</th>
                <th>Game</th>
                <th>Deskripsi</th>
                <th>Sampul</th>
                <th>Created At</th>
                <th>Updated At</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if($games): ?>
            <?php $i = 1; ?>
            <?php foreach($games as $game): ?>
            <tr >
                <td><?= $i++; ?></td>
                <td><?= $game['title']; ?></td>
                <td><?= $game['description']; ?></td>
                <td>
                    <img src="assets/images/games/<?= $game['game_image']; ?>" alt="" style="width:100px">
                </td>
                <td><?= $game['created_at']; ?></td>
                <td><?= $game['updated_at']; ?></td>
                <td>
                    <div style="display:flex; flex-direction:row; justify-content:center; gap:3px; align-items:center; ">
                        <a href="/game/edit/<?= $game['slug']; ?>">
                            <button type="submit">Edit</button>
                        </a>
                        <form action="/game/delete/<?= $game['slug']; ?>" method="post">
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