<?php
/**
 * Group Model
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
 * Group Model
 *
 * @author Kazutaka Yamada <yamada.kazutaka@withone.co.jp>
 * @package NetCommons\Groups\Model
 */
class Group extends GroupsAppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array();

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
}
