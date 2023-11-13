<?= $this->extend('layout/templates'); ?>

<?= $this->section('content'); ?>

<div>
    <a href="/game">
        <button>Back</button>
    </a>
    <form action="/game/create" method="post" style="display:flex; flex-direction:column; gap:5px" enctype="multipart/form-data">
        <?= csrf_field(); ?>
        <label for="title">Title</label>
        <input type="text" name="title" id="title" placeholder="Title" required>
        <label for="description">Description</label>
        <input type="text" name="description" id="description" placeholder="Description" required>
        <label for="image">Image</label>
        <input type="file" name="image" id="image" placeholder="Image" required>
        <button type="submit">Add Game</button>
    </form>
</div>

<?= $this->endSection(); ?>