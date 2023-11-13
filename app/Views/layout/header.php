<header>
    <nav>
        <div>
            <h1>LOGO</h1>
        </div>
        <div class="nav-right">
            <div>
                <a href="<?= base_url('/'); ?>">Home</a>
                <a href="/profile">Profile</a>
            </div>
            <?php if(!session()->get('isLoggedIn')): ?>
                <div>
                    <a href="/login">Login</a>
                    <a href="/register">register</a>
                </div>
            <?php else: ?>
            <div>
                <a href="/logout">logout</a>
            </div>
            <?php endif; ?>
        </div>
    </nav>
</header>