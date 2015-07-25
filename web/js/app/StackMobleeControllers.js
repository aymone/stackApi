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
        var questions = {};

        vm.loading = false;

        //Bindable members
        vm.getQuestions = getQuestions;
        vm.postQuestions = postQuestions;

        function showSimpleToast(msg) {
            $mdToast.show(
                $mdToast.simple()
                    .content(msg)
                    .position('top right')
                    .hideDelay(3000)
            );
        }

        function getQuestions() {
            return questionService.get()
                .then(function (response) {
                    if (response && angular.isDefined(response.items)) {
                        questions = response.items;
                        showSimpleToast('Dados recuperados com sucesso!');
                    } else {
                        showSimpleToast('Erro ao recuperar dados, verifique o console do browser!');
                    }
                }).then(function () {
                    if (angular.isDefined(questions.length)) {
                        postQuestions(questions);
                    }
                });
        }

        function postQuestions(data) {
            return questionService.post(data)
                .then(function (response) {
                    if (angular.isDefined(response) && response.content.status) {
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
