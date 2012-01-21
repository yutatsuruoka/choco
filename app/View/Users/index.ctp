<!-- File: /app/View/Users/index.ctp -->


<!-- ここで$users配列をループして、投稿情報を表示 -->
<table>
	<?php foreach ($users as $user): ?>
	<tr>
		<td><?php echo $user['User']['id']; ?></td>
	</tr>
	<?php endforeach; ?>
</table>