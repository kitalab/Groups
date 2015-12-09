/**
 * Groups JavaScript
 */
NetCommonsApp.directive('groupsSelectedUsers', function() {
	return {
		restrict: 'EA',
		template: '<div id="groups-selected-user-{{user.id}}" class="col-xs-12 user-selection-list">' +
						'<img class="user-avatar-xs" ng-src="{{user.avatar}}" />'+
						'<span>{{user.handlename}}</span>'+
						'<a id="groups-user-del-link{{user.id}}" href="#" onclick="return false;" ng-click="deleteUser(user.id);">'+'×'+'</a>'+
						'<input type="hidden" name="data[GroupsUser][][user_id]" value="{{user.id}}" />'+
					'</div>',
		transclude: false,
		scope: false,
		replace: true
	};
});

/**
 * Sample Javascript
 *
 * @param {string} Controller name
 * @param {function($scope, SelectUser)} Controller
 */
NetCommonsApp.controller('GroupsEdit', function($scope, SelectUser) {

	/**
	 * 会員選択の結果を保持する配列
	 *
	 * @return {array}
	 */
	$scope.users = [];

	/**
	 * initialize
	 *
	 * @return {void}
	 */
	$scope.initialize = function(data) {
		angular.forEach(data.users, function(value) {
			$scope.users.push(value);
		});
	};

	/**
	 * 会員の選択状態を検知する
	 *
	 * @return {array}
	 */
	$scope.$watch('users', function() {
		return $scope.users;
	}, true);

	/**
	 * 会員選択ダイアログを表示する
	 *
	 * @param {number} users.id
	 * @return {void}
	 */
	$scope.showUserSelectionDialog = function(userId, roomId) {
		SelectUser($scope, userId, roomId).result.then(
			function(result) {
				// 選択したユーザを追加
				$.each (result, function(index, user){
					$scope.users.push(user);
				});
			},
			function() {
			}
		);
	};
	$scope.deleteUser = function(targetUserId) {
		for (var i = 0; i < $scope.users.length; i++) {
			var user = $scope.users[i];
			if (user.id == targetUserId) {
				$scope.users.splice(i, 1);
				break;
			}
		}
	};
});