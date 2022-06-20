<?php

$title = 'Accounts';

require __DIR__ . '/top.php';
require __DIR__ . '/accountBar.php';
require __DIR__ . '/messages.php'
?>


<div class="contentContainer">

<?php require __DIR__ . '/navBar.php'; ?>

<main  class="mainContetBlock contentBox left">
    <?php if (!isset($_SESSION['userID'])) : ?>
        Log in to manage your funds.
    <?php endif ?>
    <?php if (isset($_SESSION['userID'])) : ?>
            <?php echo ($account['lname'].' '.$account['fname'].'<br>') ?>
            <?php echo ($account['funds'].' €<br>') ?>
            <form class="left" action="deposit" method="post"><hr><br>
                Deposit amount: <input type="number" name="amount" step="0.01"><br>
                <input type="submit" value="Deposit" class="button">
            </form>
    <?php endif ?>
</main>

</div>

<?php
require __DIR__ . '/bottom.php';