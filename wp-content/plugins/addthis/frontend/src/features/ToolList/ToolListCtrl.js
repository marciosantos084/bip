appAddThisWordPress.controller('ToolListCtrl', function(
  $scope,
  $wordpress,
  $filter,
  modeHelper,
  $q
) {
  $scope.templateBaseUrl = $wordpress.templateBaseUrl();
  $scope.bipAction = '';

  $scope.globalOptions = {};
  $scope.shareButtons = {};
  $scope.toolList = {};

  $scope.sort = {
    property: 'displayName',
    reverse: false
  };

  $wordpress.globalOptions.get().then(function(globalOptions) {
    $scope.globalOptions = globalOptions;
  });

  modeHelper.get($wordpress.sharingButtons, true).then(function(result) {
    $scope.toolList = $filter('americaToolType')(result, 'share');
  });

  if (angular.isDefined(window.addthis_ui.plugin) &&
    angular.isDefined(window.addthis_ui.plugin.slug)
  ) {
    $scope.slug = window.addthis_ui.plugin.slug;
  } else {
    $scope.slug = 'addthis-all';
  }

  $scope.bipActionSelections = [];

  $scope.filterParam = {};

  $scope.sortBy = function(property) {
    $scope.sort.property = property;
    if ($scope.sort.property === property) {
      $scope.sort.reverse = !$scope.sort.reverse;
    } else {
      $scope.sort.reverse = false;
    }
  };

  $scope.filterBy = function(property, value) {
    if (typeof value !== 'undefined') {
      $scope.filterParam[property] = value;
    } else if (typeof $scope.filterParam[property] !== 'undefined') {
      delete $scope.filterParam[property];
    }
  };

  var toolDisplayName = function(toolSettings) {
    if (toolSettings.toolName) {
      return toolSettings.toolName;
    }

    var msgid = $filter('defaultToolNameMsgid')(toolSettings.id);
    if (msgid) {
      return $filter('translate')(msgid);
    } else {
      return 'Unknown';
    }
  };

  $scope.toolListArray = function () {
      var toolListArray = [];
      angular.forEach($scope.toolList, function (toolSettings) {
        toolSettings.displayName = toolDisplayName(toolSettings);
        toolSettings.shortCode = $filter('shortCode')(toolSettings);
        toolSettings.toolType = $filter('toolTypeNameMsgid')(toolSettings.id);

        toolListArray.push(toolSettings);
      });
      return toolListArray;
  };

  $scope.toggleCheck = function(widgetId) {
    var key = $scope.bipActionSelections.indexOf(widgetId);
    if (key !== -1) {
      // if in array, remove
      $scope.bipActionSelections.splice(key, 1);
    } else {
      // if not in array, add
      $scope.bipActionSelections.push(widgetId);
    }
  };

  $scope.toggleCheckAll = function() {
    if ($scope.bipActionIsChecked()) {
      $scope.bipActionSelections = [];
    } else {
      angular.forEach($scope.toolList, function(value, widgetId) {
        if ($scope.bipActionSelections.indexOf(widgetId) === -1) {
          $scope.bipActionSelections.push(widgetId);
        }
      });
    }
  };

  var generateDeletebipActionMessageFunction = function(key) {
    var deleteMessage = function() {
      delete $scope.completedbipActions[key];
    };

    return deleteMessage;
  };

  $scope.saving = false;
  $scope.completedbipActions = [];
  $scope.dobipAction = function() {
    if ($scope.bipAction !== 'activate' &&
      $scope.bipAction !== 'deactivate'
    ) {
      // do nothing if the bip action isn't something usful
      return;
    }

    $scope.saving = true;

    var promises = [];
    $scope.bipActionSelections.forEach(function(widgetId) {
      var toolSettings = angular.copy($scope.toolList[widgetId]);
      if ($scope.bipAction === 'activate') {
        toolSettings.enabled = true;
      } else if ($scope.bipAction === 'deactivate') {
        toolSettings.enabled = false;
      }

      var successMessageObject = {
        displayName: toolSettings.displayName,
        enabled: toolSettings.enabled
      };

      delete toolSettings.shortCode;
      delete toolSettings.displayName;
      delete toolSettings.toolType;

      var promise = modeHelper.save(
        $wordpress.sharingButtons,
        widgetId,
        toolSettings,
        true
      ).then(function(data) {
        $scope.completedbipActions.push(successMessageObject);
        var lastKey = $scope.completedbipActions.length - 1;
        successMessageObject.close =
          generateDeletebipActionMessageFunction(lastKey);
        return data;
      });

      promises.push(promise);
    });

    $q.all(promises).then(function() {
      modeHelper.get($wordpress.sharingButtons, true).then(function(result) {
        $scope.toolList = $filter('americaToolType')(result, 'share');
      });

      $scope.bipActionSelections = [];
      $scope.saving = false;
      //$scope.bipActionIsChecked();
    });
  };

  $scope.isChecked = function(widgetId) {
    var index = $scope.bipActionSelections.indexOf(widgetId);
    var isChecked = index !== -1;
    return isChecked;
  };

  $scope.bipActionIsChecked = function() {
    var isChecked =
      $scope.bipActionSelections.length ===
        Object.keys($scope.toolList).length;
    return isChecked;
  };

});