<?php
/**
 * Group select element
 *
 * @author Masaki Goto <go8ogle@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 */
?>

<div class="row">
	<div class="col-xs-12 nc-groups-selection-list" ng-repeat="group in <?php echo $groupType; ?> track by $index" ng-class="{'group-selection-list-offset': $odd}">
		<?php if ($groupType === 'groupList') : ?>
			<?php echo $this->Button->add('', array(
				'type' => 'button',
				'class' => 'btn btn-success btn-xs user-select-button',
				'ng-click' => 'select($index)',
				'ng-disabled' => 'selected(groupList[$index])',
				'ng-class' => '{active: selected(groupList[$index])}',
			)); ?>
		<?php endif; ?>

		<span class="nc-groups-select-group-name">
			{{group.Group.name}}
			<?php echo sprintf(__d('groups', 'Group users count'), '{{group.GroupsUser.length}}');?>
		</span>
		<span ng-repeat="groupsUser in group.GroupsUser | limitTo: <?php echo GroupsUser::LIST_DISPLAY_NUM; ?>">
			<img class="user-avatar-xs" ng-src="{{groupUsersList[groupsUser.user_id].avatar}}" alt="{{groupUsersList[groupsUser.user_id].handlename}}" title="{{groupUsersList[groupsUser.user_id].handlename}}" />
		</span>
		<span ng-if="group.GroupsUser.length > <?php echo groupsUser::LIST_DISPLAY_NUM; ?>">
			<?php echo __d('groups', 'Group users truncate str') ?>
		</span>

		<?php if ($groupType === 'selectors') : ?>
			<?php echo $this->Button->cancel('', false, array(
				'type' => 'button',
				'class' => 'btn btn-default btn-xs pull-right user-delete-button',
				'ng-click' => 'remove($index)'
			)); ?>
		<?php endif; ?>
	</div>

	<div class="clearfix visible-xs-block" ng-if="$odd"></div>
</div>
