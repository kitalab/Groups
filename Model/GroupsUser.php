<?php
/**
 * GroupsUser Model
 *
 * @property Group $Group
 * @property User $User
 *
 * @author Masaki Goto <go8ogle@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2016, NetCommons Project
 */

App::uses('GroupsAppModel', 'Groups.Model');

/**
 * GroupsUser Model
 *
 * @author Masaki Goto <go8ogle@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 */
class GroupsUser extends GroupsAppModel {

/**
 * use tables
 *
 * @var string
 */
	public $useTable = 'groups_users';

/**
 * 1グループに登録可能な人数の定数
 *
 * @var const
 */
	const LIMIT_ENTRY_NUM = 100;

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array();

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Group' => array(
			'className' => 'Groups.Group',
			'foreignKey' => 'group_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
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
		// ユーザ選択チェック
		if (! isset($this->data['GroupsUser']) || count($this->data['GroupsUser']) === 0) {
			$this->validationErrors['user_id'][] = __d('groups', 'Select user');
			return false;
		}
		if (count($this->data['GroupsUser']) > GroupsUser::LIMIT_ENTRY_NUM) {
			$this->validationErrors['user_id'][] =
				sprintf(__d('groups', 'Can be registered upper limit is %s'), GroupsUser::LIMIT_ENTRY_NUM);
			return false;
		}

		return parent::beforeValidate($options);
	}

/**
 * Register the string attached user information to the group
 *
 * @param mixed $data Groups users data
 * @throws InternalErrorException
 * @return bool Success
 */
	public function saveGroupUser($data) {
		$this->begin();

		$this->set($data);
		if (!$this->validates()) {
			$this->rollback();
			return false;
		}

		try {
			if (!$this->save(null, false)) {
				throw new InternalErrorException(__d('net_commons', 'Internal Server Error'));
			}
		} catch (Exception $ex) {
			$this->rollback($ex);
		}

		$this->commit();

		return true;
	}

/**
 * It gets a string attached user information to the group
 *
 * @param array $userIdArr GroupsUser.user_id
 * @return array Group users array
 */
	public function getGroupUsers($userIdArr) {
		if (empty($userIdArr)) {
			return array();
		}

		$this->loadModels([
			'User' => 'Users.User',
			'UploadFile' => 'Files.UploadFile',
		]);
		$this->User->prepare();

		$groupUsers = $this->User->find('all', array(
			'recursive' => -1,
			'fields' => array('User.*', 'UploadFile.*'),
			'conditions' => array(
				$this->User->alias . '.id' => $userIdArr,
				$this->User->alias . '.is_deleted' => false,
			),
			'joins' => array(
				array(
					'table' => $this->UploadFile->table,
					'alias' => $this->UploadFile->alias,
					'type' => 'LEFT',
					'conditions' => array(
						$this->User->alias . '.id' . ' = ' . $this->UploadFile->alias . '.content_key',
						$this->UploadFile->alias . '.field_name' => UserAttribute::AVATAR_FIELD,
					),
				),
			),
		));

		return $groupUsers;
	}
}
