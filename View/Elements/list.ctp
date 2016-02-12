<?php
/**
 * Groups index template
 *
 * @author Masaki Goto <go8ogle@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 */

$groupListJson = array();
if (!empty($groups)) {
	$groupListJson = $this->GroupUserList->convertGroupUserListForDisplay($groups);
}

echo $this->NetCommonsHtml->css(array(
	'/groups/css/style.css',
));
echo $this->NetCommonsHtml->script('/groups/js/groups.js');
?>

<div class="text-right">
	<?php echo $this->Button->addLink('',
		array(
			'plugin' => 'groups',
			'controller' => 'groups',
			'action' => 'add',
		)
	); ?>
</div>

<div class="table-responsive">
<<<<<<< HEAD
=======
	<?php if (count($groupListJson) > 0): ?>
>>>>>>> 5add7ac49e11c80f097e28a0be820b23d7b6d92b
	<table class="table table-condensed">
		<thead>
			<tr>
				<th></th>
<<<<<<< HEAD
				<th><?php echo __d('groups', 'Groups name'); ?></th>
=======
				<th><?php echo __d('groups', 'Group name'); ?></th>
>>>>>>> 5add7ac49e11c80f097e28a0be820b23d7b6d92b
			</tr>
		</thead>
		<tbody>
		<?php foreach($groupListJson as $index => $group): ?>
			<tr>
				<td>
					<?php echo ($index + 1); ?>
				</td>
				<td class="nc-groups-group-name">
					<span class="nc-groups-select-group-name">
						<?php echo $this->NetCommonsHtml->link(
							$group['name'],
							array(
								'plugin' => 'groups',
								'controller' => 'groups',
								'action' => 'edit',
								$group['id']
							),
							array()
						);?>
					</span>
					<span class="nc-groups-avatar-list">
						<?php foreach ($group['groupsUser'] as $groupsUser): ?>
<<<<<<< HEAD
							<img class="user-avatar-xs" src="<?php echo $groupsUser['avatar']; ?>" alt="<?php echo $groupsUser['handlename']; ?>" title="<?php echo $groupsUser['handlename']; ?>" />
=======
							<img class="user-avatar-xs"
								 src="<?php echo $groupsUser['avatar']; ?>"
								 alt="<?php echo $groupsUser['handlename']; ?>"
								 title="<?php echo $groupsUser['handlename']; ?>" />
>>>>>>> 5add7ac49e11c80f097e28a0be820b23d7b6d92b
						<?php endforeach; ?>
					</span>
				</td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
<<<<<<< HEAD
=======
	<?php else: ?>
		<?php echo __d('groups', 'Not found the group.'); ?>
	<?php endif;?>
>>>>>>> 5add7ac49e11c80f097e28a0be820b23d7b6d92b
</div>