<?php
/**
 * GroupsUser Model
 *
 * @property Group $Group
 * @property User $User
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Kazutaka Yamada <yamada.kazutaka@withone.co.jp>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('GroupsAppModel', 'Groups.Model');

/**
 * GroupsUser Model
 *
 * @author Kazutaka Yamada <yamada.kazutaka@withone.co.jp>
 * @package NetCommons\Groups\Model
 */
class GroupsUser extends GroupsAppModel {

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
		'User' => array(
			'className' => 'Users.User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

/**
 * お気に入りの全グループに対するユーザリストを取得する
 *
 * @return array ユーザデータ配列（User.*, UplodaFile.*, favorite_count）
 */
	public function getUsersForOwnGroups() {
		$this->loadModels([
			'UploadFile' => 'Files.UploadFile',
		]);

		//戻り値のkeyPath
		$result = $this->find('all', array(
			'recursive' => -1,
			'fields' => array('user_id', 'COUNT(*) AS favorite_count'),
			'conditions' => array(
				'created_user' => Current::read('User.id'),
			),
			'group' => array('user_id'),
		));
		//sort順：count desc, id descとなる⇒カウントが同じ場合、新しい人を上にする。
		$keyPath = '{n}.GroupsUser.user_id';
		$order = Hash::combine(Hash::sort($result, '{n}.{n}.favorite_count', 'desc', 'numeric'), $keyPath, '{n}');

		$users = $this->find('all', array(
			'recursive' => 0,
			'fields' => array('User.*', 'UploadFile.*'),
			'conditions' => array(
				'Group.created_user' => Current::read('User.id'),
				'User.is_deleted' => false,
			),
			'joins' => array(
				array(
					'table' => $this->UploadFile->table,
					'alias' => $this->UploadFile->alias,
					'type' => 'LEFT',
					'conditions' => array(
						$this->UploadFile->alias . '.content_key' . ' = User.id',
						$this->UploadFile->alias . '.field_name' => User::$avatarField,
					),
				),
			),
		));
		return Hash::merge($order, Hash::combine($users, '{n}.User.id', '{n}'));
	}

}
