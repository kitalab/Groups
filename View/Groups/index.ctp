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
	<?php echo $this->Button->addLink(); ?>
</div>

<div class="table-responsive" ng-controller="GroupsIndex">
	<table class="table table-condensed" ng-init="initialize(<?php echo h(json_encode($groupListJson)); ?>)">
		<thead>
			<tr>
				<th></th>
				<th><?php echo __d('groups', 'Groups name'); ?></th>
				<th><?php echo __d('groups', 'Groups modified'); ?></th>
			</tr>
		</thead>
		<tbody>
			<tr ng-repeat="group in groupList track by $index">
				<td>
					<?php echo ('{{$index}}' + 1); ?>
				</td>
				<td>
					<span class="nc-groups-select-group-name">
						<?php echo $this->Html->link(
							'{{group.name}}',
							array(
								'controller' => 'groups',
								'action' => 'edit' . '/' . '{{group.id}}'
							),
							array(),
							false
						); ?>
					</span>
					<span ng-repeat="groupsUser in group.groupsUser">
						<img class="user-avatar-xs" ng-src="{{groupsUser.avatar}}" alt="{{groupsUser.handlename}}" title="{{groupsUser.handlename}}" />
						<?php echo $this->DisplayUser->handleLink(array('ngModel' => 'user'), array('avatar' => true)); ?>
					</span>
				</td>
				<td>
					{{group.modified}}
				</td>
			</tr>
		</tbody>
	</table>
</div>