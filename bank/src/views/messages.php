<?php if(!empty($messages)) : ?>
<div class="messageBox">
    <?php foreach($messages as $message) : ?>
        <div class="contentBox">
            <div class="<?= $message['type'] ?>">
                <span class="messageSymbol">
                    <?= $message['type'] == 'success' ? '✓ ' : ''?>
                    <?= $message['type'] == 'alert' ? '✕ ' : ''?>
                </span>
                <?= $message['msg'] ?>
            </div>
        </div>
    <?php endforeach ?>
</div>
<?php endif ?>