<!-- File: /app/View/Posts/index.ctp -->

<div class = "cen">
	<h1>Blog posts</h1>
	<h2><?php echo $this->Html->link('チョコをねだってみる!!!', array('action' => 'add')); ?></2>
</div>
<table>
    <tr>
        <th>doy_id</th>
        <th>girl_id</th>
        <th>user_name</th>
        <th>postal_code</th>
        <th>state</th>
        <th>city</th>
        <th>address_number</th>
        <th>apartment_name</th>
        <th>created</th>
    </tr>
<!-- ここで$posts配列をループして、投稿情報を表示 -->
	<?php foreach ($posts as $post): ?>
	<tr>
		<td><?php echo $post['Post']['doy_id']; ?></td>
		<td><?php echo $post['Post']['girl_id']; ?></td>
		<td><?php echo $post['Post']['user_name']; ?></td>
		<td><?php echo $post['Post']['postal_code']; ?></td>
		<td><?php echo $post['Post']['state']; ?></td>
		<td><?php echo $post['Post']['city']; ?></td>
		<td><?php echo $post['Post']['address_number']; ?></td>
		<td><?php echo $post['Post']['apartment_name']; ?></td>
		<td><?php echo $post['Post']['created']; ?></td>
	</tr>
	<?php endforeach; ?>
</table>