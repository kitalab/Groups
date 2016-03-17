<?php
/**
 * GroupsUserBehavior::validates()のテスト
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Yuna Miyashita <butackle@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('GroupsControllerTestCase', 'Groups.Test/Case');
App::uses('GroupsUserBehavior', 'Groups.Model/Behavior');

/**
 * GroupsUserBehavior::validates()のテスト
 *
 * @author Yuna Miyashita <butackle@gmail.com>
 * @package NetCommons\Groups\Test\Case\Model\Behavior\GroupsUserBehavior
 */
class GroupsUserBehaviorValidatesTest extends GroupsControllerTestCase {

/**
 * validates()のテスト
 *
 * @dataProvider dataProviderValidates
 * @param array $inputData 入力データ
 * @param bool $expectedResult バリデーション結果
 * @return void
 */
	public function testValidates($inputData = [], $expectedResult = 1) {
		$behaviorGroupsUser = new GroupsUserBehavior();
		$this->controller->Group->set($inputData);
		$actualResult = $behaviorGroupsUser->beforeValidate($this->controller->Group, []);
		$this->assertTrue($expectedResult === $actualResult);
	}

/**
 * testValidates用dataProvider
 * 
 * ### 戻り値
 *  - inputData:	入力データ
 *  - expectedResult:	バリデーション結果
 */
	public function dataProviderValidates() {
		return array(
			array(
				[
					'name' => 'test1',
					'GroupsUser' => [['user_id' => '1'], ['user_id' => '2']]
				],
				true
			),
			array(
				[
					'name' => 'test1',
				],
				false
			),
			array(
				[
					'name' => 'test1',
					'GroupsUser' => [['user_id' => '99999999']]
				],
				false
			),
			array(
				[
					'Group',
					'GroupsUser' => [['user_id' => '1'], ['user_id' => '2']]
				],
				true
			),
		);
	}
}
