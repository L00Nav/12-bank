function AccountBar()
{
    return (
        <>
            <div  class="accountBar">
                <?php if($loggedIn) : ?>
                    <div class="contentBox">
                        <a class="navLink" href="accounts"><?= $fullName ?></a>
                    </div>
                <?php endif ?>
                <?php if(!$loggedIn) : ?>
                    <div class="contentBox">
                        <a class="navLink" href="login">Login</a>
                    </div>
                <?php endif ?>
                <?php if($loggedIn) : ?>
                    <div class="contentBox">
                        <form action="logout" method="post">
                            <button class="logout" type="submit">Logout</a>
                        </form>
                    </div>
                <?php endif ?>
                <?php if(!$loggedIn) : ?>
                    <div class="contentBox">
                        <a class="navLink" href="accountCreationForm">Register</a>
                    </div>
                <?php endif ?>
</div>
        </>
    )
}

export defaultAccountBar