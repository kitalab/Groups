<div class="groups view">
<h2><?php echo __('Group'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($group['Group']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Parent Id'); ?></dt>
		<dd>
			<?php echo h($group['Group']['parent_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Lft'); ?></dt>
		<dd>
			<?php echo h($group['Group']['lft']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Rght'); ?></dt>
		<dd>
			<?php echo h($group['Group']['rght']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Has Room'); ?></dt>
		<dd>
			<?php echo h($group['Group']['has_room']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Need Approval'); ?></dt>
		<dd>
			<?php echo h($group['Group']['need_approval']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Can Read By Self'); ?></dt>
		<dd>
			<?php echo h($group['Group']['can_read_by_self']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created User'); ?></dt>
		<dd>
			<?php echo h($group['Group']['created_user']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($group['Group']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified User'); ?></dt>
		<dd>
			<?php echo h($group['Group']['modified_user']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($group['Group']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Group'), array('action' => 'edit', $group['Group']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Group'), array('action' => 'delete', $group['Group']['id']), null, __('Are you sure you want to delete # %s?', $group['Group']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Groups'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Group'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Rooms'), array('controller' => 'rooms', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Room'), array('controller' => 'rooms', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Languages'), array('controller' => 'languages', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Language'), array('controller' => 'languages', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
	<div class="related">
		<h3><?php echo __('Related Rooms'); ?></h3>
	<?php if (!empty($group['Room'])): ?>
		<dl>
			<dt><?php echo __('Id'); ?></dt>
		<dd>
	<?php echo $group['Room']['id']; ?>
	&nbsp;</dd>
		<dt><?php echo __('Group Id'); ?></dt>
		<dd>
	<?php echo $group['Room']['group_id']; ?>
	&nbsp;</dd>
		<dt><?php echo __('Space Id'); ?></dt>
		<dd>
	<?php echo $group['Room']['space_id']; ?>
	&nbsp;</dd>
		<dt><?php echo __('Top Page Id'); ?></dt>
		<dd>
	<?php echo $group['Room']['top_page_id']; ?>
	&nbsp;</dd>
		<dt><?php echo __('Created User'); ?></dt>
		<dd>
	<?php echo $group['Room']['created_user']; ?>
	&nbsp;</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
	<?php echo $group['Room']['created']; ?>
	&nbsp;</dd>
		<dt><?php echo __('Modified User'); ?></dt>
		<dd>
	<?php echo $group['Room']['modified_user']; ?>
	&nbsp;</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
	<?php echo $group['Room']['modified']; ?>
	&nbsp;</dd>
		</dl>
	<?php endif; ?>
		<div class="actions">
			<ul>
				<li><?php echo $this->Html->link(__('Edit Room'), array('controller' => 'rooms', 'action' => 'edit', $group['Room']['id'])); ?></li>
			</ul>
		</div>
	</div>
	<div class="related">
	<h3><?php echo __('Related Languages'); ?></h3>
	<?php if (!empty($group['Language'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Code'); ?></th>
		<th><?php echo __('Weight'); ?></th>
		<th><?php echo __('Is Active'); ?></th>
		<th><?php echo __('Created User'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified User'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($group['Language'] as $language): ?>
		<tr>
			<td><?php echo $language['id']; ?></td>
			<td><?php echo $language['code']; ?></td>
			<td><?php echo $language['weight']; ?></td>
			<td><?php echo $language['is_active']; ?></td>
			<td><?php echo $language['created_user']; ?></td>
			<td><?php echo $language['created']; ?></td>
			<td><?php echo $language['modified_user']; ?></td>
			<td><?php echo $language['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'languages', 'action' => 'view', $language['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'languages', 'action' => 'edit', $language['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'languages', 'action' => 'delete', $language['id']), null, __('Are you sure you want to delete # %s?', $language['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
	<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Language'), array('controller' => 'languages', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Users'); ?></h3>
	<?php if (!empty($group['User'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Username'); ?></th>
		<th><?php echo __('Password'); ?></th>
		<th><?php echo __('Role Key'); ?></th>
		<th><?php echo __('Created User'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified User'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($group['User'] as $user): ?>
		<tr>
			<td><?php echo $user['id']; ?></td>
			<td><?php echo $user['username']; ?></td>
			<td><?php echo $user['password']; ?></td>
			<td><?php echo $user['role_key']; ?></td>
			<td><?php echo $user['created_user']; ?></td>
			<td><?php echo $user['created']; ?></td>
			<td><?php echo $user['modified_user']; ?></td>
			<td><?php echo $user['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'users', 'action' => 'view', $user['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'users', 'action' => 'edit', $user['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'users', 'action' => 'delete', $user['id']), null, __('Are you sure you want to delete # %s?', $user['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
	<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
