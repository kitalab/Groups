<?php
/**
 * Group Model
 *
 * @property Group $Group
 *
<<<<<<< HEAD
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Masaki Goto <go8ogle@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2015, NetCommons Project
=======
 * @author Masaki Goto <go8ogle@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2016, NetCommons Project
>>>>>>> 5add7ac49e11c80f097e28a0be820b23d7b6d92b
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
<<<<<<< HEAD
 * 
=======
 *
>>>>>>> 5add7ac49e11c80f097e28a0be820b23d7b6d92b
 * @var string
 */
	public $useTable = 'groups';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array();

	public $hasMany = array(
		'GroupsUser' => array(
			'className' => 'Groups.GroupsUser',
			'foreignKey' => 'group_id',
			'dependent' => false
		)
	);

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
 * hasAndBelongsToMany associations
 *
 * @var array
 */
	public $hasAndBelongsToMany = array(
		'User' => array(
			'className' => 'Users.User',
			'joinTable' => 'groups_users',
			'foreignKey' => 'group_id',
			'associationForeignKey' => 'user_id',
			'unique' => 'keepExisting',
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
		)
	);

/**
<<<<<<< HEAD
=======
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
>>>>>>> 5add7ac49e11c80f097e28a0be820b23d7b6d92b
 * グループ一覧取得処理
 *
 * @return mixed On success Model::$data, false on failure
 * @throws InternalErrorException
 */
	public function getGroupList() {
<<<<<<< HEAD

		$groups = $this->find('all',array(
=======
		$groups = $this->find('all', array(
>>>>>>> 5add7ac49e11c80f097e28a0be820b23d7b6d92b
			'fields' => array('Group.id', 'Group.name', 'Group.modified'),
			'conditions' => array('Group.created_user' => Current::read('User.id')),
			'order' => array('Group.created ASC'),
			'recursive' => -1,
		));
		if (empty($groups)) {
			return array();
		}
		foreach ($groups as $index => $group) {
			$groupsUser = $this->GroupsUser->getGroupUsers($group['Group']['id']);
			$groups[$index]['GroupsUser'] = $groupsUser;
		}

		return $groups;
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
<<<<<<< HEAD
			foreach ($data['GroupsUser'] as $groupUser) {
				$groupUser['group_id'] = $groupId;
=======
			$groupUsers = Hash::get($data, 'GroupsUser.user_id');
			foreach ($groupUsers as $userId) {
				$groupUser = array(
					'group_id' => $groupId,
					'user_id' => $userId
				);
>>>>>>> 5add7ac49e11c80f097e28a0be820b23d7b6d92b
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
