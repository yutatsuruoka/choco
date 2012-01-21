<!-- File: /app/View/Posts/index.ctp -->

<div class = "cen">
	<h1>Blog posts</h1>
	<p><?php echo $this->Html->link('Add Post', array('action' => 'add')); ?></p>
</div>
<table>
    <tr>
        <th>Id</th>
        <th>Userid</th>
        <th>Title</th>
        <th>Feeling</th>
        <th>Actions</th>
        <th>Created</th>
    </tr>
<!-- ここで$posts配列をループして、投稿情報を表示 -->
	<?php foreach ($posts as $post): ?>
	<tr>
		<td><?php echo $post['Post']['id']; ?></td>
		<td>
			<?php echo $this->Html->link($post['Post']['useid'], array('action' => 'view', $post['Post']['id']));?>
		</td>
		<td>
			<?php echo $this->Html->link($post['Post']['title'], array('action' => 'view', $post['Post']['id']));?>
		</td>
		<td><?php echo $post['Post']['feeling']; ?></td>
		<td>
			<?php echo $this->Form->postLink(
				'Delete',
				array('action' => 'delete', $post['Post']['id']),
				array('confirm' => 'Are you sure?'));
			?>
			<?php echo $this->Html->link('Edit', array('action' => 'edit', $post['Post']['id']));?>
		</td>
		<td>
			<?php echo $post['Post']['created']; ?>
		</td>
	</tr>
	<?php endforeach; ?>
</table>