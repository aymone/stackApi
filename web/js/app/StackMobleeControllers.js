/**
 * Stack2Mooblee
 * Question Services
 * @author: Marcelo Aymone
 */

define([], function () {
    angular.module('StackMobleeControllers', [])
        .controller('AppController', AppController);

    function AppController($rootScope, $scope, $mdToast, $animate, questionService) {
        var vm = this;
        vm.loading = false;
        vm.getQuestions = getQuestions;
        //bind to view just for fun
        vm.questions = {};

        function showSimpleToast(msg) {
            $mdToast.show(
                $mdToast.simple()
                    .content(msg)
                    .position('top right')
                    .hideDelay(3000)
            );
        };

        function getQuestions() {
            return questionService.get()
                .then(function (data) {
                    if (data && angular.isDefined(data.items)) {
                        vm.questions = data.items;
                        showSimpleToast('Dados recuperados com sucesso!');
                    } else {
                        showSimpleToast('Erro ao recuperar dados, verifique o console do browser!');
                    }
                }).then(function () {
                    if (angular.isDefined(vm.questions.length)) {
                        //postQuestions([]);
                    }
                });
        }

        function postQuestions(data) {
            return questionService.post(data)
                .then(function (data) {
                    if (data && angular.isDefined(data.items)) {
                        showSimpleToast('Dados persistidos com sucesso!');
                    } else {
                        showSimpleToast('Erro ao persistir dados, verifique o console do browser!');
                    }
                });
        }

        $rootScope.$on("LoaderEvent", function (event, data) {
            vm.loading = data.status;
        });
    }

    AppController.$inject = ['$rootScope', '$scope', '$mdToast', '$animate', 'questionService'];
});
