<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Detail Entity
 *
 * @property int $id
 * @property int $order_id
 * @property int $product_id
 * @property int $size
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \App\Model\Entity\Order $order
 * @property \App\Model\Entity\Product $product
 */
class Detail extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'order_id' => true,
        'user_id' => true,
        'product_id' => true,
        'size' => true,
        'created' => true,
        'modified' => true,
    ];
}
