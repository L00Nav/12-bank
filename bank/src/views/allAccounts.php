<?php

$title = 'Accounts';

require __DIR__ . '/top.php';
require __DIR__ . '/accountBar.php';
require __DIR__ . '/messages.php'
?>


<div class="contentContainer">

<?php require __DIR__ . '/navBar.php'; ?>

<main  class="mainContetBlock contentBox">
    <?php foreach($allAccounts as $account) : ?>
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
        </div>
    <?php endforeach ?>
</main>

</div>

<?php
require __DIR__ . '/bottom.php';


/*<ul>
<?php foreach($list as $value) : ?>

    <li><?= $value ?></li>

<?php endforeach ?>
</ul>*/