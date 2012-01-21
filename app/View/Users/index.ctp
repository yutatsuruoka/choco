<div class="users form">
<?php echo $this->Html->link('Login via Twitter', array('action' => 'twitter')); ?>

<!-- ここで$users配列をループして、投稿情報を表示 -->
<table>
	<?php foreach ($users as $user): ?>
	<tr>
		<td><?php echo $user['User']['id']; ?></td>
	</tr>
	<?php endforeach; ?>
</table>

</div>