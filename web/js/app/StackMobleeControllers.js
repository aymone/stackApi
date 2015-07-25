/**
 * Stack2Mooblee
 * Question Services
 * @author: Marcelo Aymone
 */

define([], function () {
    angular.module('StackMobleeControllers', [])
        .controller('AppController', AppController);

    AppController.$inject = ['$rootScope', '$scope', 'questionService', 'tostrService', '$timeout', '$q'];
    function AppController($rootScope, $scope, questionService, tostrService, $timeout, $q) {
        var vm = this;
        var questions = {};

        //loader status machine
        vm.loading = false;

        //my services
        vm.getQuestions = getQuestions;
        vm.postQuestions = postQuestions;
        vm.query = query;

        //Directive info
        vm.sortOptions = loadOptions();
        vm.searchText = null;
        vm.querySearch = querySearch;

        //filters for query
        vm.filters = {
            page: null,
            rpp: null,
            sort: null,
            score: null
        };

        function query() {
            console.log(vm.filters);
        }


        function querySearch(query) {
            var results = query ? vm.sortOptions.filter(createFilterFor(query)) : vm.sortOptions;
            return results;
        }

        /**
         * Build `states` list of key/value pairs
         */
        function loadOptions() {
            var allFields = 'question_id, title, owner_name, score, creation_date, link, is_answered';
            return allFields.split(/, +/g).map(function (field) {
                console.log(field);
                return field.toLowerCase();
            });
        }

        /**
         * Create filter function for a query string
         */
        function createFilterFor(query) {
            var lowercaseQuery = angular.lowercase(query);
            return function filterFn(field) {
                return (field.indexOf(lowercaseQuery) === 0);
            };
        }


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

})
;
