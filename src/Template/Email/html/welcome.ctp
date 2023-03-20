<?= $order->id ?><br>
<?= $order->user->username ?><br>
<?= $order->details[0]->product->pname ?><br>
<?php $imgurl = 'src = "http://lavie.home.com/cake3/cake3102_message/webroot/img/' . $order->details[0]->product->image . "\""; ?>
<img <?= $imgurl ?> height="100" width="100" alt=""/><br>
<!--<?= $this->Html->image($order->details[0]->product->image, array('height' => 100, 'width' => 100)) ?></td><br>-->
<?= $order->details[0]->product->price ?><br>
<?= $order->details[0]->size ?><br>
<?php
    $uprice = $order->details[0]->product->price;
    $quantity = $order->details[0]->size;
    $amount = $uprice * $quantity; 
 ?>
<?= $amount ?><br>
<?= $order->note1 ?><br>
<?= $order->note2 ?><br>
