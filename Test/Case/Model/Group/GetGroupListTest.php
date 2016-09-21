<?php
/**
 * Group::getGroupList()のテスト
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Masaki Goto <go8ogle@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('NetCommonsGetTest', 'NetCommons.TestSuite');

/**
 * Group::getGroupList()のテスト
 *
 * @author Masaki Goto <go8ogle@gmail.com>
 * @package NetCommons\Groups\Test\Case\Model\Group
 */
class GroupGetGroupListTest extends NetCommonsGetTest {

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
	protected $_methodName = 'getGroupList';

/**
 * getGroupListのDataProvider
 *
 * @return array
 */
	public function dataProviderGetGroupList() {
		return array(
			array(
				'query' => array(
					'conditions' => array(
						'Group.id' => '1'
					)
				),
				'expected' => 'array',
			),
			array(
				'query' => array(
					'conditions' => array(
						'Group.id' => ''
					)
				),
				'expected' => 'array',
			),
			array(
				'query' => array(
					'conditions' => array(
						'Group.id' => 'abc'
					)
				),
				'expected' => 'array',
			),
		);
	}

/**
 * getGroupList()のテスト
 * @param $query グループ情報取得条件
 * @param array $expected 期待値
 * @dataProvider dataProviderGetGroupList
 * @return void
 */
	public function testGetGroupList($query, $expected) {
		$model = $this->_modelName;
		$methodName = $this->_methodName;

		//テスト実施
		$result = $this->$model->$methodName($query);

		//チェック
		$this->assertInternalType($expected, $result);
	}

}
