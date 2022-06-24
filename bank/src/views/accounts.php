<?php

$title = 'Accounts';

require __DIR__ . '/top.php';
require __DIR__ . '/accountBar.php';
require __DIR__ . '/messages.php'
?>


<div class="contentContainer">

<?php require __DIR__ . '/navBar.php'; ?>

<main  class="mainContetBlock contentBox">
    <?php if (!$userAuth && !$adminAuth) : ?>
        Log in to see your account.
    <?php endif ?>
    <?php if ($userAuth || $adminAuth) : ?>
        <?php foreach($accounts as $account) : ?>
        <div class="contentBox fundsButtonBox left">
            <?php echo ($account['lname'].' '.$account['fname'].'<br><hr>') ?>
            <?php echo ($account['email'].'<br>') ?>
            <?php echo ($account['pnumber'].'<br>') ?>
            <?php echo ($account['anumber'].'<br>') ?>
            <?php echo ($account['funds'].' €<br><br>') ?>
            <div class="contentBox fundsButtonBox left">
                <a href="addFunds" class="navLink">Deposit</a>
            </div>
            <div class="contentBox fundsButtonBox left">
                <a href='withdrawFunds' class='navLink'>Withdraw</a>
            </div>
            <div class="contentBox fundsButtonBox left">
                <a href="addFunds" class="navLink">Delete</a>
            </div>
        </div>
    <?php endforeach ?>
    <?php endif ?>
</main>

</div>

<?php
require __DIR__ . '/bottom.php';