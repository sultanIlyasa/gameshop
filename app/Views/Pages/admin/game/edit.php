<?= $this->extend('layout/templates'); ?>

<?= $this->section('content'); ?>

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