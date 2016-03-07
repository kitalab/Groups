<?php
/**
 * Group Model
 *
 * @property Group $Group
 *
 * @author Masaki Goto <go8ogle@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2016, NetCommons Project
 */

App::uses('GroupsAppModel', 'Groups.Model');

/**
 * Group Model
 *
 * @author Masaki Goto <go8ogle@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 */
class Group extends GroupsAppModel {

/**
 * use tables
 *
 * @var string
 */
	public $useTable = 'groups';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array();

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'GroupsUser' => array(
			'className' => 'Groups.GroupsUser',
			'foreignKey' => 'group_id',
			'dependent' => false
		)
	);

/**
 * use behaviors
 *
 * @var array
 */
	public $actsAs = array(
		'Groups.GroupsUser'
	);

/**
 * Called during validation operations, before validation. Please note that custom
 * validation rules can be defined in $validate.
 *
 * @param array $options Options passed from Model::save().
 * @return bool True if validate operation should continue, false to abort
 * @link http://book.cakephp.org/2.0/en/models/callback-methods.html#beforevalidate
 * @see Model::save()
 */
	public function beforeValidate($options = array()) {
		$this->validate = array(
			'name' => array(
				'notBlank' => array(
					'rule' => array('notBlank'),
					'required' => true,
					'allowEmpty' => false,
					'message' => __d('groups', 'Please enter group name'),
				)
			)
		);

		return parent::beforeValidate($options);
	}

/**
 * グループ及びグループユーザ一覧取得処理
 *
 * @return mixed On success Model::$data, false on failure
 * @throws InternalErrorException
 */
	public function getGroupList() {
		$groups = $this->find('all', array(
			'fields' => array('Group.id', 'Group.name', 'Group.modified'),
			'conditions' => array('Group.created_user' => Current::read('User.id')),
			'order' => array('Group.created ASC'),
			'recursive' => 1,
		));
		$userIdArr = Hash::extract($groups, '{n}.GroupsUser.{n}.user_id');
		$userIdArr = array_unique($userIdArr);	// 重複した値をまとめる
		$groupUsers = $this->GroupsUser->getGroupUsers($userIdArr);

		return array($groups, $groupUsers);
	}

/**
 * グループ取得処理
 *
 * @param int $groupId グループID
 * @return mixed On success Model::$group, false on failure
 * @throws InternalErrorException
 */
	public function getGroupById($groupId) {
		$options = array('conditions' => array('Group.' . $this->primaryKey => $groupId));
		$group = $this->find('first', $options);
		$userIdArr = Hash::extract($group, 'GroupsUser.{n}.user_id');
		$groupUsers = $this->GroupsUser->getGroupUsers($userIdArr);
		$group['GroupsUsersDetail'] = $groupUsers;

		return $group;
	}

/**
 * グループ取得処理
 *
 * @param int|array $groupId グループID
 * @return mixed On success Model::$groups, $groupUsers
 * @throws InternalErrorException
 */
	public function getGroups($groupId) {
		$groups = $this->find('all', array(
			'fields' => array('Group.id', 'Group.name', 'Group.modified'),
			'conditions' => array(
				'Group.' . $this->primaryKey => $groupId,
				'Group.created_user' => Current::read('User.id'),
			),
			'order' => array('Group.created ASC'),
			'recursive' => 1,
		));
		$userIdArr = Hash::extract($groups, '{n}.GroupsUser.{n}.user_id');
		$groupUsers = $this->GroupsUser->getGroupUsers($userIdArr);

		return array($groups, $groupUsers);
	}

/**
 * グループの登録処理
 *
 * @param array $data data
 * @return mixed On success Model::$data, false on failure
 * @throws InternalErrorException
 */
	public function saveGroup($data) {
		//トランザクションBegin
		$this->begin();

		$this->loadModels([
			'Group' => 'Groups.Group',
			'GroupsUser' => 'Groups.GroupsUser',
		]);

		//バリデーション
		$this->set($data);
		if (! $this->validates()) {
			$this->rollback();
			return false;
		}

		try {
			// Groupデータの登録
			$fields = array('name');
			if (! $group = $this->save($data, false, $fields)) {
				throw new InternalErrorException(__d('net_commons', 'Internal Server Error'));
			}
			$groupId = $group['Group']['id'];

			// 更新処理の場合は一旦GroupsUser情報を削除
			if (isset($data['Group']['id']) && !empty($data['Group']['id'])) {
				$conditions = array(
					'GroupsUser.group_id' => $data['Group']['id']
				);
				if (!$this->GroupsUser->deleteAll($conditions, false)) {
					throw new InternalErrorException(__d('net_commons', 'Internal Server Error'));
				}
			}

			// GroupsUserデータの登録
			foreach ($data['GroupsUser'] as $groupUser) {
				$groupUser['group_id'] = $groupId;
				$this->GroupsUser->create(false);
				if (!$this->GroupsUser->saveGroupUser($groupUser)) {
					throw new InternalErrorException(__d('net_commons', 'Internal Server Error'));
				}
			}

			//トランザクションCommit
			$this->commit();

		} catch (Exception $ex) {
			//トランザクションRollback
			$this->rollback($ex);
		}

		return true;
	}
}
