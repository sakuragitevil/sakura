/**
 * Created by VuThuan on 4/15/2016.
 */

(function () {
    sakuraAngular.controller("accountController", function ($scope, $http) {

        //Initialization
        $scope.frmTitle = '';
        $scope.siClass = '';
        $scope.piClass = '';

        $scope.init = function () {

            $scope.frmTitle = 'Sign-in';
            $scope.siClass = 'Vr';
            $scope.piClass = '';

            $("#skAccount").show();
            $(".acc-scroll").nanoScroller();
        };

        // Event handlers
        $scope.signInItem = function () {
            $scope.siClass = 'Vr';
            $scope.piClass = '';
            $scope.frmTitle = 'Sign-in';
        };

        $scope.personalInfoItem = function () {
            $scope.siClass = '';
            $scope.piClass = 'Vr';
            $scope.frmTitle = 'Personal info';
        };
    });
})();
