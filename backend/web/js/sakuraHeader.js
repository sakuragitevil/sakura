/**
 * Created by VuThuan on 4/7/2016.
 */

(function () {
    var sakuraHeader = angular.module("sakuraHeader", []);
    sakuraHeader.controller("headerController", function ($scope, $http) {

        //Initialization
        $scope.openAccInfoStatus = 0;
        $scope.openNotifyStatus = 0;
        $scope.openAppInfoStatus = 0;


        // Event handlers
        $scope.openAccInfo = function () {

            var parent = $(event.currentTarget).parent('div');
            if ($scope.openAccInfoStatus == 0) {
                parent.find("div.acDlg_rl").show();
                parent.find("div#acDlg").show();
                $scope.openAccInfoStatus = 1;
            } else {
                parent.find("div.acDlg_rl").hide();
                parent.find("div#acDlg").hide();
                $scope.openAccInfoStatus = 0;
            }
        };

        $scope.openNotifications = function(){
            var parent = $(event.currentTarget).parent('div');
            if ($scope.openNotifyStatus == 0) {
                parent.find("div.ntfDlg_rl").show();
                parent.find("div#ntfDlg").show();
                $scope.openNotifyStatus = 1;
            } else {
                parent.find("div.ntfDlg_rl").hide();
                parent.find("div#ntfDlg").hide();
                $scope.openNotifyStatus = 0;
            }
        };

        $scope.openAppInfo = function(){
            var parent = $(event.currentTarget).parent('div');
            if ($scope.openAppInfoStatus == 0) {
                parent.find("div.appDlg_rl").show();
                parent.find("div#appDlg").show();
                $scope.openAppInfoStatus = 1;
            } else {
                parent.find("div.appDlg_rl").hide();
                parent.find("div#appDlg").hide();
                $scope.openAppInfoStatus = 0;
            }
        };

        $(document).mouseup(function (event) {
            if ($scope.openAccInfoStatus == 1) {
                var container_1 = $("#acIcon");
                if (!container_1.is(event.target) && container_1.has(event.target).length === 1) {
                    return false;
                }
                var container_2 = $("#acDlg");
                if (!container_2.is(event.target) && container_2.has(event.target).length === 0) {
                    var parent = container_2.parent('div');
                    parent.find("div.acDlg_rl").hide();
                    parent.find("div#acDlg").hide();
                    $scope.openAccInfoStatus = 0;
                }
            }

            if ($scope.openNotifyStatus == 1) {
                var container_1 = $("#notifyInfo");
                if (!container_1.is(event.target) && container_1.has(event.target).length === 1) {
                    return false;
                }
                var container_2 = $("#ntfDlg");
                if (!container_2.is(event.target) && container_2.has(event.target).length === 0) {
                    var parent = container_2.parent('div');
                    parent.find("div.ntfDlg_rl").hide();
                    parent.find("div#ntfDlg").hide();
                    $scope.openNotifyStatus = 0;
                }
            }

            if ($scope.openAppInfoStatus == 1) {
                var container_1 = $("#appIf");
                if (!container_1.is(event.target) && container_1.has(event.target).length === 1) {
                    return false;
                }
                var container_2 = $("#appDlg");
                if (!container_2.is(event.target) && container_2.has(event.target).length === 0) {
                    var parent = container_2.parent('div');
                    parent.find("div.appDlg_rl").hide();
                    parent.find("div#appDlg").hide();
                    $scope.openAppInfoStatus = 0;
                }
            }



        });
    });
})();
