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
if (isset($this->request->data['GroupsUsersDetail']) && is_array($this->request->data['GroupsUsersDetail'])) {
	foreach ($this->request->data['GroupsUsersDetail'] as $groupUser) {
		$usersJson[] = $this->UserSearch->convertUserArrayByUserSelection($groupUser, 'User');
	}
}
$roomId = Room::PUBLIC_PARENT_ID;	// FIXME ROOM_PARENT_IDに変更
?>
<?php if (! (int)$isModal): ?>
	<h1>
		<?php echo h(__d('groups', __d('groups', 'Group add'))); ?>
	</h1>
<?php endif; ?>

<div id="groups-select-users" class="panel panel-default" ng-controller="GroupsAddGroup">
	<?php echo $this->NetCommonsForm->create('Group', array('type' => 'file')); ?>
	<div class="panel-body" ng-controller="GroupsSelectGroup">
		<!-- グループ名 -->
		<div id="groups-input-name-<?php echo Current::read('User.id'); ?>">
			<?php echo $this->NetCommonsForm->input('Group.name', array(
				'type' => 'text',
				'label' => __d('groups', 'Group name'),
				'onkeypress' => 'if (event.keyCode == 13) {return false;}',
			)); ?>
		</div>
		<?php echo $this->NetCommonsForm->error('GroupsUser.user_id'); ?>

		<!-- ユーザ選択 -->
		<?php if ((int)$isModal): $className = 'hidden' ?>
		<?php else: $className = 'show' ?>
		<?php endif; ?>
		<div class="<?php echo $className; ?>" ng-controller="GroupsSelectGroup">
			<?php echo $this->element('Groups.select_users', array(
				'usersJson' => $usersJson,
				'roomId' => $roomId,
			)); ?>
		</div>
	</div>

	<?php echo $this->NetCommonsForm->hidden('Group.id', array(
		'value' => isset($this->request->data['Group']['id']) ? $this->request->data['Group']['id'] : null,
	)); ?>

	<!-- ボタン -->
	<div class="panel-footer text-center">
		<?php if ((int)$isModal): ?>
			<?php echo $this->Button->cancelAndSave(
				__d('net_commons', 'Cancel'), __d('net_commons', 'OK'), false,
				array('type' => 'button', 'ng-click' => 'cancel()'),
				array('type' => 'button', 'ng-click' => 'save()')
			); ?>

		<?php else: ?>
			<?php echo $this->Button->cancelAndSave(
				__d('net_commons', 'Cancel'),
				__d('net_commons', 'OK'),
				$this->NetCommonsHtml->url(
					array(
						'plugin' => 'users',
						'controller' => 'users',
						'action' => 'view' . '/' . Current::read('User.id') . '#/user-groups',
					)
				),
				array(),
				$this->NetCommonsHtml->url(
					array(
						'plugin' => 'users',
						'controller' => 'users',
						'action' => 'view' . '/' . Current::read('User.id') . '#/user-groups',
					)
				)
			); ?>
		<?php endif; ?>

	</div>
	<?php echo $this->NetCommonsForm->end(); ?>
</div>
