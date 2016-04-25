/**
 * Created by VuThuan on 4/15/2016.
 */

(function () {
    var sakuraAccount = angular.module("sakuraAccount", []);
    sakuraAccount.controller("accountController", function ($scope, $http) {

        //Initialization

        // Event handlers
        $scope.signInItem = function () {
            alert("OK");
        };

    });

    $(".acc-scroll").nanoScroller();
})();
