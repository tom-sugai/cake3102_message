<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<h3>商品注文システム<h3/>
<!--<p><?=$message?></P>-->
<div class="users form large-9 medium-8 columns content">
    <?= $this->Form->create($user) ?>
    <fieldset>
        <legend><?= __('ユーザー名の確認') ?></legend>
        <?php
            echo $this->Form->control('uname');
        ?>
    </fieldset>
    <?= $this->Form->button(__('登録確認')) ?>
    <?= $this->Form->end() ?>
</div>