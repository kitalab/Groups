<?php
/**
 * GroupsUser::getGroupUsers()のテスト
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Yuna Miyashita <butackle@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('NetCommonsGetTest', 'NetCommons.TestSuite');

/**
 * GroupsUser::getGroupUsers()のテスト
 *
 * @author Yuna Miyashita <butackle@gmail.com>
 * @package NetCommons\Groups\Test\Case\Model\GroupsUser
 */
class GroupsUserGetGroupUsersTest extends NetCommonsGetTest {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'plugin.groups.group',
		'plugin.groups.groups_user',
	);

/**
 * Plugin name
 *
 * @var string
 */
	public $plugin = 'groups';

/**
 * Model name
 *
 * @var string
 */
	protected $_modelName = 'GroupsUser';

/**
 * Method name
 *
 * @var string
 */
	protected $_methodName = 'getGroupUsers';

/**
 * getGroupUsers()のテスト
 *
 * @return void
 */
	public function testGetGroupUsers() {
		$model = $this->_modelName;
		$methodName = $this->_methodName;

		//データ生成
		$userIdArr = null;

		//テスト実施
		$result = $this->$model->$methodName($userIdArr);

		//チェック
		//SHOULD:Assertを書く
		debug($result);
	}

}
