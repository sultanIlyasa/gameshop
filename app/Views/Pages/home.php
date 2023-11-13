<?= $this->extend('layout/templates'); ?>

<?= $this->section('content'); ?>
    
<main>
    <h1>Halaman utama</h1>
    <h1>Daftar Games</h1>
    <div style="display:flex; justify-content:start; align-items:center; gap:5vh">
        <?php if($games): ?>
        <?php $i=1; ?>
        <?php foreach($games as $game): ?>
        <a href="/<?= $game['slug']; ?>">
            <div style="display:flex; flex-direction:column; align-items:start">
                <img src="/assets/images/games/<?= $game['game_image']; ?>" alt="<?= $game['title']; ?>" width="100%">
                <h3><?= $game['title']; ?></h3>
                <p><?= $game['description']; ?></p>
            </div>
        </a>      
        <?php endforeach; ?>
        <?php else: ?>
        <p>No Data</p>
        <?php endif; ?>
    </div>
</main>

<?= $this->endSection(); ?>
