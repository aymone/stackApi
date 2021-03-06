/**
 * Stack2Mooblee
 * Question Services
 * @author: Marcelo Aymone
 */

define([], function () {
    angular.module('StackMobleeControllers', [])
        .filter('formatDatetime', formatDatetime)
        .controller('AppController', AppController);

    function formatDatetime() {
        return function (input) {
            var _datetime = new Date(input * 1000);
            return _datetime.toString();
        }
    }

    AppController.$inject = ['$rootScope', 'questionService', 'tostrService'];
    function AppController($rootScope, questionService, tostrService) {
        var vm = this;
        var questions = {};
        vm.filtered = [];
        vm.lastUpdate = null;
        //loader status machine
        vm.loading = false;
        //list/redirect mode
        vm.coolMode = false;

        //my services
        vm.getQuestions = getQuestions;
        vm.postQuestions = postQuestions;
        vm.queryQuestions = queryQuestions;

        //Directive data
        vm.sortOptions = [
            "question_id",
            "title",
            "owner_name",
            "score",
            "creation_date",
            "link",
            "is_answered"
        ];

        //filters for get query
        vm.filters = {
            page: 1,
            rpp: 10,
            sort: 'creation_date',
            score: 0
        };

        /**
         * Query in persisted questiond
         * @returns {Object} Promise
         */
        function queryQuestions() {
            return questionService.query(vm.filters, vm.coolMode)
                .then(function (response) {
                    if (response && response.content) {
                        vm.filtered = response.content;
                        vm.lastUpdate = response.last_update;
                        tostrService.show('Busca efetuada com sucesso!');
                    }
                });
        }

        /**
         * Get questions
         * @returns {Object} Promise
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
         * @returns {Object} Promise
         */
        function postQuestions(data) {
            return questionService.post(data)
                .then(function (response) {
                    if (angular.isDefined(response) && response.status) {
                        vm.lastUpdate = response.last_update;
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
