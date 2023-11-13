<style>
    header {
    background-color: #333;
    color: white;
    padding: 10px 0;
    text-align: center;
}

header h1 {
    margin: 0;
}

</style>
<header>
    <h1>Admin Gameshop</h1>
    <ul style="display:flex; justify-content: center; gap:10px;">
        <li style="display:flex; justify-content: center; gap:10px;">
            <a href="<?= base_url('/'); ?>">Home</a>
            <a href="/user">User</a>
            <a href="/game">Game</a>
            <a href="/topup">Topup</a>
            <a href="/transaction">Transaction</a>
        </li>
    </ul>
</header>