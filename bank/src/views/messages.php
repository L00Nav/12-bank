<?php if(!empty($messages)) : ?>
<div>
    <?php foreach($messages as $message) : ?>
        <div class="<?= $message['type'] ?>"><?= $message['msg'] ?></div>
    <?php endforeach ?>
</div>
<?php endif ?>