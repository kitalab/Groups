<?php
/**
 * Group::beforeSave()のテスト
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Yuna Miyashita <butackle@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('GroupsModelTestBase', 'Groups.Test/Case');

/**
 * Group::beforeSave()のテスト
 *
 * @author Yuna Miyashita <butackle@gmail.com>
 * @package NetCommons\Groups\Test\Case\Model\Group
 */
class GroupBeforeSaveTest extends GroupsModelTestBase {

/**
 * validates()のテスト
 *
 * @dataProvider dataProviderBeforeSave
 * @param array $inputData 入力データ
 * @param array $validationErrors バリデーション結果
 * @return void
 */
	public function testBeforeSave($inputData = [], $validationErrors = []) {
		$this->_templateTestBeforeSave(
			$inputData,
			$validationErrors,
			$this->_classGroup
		);
	}

/**
 * testBeforeSave用dataProvider
 * 
 * ### 戻り値
 *  - inputData:	入力データ
 *  - expectedValidationError:	バリデーション結果
 */
	public function dataProviderBeforeSave() {
		return array(
			array(
				[
					'Group' => [
						'id' => 1,
						'name' => 'test1'
					],
				],
				true
			),
			array(
				[
					'Group' => ['name' => 'test1'],
				],
				true
			),
			array(
				[
					'Group' => [
						'id' => 9999,
						'name' => 'test1'
					],
				],
				false
			),
		);
	}
}
