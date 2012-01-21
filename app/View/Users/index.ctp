<!-- File: /app/View/Users/index.ctp -->

<div class="cen">
	<h1>ユーザー一覧</h1>
</div>
<!-- ここで$users配列をループして、投稿情報を表示 -->
<table>
	<?php foreach ($users as $user): ?>
	<tr>
		<td><?php echo $this->Html->link($user['User']['id'], array('action' => 'view', $user['User']['id']));?>
		<td><?php echo $user['User']['name']; ?></td>
		<td><?php echo $user['User']['address']; ?></td>
		<td><?php echo $user['User']['tel']; ?></td>
		<td><?php echo $user['User']['money']; ?></td>
	</tr>
	<?php endforeach; ?>
</table>