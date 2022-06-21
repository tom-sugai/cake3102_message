<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Order $order
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
    <!--
        <li><?= $this->Html->link(__('Edit Order'), ['action' => 'edit', $order->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Order'), ['action' => 'delete', $order->id], ['confirm' => __('Are you sure you want to delete # {0}?', $order->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Orders'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Order'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Details'), ['controller' => 'Details', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Detail'), ['controller' => 'Details', 'action' => 'add']) ?> </li>
    -->
        <li><?= $this->Html->link(__('商品選択に戻る'), ['controller' => 'Products', 'action' => 'select']) ?> </li>
    </ul>
    </nav>
    <div class="related">
    <h4><?= __('注文ありがとうございます！　ご注文の内容は以下の通りです') ?></h4>
    <?php if (!empty($order->details)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Order Id') ?></th>
                <th scope="col"><?= __('Product image') ?></th>
                <th scope="col"><?= __('Product Name') ?></th>
                <th scope="col"><?= __('Size') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
            <!--    <th scope="col" class="actions"><?= __('Actions') ?></th> -->
            </tr>
            <?php foreach ($order->details as $details): ?>
            <tr>
                <td><?= h($details->id) ?></td>
                <td><?= h($details->order_id) ?></td>
                <td><?= $this->Html->image($details->product->image, array('height' => 100, 'width' => 100)) ?></td>
                <td><?= h($details->product->pname) ?></td>
                <td><?= h($details->size) ?></td>
                <td><?= h($details->created) ?></td>
                <td><?= h($details->modified) ?></td>
        <!--
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Details', 'action' => 'view', $details->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Details', 'action' => 'edit', $details->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Details', 'action' => 'delete', $details->id], ['confirm' => __('Are you sure you want to delete # {0}?', $details->id)]) ?>
                </td>
        -->
            </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
    </div>
    <div class="orders view large-9 medium-8 columns content">
    <h3><?= "注文番号　:　" . h($order->id) ?></h3>
        <table class="vertical-table">
            <tr>
                <th scope="row"><?= __('User') ?></th>
                <td><?= $order->has('user') ? $this->Html->link($order->user->uname, ['controller' => 'Users', 'action' => 'view', $order->user->id]) : '' ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Note1') ?></th>
                <td><?= h($order->note1) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Note2') ?></th>
                <td><?= h($order->note2) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Order-Id') ?></th>
                <td><?= $this->Number->format($order->id) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Created') ?></th>
                <td><?= h($order->created) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Modified') ?></th>
                <td><?= h($order->modified) ?></td>
            </tr>
        </table>
    </div>

