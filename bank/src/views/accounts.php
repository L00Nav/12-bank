<?php

$title = 'Accounts';

require __DIR__ . '/top.php';
require __DIR__ . '/accountBar.php';
require __DIR__ . '/messages.php'
?>


<div class="contentContainer">

<?php require __DIR__ . '/navBar.php'; ?>

<main  class="mainContetBlock contentBox">
    <?php if (!isset($_SESSION['user'])) : ?>
        Log in to see your account.
    <?php endif ?>
    <?php if (isset($_SESSION['user'])) : ?>
        <div class="left contentBox">
            <?php echo ($_SESSION['user']['lname'].' '.$_SESSION['user']['fname'].'<br><hr>') ?>
            <?php echo ($_SESSION['user']['email'].'<br>') ?>
            <?php echo ($_SESSION['user']['pnumber'].'<br>') ?>
            <?php echo ($_SESSION['user']['anumber'].'<br>') ?>
            <?php echo ($_SESSION['user']['funds'].' €<br>') ?>
        </div>
    <?php endif ?>
</main>

</div>

<?php
require __DIR__ . '/bottom.php';


/*<ul>
<?php foreach($list as $value) : ?>

    <li><?= $value ?></li>

<?php endforeach ?>
</ul>*/