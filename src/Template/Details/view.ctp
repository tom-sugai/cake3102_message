<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Detail $detail
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Detail'), ['action' => 'edit', $detail->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Detail'), ['action' => 'delete', $detail->id], ['confirm' => __('Are you sure you want to delete # {0}?', $detail->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Details'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Detail'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Orders'), ['controller' => 'Orders', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Order'), ['controller' => 'Orders', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Products'), ['controller' => 'Products', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Product'), ['controller' => 'Products', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="details view large-9 medium-8 columns content">
    <h3><?= h($detail->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Order') ?></th>
            <td><?= $detail->has('order') ? $this->Html->link($detail->order->id, ['controller' => 'Orders', 'action' => 'view', $detail->order->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Product') ?></th>
            <td><?= $detail->has('product') ? $this->Html->link($detail->product->id, ['controller' => 'Products', 'action' => 'view', $detail->product->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($detail->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Size') ?></th>
            <td><?= $this->Number->format($detail->size) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($detail->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($detail->modified) ?></td>
        </tr>
    </table>
</div>
