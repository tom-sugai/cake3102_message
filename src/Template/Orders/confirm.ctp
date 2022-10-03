<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Order $order
 */
?>
<nav>
    <ul>
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('商品選択に戻る'), ['controller' => 'Products', 'action' => 'select']) ?> </li>
    </ul>
</nav>
<div>
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
            </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
</div>
<div>
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

