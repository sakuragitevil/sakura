/**
 * Created by VuThuan on 4/15/2016.
 */

(function () {
    sakuraAngular.controller("accountController", function ($scope, $http) {

        //Initialization
        $scope.display = false;
        $scope.frmTitle = '';
        $scope.siClass = '';
        $scope.piClass = '';

        $scope.init = function () {

            $scope.frmTitle = 'Sign-in';
            $scope.siClass = 'Vr';
            $scope.piClass = '';

            $scope.display = true;
            $(".acc-scroll").nanoScroller();
        };

        // Event handlers
        $scope.signInItem = function () {
            $scope.siClass = 'Vr';
            $scope.piClass = '';
            $scope.frmTitle = 'Sign-in';
            $(".acc-scroll").nanoScroller({scroll: 'top'});
        };

        $scope.personalInfoItem = function () {
            $scope.siClass = '';
            $scope.piClass = 'Vr';
            $scope.frmTitle = 'Personal info';
            $(".acc-scroll").nanoScroller({scrollTo: $("#piTop")});
        };
    });
})();
