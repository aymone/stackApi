/**
 * Stack2Mooblee
 * Question Services
 * @author: Marcelo Aymone
 */

define([], function () {
    angular.module('StackMobleeControllers', [])
        .controller('AppController', AppController);

    AppController.$inject = ['$rootScope', '$scope', 'questionService', 'tostrService'];
    function AppController($rootScope, $scope, questionService, tostrService) {
        var vm = this;
        var questions = {};

        vm.loading = false;

        vm.getQuestions = getQuestions;
        vm.postQuestions = postQuestions;

        /**
         * Get questions
         * @returns {*}
         */
        function getQuestions() {
            return questionService.get()
                .then(function (response) {
                    if (response && angular.isDefined(response.items)) {
                        questions = response.items;
                        tostrService.show('Dados recuperados com sucesso!');
                    } else {
                        tostrService.show('Erro ao recuperar dados, verifique o console do browser!');
                    }
                }).then(function () {
                    if (angular.isDefined(questions.length)) {
                        postQuestions(questions);
                    }
                });
        }

        /**
         * Post questions
         * @param data
         * @returns {*}
         */
        function postQuestions(data) {
            return questionService.post(data)
                .then(function (response) {
                    console.log(response);
                    if (angular.isDefined(response) && response.status) {
                        tostrService.show('Dados persistidos com sucesso!');
                    } else {
                        tostrService.show('Erro ao persistir dados, verifique o console do browser!');
                    }
                });
        }

        $rootScope.$on("LoaderEvent", function (event, data) {
            vm.loading = data.status;
        });
    }

});
