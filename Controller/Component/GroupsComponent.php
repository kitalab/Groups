<?php
/**
 * Groups Component
 *
 * @author Masaki Goto <go8ogle@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 */

App::uses('Component', 'Controller');

/**
 * Group List Component
 *
 * @author Masaki Goto <go8ogle@gmail.com>
 * @package NetCommons\Groups\Controller\Component
 */
class GroupsComponent extends Component {

/**
 * グループ一覧・グループユーザを設定
 *
 * @param Controller $controller コントローラー
 * @return void
 */
	public function setGroupList(Controller $controller) {
		$this->controller = $controller;

		$groups = $this->controller->Group->getGroupList();
		$this->controller->set('groups', $groups);

		$userIdArr = Hash::extract($groups, '{n}.GroupsUser.{n}.user_id');
		$userIdArr = array_unique($userIdArr); // 重複した値をまとめる
		$groupUsers = $this->controller->GroupsUser->getGroupUsers($userIdArr);
		$this->controller->set('users', $groupUsers);
	}
}
