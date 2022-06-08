<?php

$title = 'ADD';

require __DIR__ . '/top.php';
?>


<h1>Sweet Home Alabama</h1>

<ul>
<?php foreach($list as $value) : ?>

    <li><?= $value ?></li>

<?php endforeach ?>
</ul>

<?php
require __DIR__ . '/bottom.php';