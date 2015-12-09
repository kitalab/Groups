<?php
/**
 * Element of block delete form
 *   - $model: Controller for delete request.
 *   - $action: Action for delete request.
 *   - $callback: Callback element for parameters and messages.
 *   - $callbackOptions: Callback options for element.
 *   - $options: Options array for Form->create()
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Masaki Goto <go8ogle@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2015, NetCommons Project
 */
?>

<div id="groups-select-user-frame" class="panel-body nc-groups-select-user-frame">
<!--	ここに選択したユーザ情報を表示-->
	<span ng-if="users.length == 0"><?php echo __d('groups', 'Groups select user'); ?></span>
	<groups-selected-users ng-repeat="user in users"></groups-selected-users>
</div>