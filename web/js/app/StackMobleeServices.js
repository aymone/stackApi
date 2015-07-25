/**
 * Stack2Mooblee
 * Question Services
 * @author: Marcelo Aymone
 */

define([], function () {
    angular.module('StackMobleeServices', [])
        .factory('tostrService', tostrService)
        .factory('questionService', questionService);

    tostrService.$inject = ['$mdToast', '$animate'];
    function tostrService($mdToast, $animate) {
        return {
            show: show
        };

        function show(msg) {
            $mdToast.show(
                $mdToast.simple()
                    .content(msg)
                    .position('top right')
                    .hideDelay(3000)
            );
        }
    }

    /**
     * @param $http
     * @returns {{get: get, post: post}}
     */
    questionService.$inject = ['$http'];
    function questionService($http) {
        /**
         * Public methods
         */
        return {
            get: get,
            post: post,
            query: query
        };

        function query(filters) {
            var url = 'http://local.stack.com/stack_moblee/v1/questions';
            var config = {
                params: filters
            };
            return $http.get(url, config)
                .then(successHandler)
                .catch(errorHandler);
        }

        /**
         * Post data retrieved from stackOverflow api
         * @returns {object} promise
         */
        function post(data) {
            var url = 'http://local.stack.com/stack_moblee/v1/questions';
            return $http.post(url, data)
                .then(successHandler)
                .catch(errorHandler);
        }

        /**
         * Retrive data from stackOverflow api
         * @returns {object} promise
         */
        function get() {
            var url = 'https://api.stackexchange.com/2.2/questions';
            var config = {
                params: {
                    page: 1,
                    pagesize: 99,
                    order: 'desc',
                    sort: 'creation',
                    tagged: 'php',
                    site: 'stackoverflow',
                    //filter for defined fields
                    filter: '!1PUolpjSEGSfDxvTfzfJEmgJjX_LaWJTr'
                }
            };
            return $http.get(url, config)
                .then(successHandler)
                .catch(errorHandler);
        }

        /**
         * Non public methods
         */

        /**
         * Common Success Handler
         * @param response
         * @returns {*}
         */
        function successHandler(response) {
            return response.data;
        }

        /**
         * Common Error Handler
         * @param error
         * @returns {boolean}
         */
        function errorHandler(error) {
            console.log(error.config);
            return false;
        }

    }
});
