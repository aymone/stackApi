/**
 * Stack2Mooblee
 * Question Services
 * @author: Marcelo Aymone
 */

define([], function() {
    angular.module('StackMobleeControllers', [])
        .controller('AppCtrl', AppCtrl);

    function AppCtrl($rootScope, $scope, $mdToast, $animate, questionService) {
        var vm = this;
        vm.teste = questionService.teste();
        vm.loading = false;
        vm.getQuestions = getQuestions;
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
                .then(function(data) {
                    vm.questions = data.itens;
                    showSimpleToast('Dados persistidos com sucesso!');
                })
                .catch(function(error) {
                    showSimpleToast('Erro encontrado');
                });
        }

        $rootScope.$on("LoaderEvent", function(event, data) {
            vm.loading = data.status;
            console.log('activated');
        });


    }
    AppCtrl.$inject = ['$rootScope', '$scope', '$mdToast', '$animate', 'questionService'];
});
