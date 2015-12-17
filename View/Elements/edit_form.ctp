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

$usersJson = array();
if (isset($this->data['GroupsUsersDetail']) && is_array($this->data['GroupsUsersDetail'])) {
	foreach ($this->data['GroupsUsersDetail'] as $groupUser) {
		$usersJson[] = $this->UserSearch->convertUserArrayByUserSelection($groupUser, 'User');
	}
}
?>

<div id="groups-select-users" class="panel panel-default" ng-controller="GroupsSelectUser" ng-init="initialize(<?php echo h(json_encode(array('users' => $usersJson))); ?>)">
	<?php echo $this->NetCommonsForm->create('Group', array('type' => 'file')); ?>
	<div class="panel-body" ng-controller="GroupsSelectGroup">
		<!-- グループ名 -->
		<?php echo $this->NetCommonsForm->input('Group.name', array(
			'type' => 'text',
			'label' => __d('groups', 'Groups name'),
		)); ?>

		<div class="text-right">
			<!-- グループ選択 -->
<!--			<a href="" ng-click="showGroupSelectionDialog('--><?php //echo Current::read('User.id'); ?><!--', '--><?php //echo 1 ?><!--')">-->
			<a href="" ng-click="showGroupSelectionDialog('<?php echo Current::read('User.id'); ?>')">
				<span class="glyphicon glyphicon-search"></span>
			</a>
			<!-- 会員検索 -->
			<!--		<a href="" ng-click="showUserSelectionDialog('--><?php //echo Current::read('User.id'); ?><!--', '--><?php //echo Current::read('Room.id'); ?><!--')">-->
			<a href="" ng-click="showUserSelectionDialog('<?php echo Current::read('User.id'); ?>', '<?php echo 1 ?>')">
				<span class="glyphicon glyphicon-search"></span>
			</a>
		</div>
	
		<!-- 選択済みユーザ情報 -->
		<?php echo $this->element('Groups.select_user'); ?>
	</div>

	<!-- ボタン -->
	<div class="panel-footer text-center">
		<?php echo $this->Button->cancelAndSave(
				__d('net_commons', 'Cancel'),
				__d('net_commons', 'OK'),
				$this->NetCommonsHtml->url(array('action' => 'index'))
		); ?>
	</div>
	<?php echo $this->NetCommonsForm->end(); ?>
</div>
