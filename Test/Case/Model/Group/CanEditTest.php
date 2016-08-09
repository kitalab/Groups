<?php
/**
 * Group::canEdit()のテスト
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Masaki Goto <go8ogle@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('NetCommonsModelTestCase', 'NetCommons.TestSuite');

/**
 * Group::canEdit()のテスト
 *
 * @author Masaki Goto <go8ogle@gmail.com>
 * @package NetCommons\Groups\Test\Case\Model\Group
 */
class GroupCanEditTest extends NetCommonsModelTestCase {

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
	protected $_methodName = 'canEdit';

/**
 * @var array Current::$current待避
 */
	protected $_current = array();

/**
 * setUp
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->_current = Current::$current;
		Current::$current['User']['id'] = 1;
	}

/**
 * teadDown
 *
 * @return void
 */
	public function tearDown() {
		parent::tearDown();
		Current::$current = $this->_current;
	}

/**
 * DataProvider
 *
 * ### 戻り値
 *  - groupId グループID
 *  - expected 期待値
 *
 * @return array テストデータ
 */
	public function dataProvider() {
		return array(
			// * group_idなし
			array('groupId' => null, 'expected' => false),
			// * group_idが存在する値
			array('groupId' => 1, 'expected' => true),
			// * group_idが存在しない値
			array('groupId' => 99, 'expected' => false),
			// * group_idが不正
			array('groupId' => 'abc', 'expected' => false),
		);
	}

/**
 * existsUser()のテスト
 *
 * @param int|array $groupId グループID
 * @param bool $expected 期待値
 * @dataProvider dataProvider
 * @return void
 */
	public function testCanEdit($groupId, $expected) {
		//テスト実施
		$model = $this->_modelName;
		$methodName = $this->_methodName;
		$result = $this->$model->$methodName($groupId);

		//チェック
		$this->assertEquals($expected, $result);
	}

}
