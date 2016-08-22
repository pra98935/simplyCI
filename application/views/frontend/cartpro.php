<b>Products</b>
<table width="100%" border="1">
  <tr>
    <td width="37%">ID</td>
    <td width="30%">Name</td>
    <td width="16%">Price</td>
    <td width="16%">&nbsp;</td>
  </tr>
  <?php $key = 0;?>
  <?php foreach($products as $product):?>
  <tr>
    <td><?php echo $product['id'];?></td>
    <td><?php echo $product['name'];?></td>
    <td><?php echo $product['price'];?></td>
    <td><a href="?id=<?php echo $key;?>">Add to Cart</a></td>
  </tr>
  <?php $key ++;?>
  <?php endforeach;?>
</table>