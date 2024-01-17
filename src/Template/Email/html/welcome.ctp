<?= $order->id ?><br>
<?= $order->user->username ?><br>
<?php $total = 0; ?>
<?php foreach ($order->details as $detail): ?>
		<?= $detail->product->pname ?>
		<?php $imgurl = 'src = "http://fmva52.home.com/cake3/cake3102_message/webroot/img/' . $detail->product->image . "\""; ?>
		<img <?= $imgurl ?> height="100" width="100" alt=""/>	        
        <?= $detail->product->price ?> * <?= $detail->size ?> ==> 
        <?php
		    $uprice = $order->details[0]->product->price;
		    $quantity = $order->details[0]->size;
		    $amount = $uprice * $quantity;
            $total = $total + $amount; 
		 ?>
		<?= "金額 " . $amount . " 円" ?><br>
<?php endforeach; ?>
<hr></hr>
<?= "注文合計 " . $total . " 円" ?><br>
<?= $order->note1 ?><br>
<?= $order->note2 ?><br>
