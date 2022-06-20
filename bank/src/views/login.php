<?php

$title = 'Omnicorp Bank Division';

require __DIR__ . '/top.php';
require __DIR__ . '/accountBar.php';
require __DIR__ . '/messages.php'
?>


<div class="contentContainer">

<?php require __DIR__ . '/navBar.php'; ?>

<main  class="mainContetBlock contentBox">
<form class="mainContent" action="login" method="post">
        <label for="email">Email:</label><br>
        <input type="email" name="email"><br><br>
        <label for="pass">Password:</label><br>
        <input type="password" name="pass"><br><br>
        <input type="hidden" name="requestType" value="createAccount">
        <input class="button" type="submit" value="Login">
    </form>
</main>

</div>

<?php
require __DIR__ . '/bottom.php';