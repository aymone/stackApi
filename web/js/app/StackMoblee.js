/**
 * StackMooblee
 * Module declaration
 * @author: Marcelo Aymone
 */

(function() {
    'use strict';
    // Include app dependency on ngMaterial
    define(['ngMaterial', 'StackMobleeServices', 'StackMobleeControllers'],
        function() {
            angular
                .module('StackMoblee', [
                    'ngMaterial',
                    'StackMobleeServices',
                    'StackMobleeControllers'
                ])
                .factory('httpInterceptor', httpInterceptor)
                .config(config);

            httpInterceptor.$inject = ['$q', '$rootScope'];

            function httpInterceptor($q, $rootScope) {
                var numLoadings = 0;
                return {
                    request: function(config) {
                        numLoadings++;
                        $rootScope.$broadcast('LoaderEvent', {
                            status: true
                        });
                        return config || $q.when(config)
                    },
                    response: function(response) {
                        if ((--numLoadings) === 0) {
                            $rootScope.$broadcast('LoaderEvent', {
                                status: false
                            });
                        }
                        return response || $q.when(response);
                    },
                    responseError: function(response) {
                        if (!(--numLoadings)) {
                            $rootScope.$broadcast('LoaderEvent', {
                                status: false
                            });
                        }
                        return $q.reject(response);
                    }
                };
            }
            config.$inject = ['$httpProvider', '$locationProvider', '$interpolateProvider'];

            function config($httpProvider, $locationProvider, $interpolateProvider) {
                $httpProvider.interceptors.push('httpInterceptor');
                $locationProvider.html5Mode(false);
                $interpolateProvider.startSymbol('{[{').endSymbol('}]}');
            }
        }
    );
})();
