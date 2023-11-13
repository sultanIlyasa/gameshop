<header>
    <nav>
        <div>
            <a href="/">
                <h1>LOGO</h1>
            </a>
        </div>
        <div class="nav-right">
            <?php if(!session()->get('isLoggedIn')): ?>
                <div>
                    <a href="/login">Login</a>
                    <a href="/register">register</a>
                </div>
            <?php else: ?>
            <div>
                <a href="/profile">Profile</a>
            </div>
            <div>
                <a href="/logout">logout</a>
            </div>
            <?php endif; ?>
        </div>
    </nav>
</header>