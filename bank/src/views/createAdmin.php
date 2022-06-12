<?php

$title = 'Omnicorp Bank Division';

require __DIR__ . '/top.php';
require __DIR__ . '/accountBar.php';
require __DIR__ . '/messages.php'
?>


<div class="contentContainer">

<?php require __DIR__ . '/navBar.php'; ?>

<main  class="mainContetBlock contentBox">
<form class="mainContent" action="adminCreate" method="post">
        <label for="adminName">Username:</label><br>
        <input type="text" name="adminName"><br><br>
        <label for="adminPass">Password:</label><br>
        <input type="password" name="adminPass"><br><br>
        <input class="button" type="submit" value="Submit">
    </form>
</main>

</div>

<?php
require __DIR__ . '/bottom.php';