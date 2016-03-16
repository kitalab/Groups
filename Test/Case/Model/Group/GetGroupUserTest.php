<?php
/**
 * Group::getGroupUser()のテスト
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Yuna Miyashita <butackle@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('NetCommonsGetTest', 'NetCommons.TestSuite');

/**
 * Group::getGroupUser()のテスト
 *
 * @author Yuna Miyashita <butackle@gmail.com>
 * @package NetCommons\Groups\Test\Case\Model\Group
 */
class GroupGetGroupUserTest extends NetCommonsGetTest {

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
	protected $_modelName = 'Group';

/**
 * Method name
 *
 * @var string
 */
	protected $_methodName = 'getGroupUser';

/**
 * getGroupUser()のテスト
 *
 * @return void
 */
	public function testGetGroupUser() {
		$model = $this->_modelName;
		$methodName = $this->_methodName;

		//データ生成
		$groupId = null;

		//テスト実施
		$result = $this->$model->$methodName($groupId);

		//チェック
		//SHOULD:Assertを書く
		debug($result);
	}

}
