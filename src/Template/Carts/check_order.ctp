<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Cart[]|\Cake\Collection\CollectionInterface $carts
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li><?= $this->Html->link(__('注文を確定する'), ['controller' => 'Orders', 'action' => 'fix_order']) ?></li>
        <li><?= $this->Html->link(__('カートへ戻る'), ['controller' => 'Carts', 'action' => 'Check_cart']) ?></li>
    </ul>
</nav>
<div class="carts index large-9 medium-8 columns content">
    <h3><?= __('注文する商品を確認してください') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('product_image') ?></th>
                <th scope="col"><?= $this->Paginator->sort('product_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('size') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($carts as $cart): ?>
            <tr>
                <td><?= $this->Number->format($cart->id) ?></td>
                <td><?= $cart->has('user') ? $this->Html->link($cart->user->uname, ['controller' => 'Users', 'action' => 'view', $cart->user->id]) : '' ?></td>
                <td><?= $this->Html->image($cart->product->image, array('height' => 100, 'width' => 100)) ?></td>
                <td><?= $cart->has('product') ? $this->Html->link($cart->product->pname, ['controller' => 'Products', 'action' => 'view', $cart->product->id]) : '' ?></td>
                <td><?= $this->Number->format($cart->size) ?></td>
                <td><?= h($cart->created) ?></td>
                <td><?= h($cart->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('数量変更　'), ['action' => 'edit', $cart->id]) ?>
                    <?= $this->Form->postLink(__('カートへ戻す'), ['action' => 'back_cart', $cart->id]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>