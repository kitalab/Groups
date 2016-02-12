/**
 * Groups JavaScript
 */
<<<<<<< HEAD
=======
NetCommonsApp.service('SelectGroupUsers',
    function() {
      var service = {
        selectUsers: null
      };
      return service;
    }
);


/**
 * Groups JavaScript
 */
NetCommonsApp.factory('AddGroup',
    ['NetCommonsModal', function(NetCommonsModal) {
      return function($scope, userId, selectors, SelectGroupUsers) {
        var getUrl = $scope.baseUrl + '/groups/groups/add/' + userId +
            '/' + Math.random() + '?isModal=1';
        return NetCommonsModal.show(
            $scope, 'Group.add',
            getUrl,
            {
              backdrop: 'static',
              resolve: {
                options: {
                  userId: userId,
                  getUrl: getUrl
                }
              }
            }
        );
      }
    }]
);


NetCommonsApp.controller('GroupsAddGroup',
    function($scope, $controller, AddGroup, SelectGroupUsers) {
      $controller('GroupsSelect', {$scope: $scope});
      $scope.showGroupAddDialog = function(userId) {
        AddGroup($scope, userId).result.then(
            function(result) {
              // ポップアップを閉じたあとも、ユーザ選択情報を保持
              var groupSelectScope =
                  angular.element('#group-user-select').scope();
              SelectGroupUsers.selectUsers = groupSelectScope.users;
            },
            function() {
              // ポップアップを閉じたあとも、ユーザ選択情報を保持
              var groupSelectScope =
                  angular.element('#group-user-select').scope();
              SelectGroupUsers.selectUsers = groupSelectScope.users;
            }
        );
      };
    });


NetCommonsApp.controller('Group.add',
    function($scope, $controller, $http, $q, $location, $window,
        $modalInstance, AddGroup, options, SelectGroupUsers) {

      $scope.userId = null;
      $scope.data = null;
      $controller('GroupsSelect', {$scope: $scope});

      $scope.cancel = function() {
        $modalInstance.close();
      };

      $scope.save = function() {
        var element = angular.element('#GroupAddForm');
        var data = new Object();
        angular.forEach(element.serializeArray(), function(input) {
          data[input['name']] = input['value'];
        }, $scope);

        saveGroup(data, options)
            .success(function(data) {
              $modalInstance.close();
            })
            .error(function(data, status) {
              $modalInstance.dismiss('error');
            });

      };

      var saveGroup = function(data, options) {
        var deferred = $q.defer();
        var promise = deferred.promise;
        $scope.data = data;
        $http.get('/net_commons/net_commons/csrfToken.json')
            .success(function(token) {
              $scope.data['data[_Token][key]'] = token.data._Token.key;

              // POSTリクエスト
              $http.post(
                  options['getUrl'],
                  $.param($scope.data),
                  {
                    cache: false,
                    headers: {
                      'Content-Type': 'application/x-www-form-urlencoded'
                    }
                  }
              )
              .success(function(data) {
                    // success condition
                    deferred.resolve(data);
                  })
              .error(function(data, status) {
                    var target = $('#groups-input-name-' +
                        options['userId'] + ' div.has-error');
                    target.empty();
                    angular.forEach(data.error.validationErrors,
                        function(errObj) {
                          angular.forEach(errObj, function(errMsg) {
                            target.append('<div class="help-block">' +
                                errMsg + '</div>');
                          });
                        });
                      });
            })
                .error(function(data, status) {
                  // Token error condition
                  deferred.reject(data, status);
                });

        promise.success = function(fn) {
          promise.then(fn);
          return promise;
        };

        promise.error = function(fn) {
          promise.then(null, fn);
          return promise;
        };

        return promise;
      };

    });


/**
 * Groups JavaScript
 */
>>>>>>> 5add7ac49e11c80f097e28a0be820b23d7b6d92b
NetCommonsApp.factory('SelectGroup',
    ['NetCommonsModal', function(NetCommonsModal) {
      return function($scope, userId, selectors) {
        return NetCommonsModal.show(
            $scope, 'Group.select',
<<<<<<< HEAD
            $scope.baseUrl + '/groups/groups/select/' + userId + '/',
=======
            $scope.baseUrl + '/groups/groups/select/' +
                userId + '/' + Math.random(),
>>>>>>> 5add7ac49e11c80f097e28a0be820b23d7b6d92b
            {
              backdrop: 'static',
              resolve: {
                options: {
                  userId: userId,
<<<<<<< HEAD
                  //roomId: roomId,
=======
>>>>>>> 5add7ac49e11c80f097e28a0be820b23d7b6d92b
                  selectors: selectors
                }
              }
            }
        );
      }
    }]
);


/**
 * Groups JavaScript
 */
NetCommonsApp.directive('groupsSelectedUsers', function() {
  return {
    restrict: 'EA',
    template: '<div id="groups-selected-user-{{user.id}}"' +
        ' class="nc-groups-user-selection-list">' +
        '<img class="user-avatar-xs" ng-src="{{user.avatar}}" />' +
        '<span class="nc-groups-select-user-name">{{user.handlename}}</span>' +
        '<button id="groups-user-del-link{{user.id}}" href="#" ' +
        ' class="btn btn-default btn-xs pull-right" onclick="return false;" ' +
        'ng-click="deleteUser(user.id);">' +
        '<span class="glyphicon glyphicon-remove"></span>' + '</button>' +
<<<<<<< HEAD
        '<input type="hidden" name="data[GroupsUser][][user_id]" ' +
=======
        '<input type="hidden" ' +
            'name="data[{{pluginModel}}][user_id][{{user.id}}]" ' +
>>>>>>> 5add7ac49e11c80f097e28a0be820b23d7b6d92b
        'value="{{user.id}}" />' +
        '</div>',
    transclude: false,
    scope: false,
    replace: true
  };
});


/**
 * Groups Javascript
 *
 * @param {string} Controller name
 * @param {function($scope, SelectUser)} Controller
 */
<<<<<<< HEAD
NetCommonsApp.controller('GroupsSelect', function($scope) {

  /**
   * 会員選択の結果を保持する配列
   *
   * @return {array}
   */
  $scope.users = [];

  /**
   * 会員の選択状態を検知する
   *
   * @return {array}
   */
  $scope.$watch('users', function() {
    return $scope.users;
  }, true);

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

  $scope.addUsers = function(users) {
    $.each(users, function(index, user) {
      $scope.users.push(user);
console.log($scope.users);
    });
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
=======
NetCommonsApp.controller('GroupsSelect',
    function($scope, filterFilter, SelectGroupUsers) {

      /**
       * プラグイン側で使用するモデル名
       *
       * @return {array}
       */
      $scope.pluginModel = null;

      /**
       * 会員選択の結果を保持する配列
       *
       * @return {array}
       */
      $scope.users = [];

      /**
       * 会員の選択状態を検知する
       *
       * @return {array}
       */
      $scope.$watch('users', function() {
        SelectGroupUsers.selectUsers = $scope.users;
        return $scope.users;
      }, true);

      /**
       * initialize
       *
       * @return {void}
       */
      $scope.initialize = function(data, pluginModel) {
        $scope.pluginModel = pluginModel;

        angular.forEach(data.users, function(value) {
          $scope.users.push(value);
        });
        angular.forEach(SelectGroupUsers.selectUsers, function(value) {
          $scope.users.push(value);
        });
      };

      $scope.addUsers = function(users) {
        $.each(users, function(index, user) {
          var result = filterFilter($scope.users, {id: user.id});
          if (result.length == 0) {
            $scope.users.push(user);
          }
        });
        SelectGroupUsers.selectUsers = $scope.users;
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
>>>>>>> 5add7ac49e11c80f097e28a0be820b23d7b6d92b


/**
 * Sample Javascript
 *
 * @param {string} Controller name
 * @param {function($scope, SelectUser)} Controller
 */
NetCommonsApp.controller('GroupsSelectUser',
    function($scope, $controller, SelectUser) {
      $controller('GroupsSelect', {$scope: $scope});

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
              $scope.$parent.addUsers(result);
            },
            function() {
            }
        );
      };
    });

<<<<<<< HEAD
NetCommonsApp.controller('GroupsSelectGroup', function($scope, SelectGroup) {

  //$scope.showGroupSelectionDialog = function(userId, roomId) {
  $scope.showGroupSelectionDialog = function(userId) {
    SelectGroup($scope, userId).result.then(
        function(result) {
        },
        function() {
        }
    );
  };
});
=======
NetCommonsApp.controller('GroupsSelectGroup',
    function($scope, SelectGroup, SelectGroupUsers) {

      $scope.showGroupSelectionDialog = function(userId) {
        SelectGroup($scope, userId).result.then(
            function(result) {
            },
            function() {
              // ポップアップを閉じたあとも、ユーザ選択情報を保持
              var groupSelectScope =
                  angular.element('#group-user-select').scope();
              SelectGroupUsers.selectUsers = groupSelectScope.users;
            }
        );
      };
    });
>>>>>>> 5add7ac49e11c80f097e28a0be820b23d7b6d92b

NetCommonsApp.controller('Group.select',
    function($scope, $controller, $http, $q,
             $modalInstance, filterFilter, options) {
      $controller('GroupsSelect', {$scope: $scope});

      /**
       * ユーザIDを保持する変数
       */
      $scope.userId = options['userId'];

      /**
       * 検索結果を保持する配列
       */
      $scope.groupList = [];

      /**
       * 選択したユーザを保持する配列
       */
      $scope.selectors = options['selectors'];

      /**
       * Post data
       */
      $scope.data = null;

      /**
       * 初期処理
       *
       * @return {void}
       */
      //$scope.initialize = function(domId, groupList, data, field) {
      $scope.initialize = function(groupList, data) {
        $scope.data = data;
        if (angular.isArray(groupList) && groupList.length > 0) {
          $scope.groupList = groupList;
        }
      };

      /**
       * 選択処理
       *
       * @return {void}
       */
      $scope.select = function(index) {
        var result = filterFilter($scope.groupList,
            //$scope.groupList[index]);
<<<<<<< HEAD
            {id:$scope.groupList[index]['id']}, true);
=======
            {id: $scope.groupList[index]['id']}, true);
>>>>>>> 5add7ac49e11c80f097e28a0be820b23d7b6d92b

        if (!angular.isArray($scope.selectors)) {
          $scope.selectors = [];
        }
        if (!$scope.selected(result[0])) {
          $scope.selectors.push(result[0]);
        }
      };

      /**
       * 選択しているかどうかチェックする
       *
       * @return {bool}
       */
      $scope.selected = function(obj) {
        if (!angular.isArray($scope.selectors)) {
          return false;
        }
        //var result = filterFilter($scope.selectors, obj);
<<<<<<< HEAD
        var result = filterFilter($scope.selectors, {id:obj['id']}, true);
=======
        var result = filterFilter($scope.selectors, {id: obj['id']}, true);
>>>>>>> 5add7ac49e11c80f097e28a0be820b23d7b6d92b
        return !(result.length === 0);
      };

      /**
       * 選択の解除処理
       *
       * @return {void}
       */
      $scope.remove = function(index) {
        $scope.selectors.splice(index, 1);
      };

      /**
       * キャンセル処理＆ダイアログ閉じる
       *
       * @return {void}
       */
      $scope.cancel = function() {
        $modalInstance.dismiss('cancel');
      };

      /**
       * 決定処理＆ダイアログ閉じる
       *
       * @return {void}
       */
      $scope.save = function() {
        angular.forEach($scope.selectors, function(selector) {
          this.data.GroupSelect.group_id.push(selector.id);
        }, $scope);

        saveGroupSelect()
            .success(function(data) {
              // 選択したユーザを追加
              $scope.$parent.addUsers(data['users']);
              $modalInstance.close($scope.selectors);
            })
            .error(function(data, status) {
              $modalInstance.dismiss('error');
            });
      };

      /**
       * ユーザ選択したグループ情報更新処理関数
       *
       * @return {Function}
       */
      var saveGroupSelect = function() {
        var deferred = $q.defer();
        var promise = deferred.promise;

        $http.get('/net_commons/net_commons/csrfToken.json')
            .success(function(token) {
<<<<<<< HEAD
              // TODO トークン系見直し
              //$scope.data._Token.key = token.data._Token.key;
=======
              $scope.data._Token.key = token.data._Token.key;
>>>>>>> 5add7ac49e11c80f097e28a0be820b23d7b6d92b

              //POSTリクエスト
              $http.post(
                  '/groups/groups/select/' + $scope.userId,
                  $.param({_method: 'POST', data: $scope.data}),
                  {
                    cache: false,
                    headers: {
                      'Content-Type': 'application/x-www-form-urlencoded'
                    }
                  }
              )
                  .success(function(data) {
                    //success condition
                    deferred.resolve(data);
                  })
                  .error(function(data, status) {
                    //error condition
                    deferred.reject(data, status);
                  });
            })
            .error(function(data, status) {
              //Token error condition
              deferred.reject(data, status);
            });

        promise.success = function(fn) {
          promise.then(fn);
          return promise;
        };

        promise.error = function(fn) {
          promise.then(null, fn);
          return promise;
        };

        return promise;
      };
    });