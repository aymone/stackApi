/**
 * Stack2Mooblee
 * Question Services
 * @author: Marcelo Aymone
 */

define([], function() {
    angular.module('StackMobleeServices', [])
        .factory('questionService', questionService);

    function questionService($http) {
        var a = 'testing services';
        return {
            teste: teste,
            get: get
        };

        function teste() {
            return a;
        }

        function get() {
            var url =
                'https://api.stackexchange.com/2.2/answers?order=desc&sort=activity&site=stackoverflow';
            return $http.get(url)
                .then(successHandler)
                .catch(errorHandler);
        }
    }

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
        console.log(error);
        return false;
    }
});
