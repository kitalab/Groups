<?php
/**
 * Element of block delete form
 *   - $model: Controller for delete request.
 *   - $action: Action for delete request.
 *   - $callback: Callback element for parameters and messages.
 *   - $callbackOptions: Callback options for element.
 *   - $options: Options array for Form->create()
 *
 * @author Masaki Goto <go8ogle@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 */

echo $this->NetCommonsHtml->css(array(
	'/groups/css/style.css',
));
echo $this->NetCommonsHtml->script(array(
	'/users/js/user_select.js',
	'/groups/js/groups.js',
));
<<<<<<< HEAD
?>

<div class="text-right clearfix" ng-controller="GroupsSelect" ng-init="initialize(<?php echo h(json_encode(array('users' => $usersJson))); ?>)" style="margin: 8px 0;">
=======
if (!isset($usersJson)) {
	$usersJson = array();
}
if (!isset($pluginModel)) {
	$pluginModel = 'GroupsUser';
}
$this->NetCommonsForm->unlockField($pluginModel . '.user_id');
?>

<div id="group-user-select" class="text-right clearfix"
		ng-controller="GroupsSelect" ng-init="initialize(<?php echo h(json_encode(array('users' => $usersJson))); ?>,
			'<?php echo h($pluginModel); ?>')" style="margin: 8px 0;">
>>>>>>> 5add7ac49e11c80f097e28a0be820b23d7b6d92b
	<!-- 会員検索 -->
	<div class="pull-right" ng-controller="GroupsSelectUser" >
		<!--				<a href="" ng-click="showUserSelectionDialog('--><?php //echo Current::read('User.id'); ?><!--', '--><?php //echo Current::read('Room.id'); ?><!--')">-->
		<a href="" ng-click="showUserSelectionDialog('<?php echo Current::read('User.id'); ?>', '<?php echo 1 ?>')">
			<span class="glyphicon glyphicon-search"></span>
<<<<<<< HEAD
			ユーザ検索
=======
			<?php echo __d('groups', 'User search'); ?>
>>>>>>> 5add7ac49e11c80f097e28a0be820b23d7b6d92b
		</a>
	</div>
	<div class="pull-right" style="margin: 0 8px;">|</div>
	<!-- グループ選択 -->
	<div class="pull-right" ng-controller="GroupsSelectGroup">
		<!--				<a href="" ng-click="showGroupSelectionDialog('--><?php //echo Current::read('User.id'); ?><!--', '--><?php //echo 1 ?><!--')">-->
		<a href="" ng-click="showGroupSelectionDialog('<?php echo Current::read('User.id'); ?>')">
			<span class="glyphicon glyphicon-search"></span>
<<<<<<< HEAD
			グループ検索
=======
			<?php echo __d('groups', 'Group search'); ?>
>>>>>>> 5add7ac49e11c80f097e28a0be820b23d7b6d92b
		</a>
	</div>
	<br class="clearfix" />
	<div id="groups-select-user-frame" class="panel-body nc-groups-select-user-frame">
	<!--	ここに選択したユーザ情報を表示-->
<<<<<<< HEAD
		<span ng-if="users.length == 0"><?php echo __d('groups', 'Groups select user'); ?></span>
=======
		<span ng-if="users.length == 0"><?php echo __d('groups', 'Select user'); ?></span>
>>>>>>> 5add7ac49e11c80f097e28a0be820b23d7b6d92b
		<groups-selected-users ng-repeat="user in users"></groups-selected-users>
	</div>
</div>
