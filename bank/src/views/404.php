<?php

$title = 'Page not found';

require __DIR__ . '/top.php';
require __DIR__ . '/accountBar.php';
require __DIR__ . '/messages.php'
?>


<div class="contentContainer">

<?php require __DIR__ . '/navBar.php'; ?>

<main  class="mainContetBlock contentBox">
    <h1>404 - page not found</h1>
    <p>Something went wrong. You wouldn't be responsible for this, would you, user?</p>
</main>

</div>

<?php
require __DIR__ . '/bottom.php';