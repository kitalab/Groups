<?php
/**
 * Groups Controller
 *
 * @property Group $Group
 *
 * @author Masaki Goto <go8ogle@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2016, NetCommons Project
 */

App::uses('GroupsAppController', 'Groups.Controller');

/**
 * Groups Controller
 *
 * @author Masaki Goto <go8ogle@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 */
class GroupsController extends GroupsAppController {

/**
 * use model
 *
 * @var array
 */
	public $uses = array(
		'Groups.Group',
		'Groups.GroupsUser',
		'Users.User',
	);

/**
 * use component
 *
 * @var array
 */
	public $components = array(
		'M17n.SwitchLanguage',
		'UserAttributes.UserAttributeLayout',
		'NetCommons.Permission' => array(
			//アクセスの権限
			'allow' => array(
				'add,edit,delete' => 'content_creatable',
			),
		),
	);

/**
 * use helper
 *
 * @var array
 */
	public $helpers = array(
		'NetCommons.Token',
		'Users.UserSearch',
		'Groups.GroupUserList',
	);

/**
 * select method
 *
 * @return void
 * @throws NotFoundException
 */
	public function select() {
		$this->viewClass = 'View';

		if ($this->request->isPost()) {
			$groupIdArr = array_map(function ($groupId) {
				return $groupId;
			}, $this->request->data['GroupSelect']['group_id']);
			$groupUsers = array();
			if (!empty($groupIdArr)) {
				list($groups, $groupUsers) = $this->Group->getGroups($groupIdArr);
			}
			$this->set('users', $groupUsers);
			$this->view = 'Groups.Groups/json/select';
		} else {
			// グループ一覧取得
			list($groups, $groupUsers) = $this->Group->getGroupList();
			$this->set('groups', $groups);
			$this->set('groupUsers', $groupUsers);
			$this->layout = 'NetCommons.modal';
		}
	}

/**
 * add method
 *
 * @param bool $isModal モーダル表示の有無
 * @return void
 */
	public function add($isModal = null) {
		$this->view = 'edit';
		if ((int)$isModal) {
			$this->viewClass = 'View';
			$this->layout = 'NetCommons.modal';
		} else {
			$this->PageLayout = $this->Components->load('Pages.PageLayout');
		}

		if ($this->request->isPost()) {
			// 登録処理
			$group = $this->Group->saveGroup($this->request->data);
			if ($group) {
				// 正常の場合
				if ($isModal) {
					return;
				} else {
					$this->NetCommons->setFlashNotification(__d('net_commons', 'Successfully saved.'), array('class' => 'success'));
					$this->redirect('/users/users/view/' . Current::read('User.id') . '#/user-groups');
					return;
				}
			} else {
				if (isset($this->request->data['GroupsUser'])) {
					$userIdArr = Hash::extract($this->request->data['GroupsUser'], '{n}.user_id');
					$this->request->data['GroupsUsersDetail'] =
						$this->GroupsUser->getGroupUsers($userIdArr);
				}
			}
			$this->NetCommons->handleValidationError($this->Group->validationErrors);
		}
		$this->set('isModal', $isModal);
	}

/**
 * edit method
 *
 * @param string $id groups.id
 * @return void
 * @throws NotFoundException
 */
	public function edit($id = null) {
		if (!$this->Group->exists($id)) {
			throw new NotFoundException(__('Invalid group'));
		}
		$this->PageLayout = $this->Components->load('Pages.PageLayout');

		if ($this->request->is(array('post', 'put'))) {

			// 更新処理
			$data = $this->request->data;
			$data['Group']['id'] = $id;
			$group = $this->Group->saveGroup($data);
			if ($group) {
				// 正常の場合
				$this->NetCommons->setFlashNotification(__d('net_commons', 'Successfully saved.'), array('class' => 'success'));
				$this->redirect('/users/users/view/' . Current::read('User.id') . '#/user-groups');
				return;
			} else {
				if (isset($this->request->data['GroupsUser'])) {
					$userIdArr = Hash::extract($this->request->data['GroupsUser'], '{n}.user_id');
					$this->request->data['GroupsUsersDetail'] =
						$this->GroupsUser->getGroupUsers($userIdArr);
				}
			}
		} else {
			// グループユーザ詳細情報を取得
			$this->request->data = $this->Group->getGroupById($id);
		}
		$isModal = 0;
		$this->set('isModal', $isModal);
	}

/**
 * delete method
 *
 * @param string $id groups.id
 * @return void
 * @throws NotFoundException
 */
	public function delete($id = null) {
		$this->Group->id = $id;
		if (!$this->Group->exists()) {
			throw new NotFoundException(__('Invalid group'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Group->delete()) {
			// 正常の場合
			$this->NetCommons->setFlashNotification(__d('net_commons', 'Successfully saved.'), array('class' => 'success'));
		}
		return $this->redirect('/users/users/view/' . Current::read('User.id') . '#/user-groups');
	}
}
