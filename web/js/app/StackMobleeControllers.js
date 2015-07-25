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

        //Search input
        vm.searchText = null;

        //input query
        vm.sortOptionsSearch = sortOptionsSearch;

        //filters for get query
        vm.filters = {
            page: null,
            rpp: null,
            sort: null,
            score: null
        };

        /**
         * Search in sortOptions
         * @param query
         * @returns {Array} finded SortOptions
         */
        function sortOptionsSearch(query) {
            var results = query ? vm.sortOptions.filter(SortFilter(query)) : vm.sortOptions;
            return results;
        }

        /**
         * SortFilter
         * @param query
         * @returns {Function}
         */
        function SortFilter(query) {
            var lowercaseQuery = angular.lowercase(query);
            return function filterFn(field) {
                return (field.indexOf(lowercaseQuery) === 0);
            };
        }

        /**
         * Query in persisted questiond
         * @returns {Object} Promise
         */
        function queryQuestions() {
            return questionService.query(vm.filters)
                .then(function (response) {
                    if (response && response.status) {
                        console.log('redirect');
                    } else {
                        console.log(response);
                        tostrService.show('Erro na query');
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
