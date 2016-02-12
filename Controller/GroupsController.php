<?php
/**
 * Groups Controller
 *
 * @property Group $Group
 *
 * @author Masaki Goto <go8ogle@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
<<<<<<< HEAD
 * @copyright Copyright 2015, NetCommons Project
=======
 * @copyright Copyright 2016, NetCommons Project
>>>>>>> 5add7ac49e11c80f097e28a0be820b23d7b6d92b
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
<<<<<<< HEAD

/**
 * use component
 *
 * @var array
 */
	public $components = array(
//		'ControlPanel.ControlPanelLayout',
//		'Files.FileUpload',
		'M17n.SwitchLanguage',
		'UserAttributes.UserAttributeLayout',
//		'Users.UserSearch',
	);

	public $helpers = array(
//		'NetCommons.Token',
		'Users.UserSearch',
		'Groups.GroupUserList',
	);
=======
>>>>>>> 5add7ac49e11c80f097e28a0be820b23d7b6d92b

/**
 * use component
 *
 * @var array
 */
<<<<<<< HEAD
	public function index() {
		// グループ一覧取得
		$groups = $this->Group->getGroupList();
		$this->set('groups', $groups);
	}
=======
	public $components = array(
		'M17n.SwitchLanguage',
		'UserAttributes.UserAttributeLayout',
	);
>>>>>>> 5add7ac49e11c80f097e28a0be820b23d7b6d92b

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
			$data = array_map(function ($groupId) {
				return $groupId;
			}, $this->request->data['GroupSelect']['group_id']);
			if (!empty($data)) {
				$groupUsers = array();
				foreach ($data as $groupId) {
					$groupUserData = $this->GroupsUser->getGroupUsers($groupId);
					$groupUsers = array_merge_recursive($groupUsers, $groupUserData);
				}
			}
			$this->set('users', $groupUsers);
			$this->view = 'Groups.Groups/json/select';
		} else {
			// グループ一覧取得
			$groups = $this->Group->getGroupList();
			$this->set('groupList', $groups);
			$this->layout = 'NetCommons.modal';
		}
	}

/**
 * view method
 *
 * @return void
 * @throws NotFoundException
 */
	public function select() {
		$this->viewClass = 'View';

		if ($this->request->isPost()) {
			$data = array_map(function ($groupId) {
				return $groupId;
			}, $this->request->data['GroupSelect']['group_id']);
			if (!empty($data)) {
				$groupUsers = array();
				foreach ($data as $groupId) {
					$groupUserData = $this->GroupsUser->getGroupUsers($groupId);
					$groupUsers = array_merge_recursive($groupUsers, $groupUserData);
				}
			}
			$this->set('users', $groupUsers);
			$this->view = 'Groups.Groups/json/select';
		} else {
			// グループ一覧取得
			$groups = $this->Group->getGroupList();
			$this->set('groupList', $groups);
			$this->layout = 'NetCommons.modal';
		}
	}

	/**
 * add method
 *
 * @param bool $isModal モーダル表示の有無
 * @return void
 */
<<<<<<< HEAD
	public function add() {

		$this->PageLayout = $this->Components->load('Pages.PageLayout');
		$this->view = 'edit';
=======
	public function add($isModal = null) {
		$this->view = 'edit';
		if ((int)$isModal) {
			$this->viewClass = 'View';
			$this->layout = 'NetCommons.modal';
		} else {
			$this->PageLayout = $this->Components->load('Pages.PageLayout');
		}
>>>>>>> 5add7ac49e11c80f097e28a0be820b23d7b6d92b

		if ($this->request->isPost()) {
			// 登録処理
			$group = $this->Group->saveGroup($this->request->data);
			if ($group) {
				// 正常の場合
<<<<<<< HEAD
				$this->NetCommons->setFlashNotification(__d('net_commons', 'Successfully saved.'), array('class' => 'success'));
				$this->redirect('/users/users/view/' . Current::read('User.id') . '#/user-groups');
				return;
=======
				if ($isModal) {
					return;
				} else {
					$this->NetCommons->setFlashNotification(__d('net_commons', 'Successfully saved.'), array('class' => 'success'));
					$this->redirect('/users/users/view/' . Current::read('User.id') . '#/user-groups');
					return;
				}
			} else {
				if (isset($this->request->data['GroupsUser']['user_id'])) {
					foreach ($this->request->data['GroupsUser']['user_id'] as $userId) {
						// ユーザ選択情報を取得
						if (! $this->GroupsUser->isExists($userId)) {
							continue;
						}
						$user = $this->User->getUser($userId);
						$this->request->data['GroupsUsersDetail'][] = $user;
					}
				}
>>>>>>> 5add7ac49e11c80f097e28a0be820b23d7b6d92b
			}
			$this->NetCommons->handleValidationError($this->Group->validationErrors);
		}
<<<<<<< HEAD
=======
		$this->set('isModal', $isModal);
>>>>>>> 5add7ac49e11c80f097e28a0be820b23d7b6d92b
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
<<<<<<< HEAD
=======
			} else {
				if (isset($this->request->data['GroupsUser']['user_id'])) {
					foreach ($this->request->data['GroupsUser']['user_id'] as $userId) {
						// ユーザ選択情報を取得
						if (! $this->GroupsUser->isExists($userId)) {
							continue;
						}
						$user = $this->User->getUser($userId);
						$this->request->data['GroupsUsersDetail'][] = $user;
					}
				}
>>>>>>> 5add7ac49e11c80f097e28a0be820b23d7b6d92b
			}
		} else {
			$options = array('conditions' => array('Group.' . $this->Group->primaryKey => $id));
			$this->request->data = $this->Group->find('first', $options);
			// グループユーザ詳細情報を取得
			$groupUsers = $this->GroupsUser->getGroupUsers($id);
			$this->request->data['GroupsUsersDetail'] = $groupUsers;
		}
<<<<<<< HEAD
=======
		$isModal = 0;
		$this->set('isModal', $isModal);
>>>>>>> 5add7ac49e11c80f097e28a0be820b23d7b6d92b
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
