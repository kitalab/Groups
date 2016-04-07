<?php
/**
 * Groups index template
 *
 * @author Masaki Goto <go8ogle@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 */

$groupUsersList = array();
if (!empty($users)) {
	$groupUsersList = $this->GroupUserList->convertGroupUserListForDisplay($users);
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
	<?php if (count($groups) > 0): ?>
	<table class="table table-condensed">
		<thead>
			<tr>
				<th><?php echo __d('groups', 'Group name'); ?></th>
			</tr>
		</thead>
		<tbody>
		<?php foreach($groups as $index => $group): ?>
			<tr>
				<td class="nc-groups-group-name">
					<span class="nc-groups-select-group-name">
						<?php echo $this->NetCommonsHtml->link(
							$group['Group']['name'],
							array(
								'plugin' => 'groups',
								'controller' => 'groups',
								'action' => 'edit',
								$group['Group']['id']
							),
							array()
						);?>
						<?php echo sprintf(__d('groups', 'Group users count'), count($group['GroupsUser']));?>
					</span>
					<span class="nc-groups-avatar-list">
						<?php $count = 0; ?>
						<?php foreach ($group['GroupsUser'] as $groupsUser): ?>
							<?php
								$count++;
								if (! isset($groupUsersList[$groupsUser['user_id']])):
									continue;
								endif;
								$displayUser = $groupUsersList[$groupsUser['user_id']];
							?>
							<img class="user-avatar-xs"
								 src="<?php echo $displayUser['avatar']; ?>"
								 alt="<?php echo $displayUser['handlename']; ?>"
								 title="<?php echo $displayUser['handlename']; ?>" />
							<?php
								if ($count >= GroupsUser::LIST_DISPLAY_NUM):
									echo __d('groups', 'Group users truncate str');
									break;
								endif;
							?>
						<?php endforeach; ?>
					</span>
				</td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
	<?php else: ?>
		<?php echo __d('groups', 'Not found the group.'); ?>
	<?php endif;?>
</div>