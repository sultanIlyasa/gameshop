<?= $this->extend('/layout/templates'); ?>

<?= $this->section('content'); ?>

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
                <th>action</th>
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