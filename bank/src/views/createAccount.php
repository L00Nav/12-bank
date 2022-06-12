<?php

$title = 'Accounts';

require __DIR__ . '/top.php';
require __DIR__ . '/accountBar.php';
require __DIR__ . '/messages.php'
?>


<div class="contentContainer">

<?php require __DIR__ . '/navBar.php';?>

<main  class="mainContetBlock contentBox">
    <form class="mainContent" action="createAccount" method="post">
        <label for="fname">First name:</label><br>
        <input type="text" name="fname"><br><br>
        <label for="lname">Last name:</label><br>
        <input type="text" name="lname"><br><br>
        <label for="email">Email:</label><br>
        <input type="email" name="email"><br><br>
        <label for="pnumber">Personal ID number:</label><br>
        <input type="text" name="pnumber"><br><br>
        <label for="anumber">Account number:</label><br>
        <input type="text" name="anumber" value="<?= $iban ?>" readonly><br><br>
        <label for="pass">Password:</label><br>
        <input type="password" name="pass"><br><br>
        <input type="hidden" name="requestType" value="createAccount">
        <input class="button" type="submit" value="Submit">
    </form>
</main>

</div>

<?php
require __DIR__ . '/bottom.php';


/*<ul>
<?php foreach($list as $value) : ?>

    <li><?= $value ?></li>

<?php endforeach ?>
</ul>*/