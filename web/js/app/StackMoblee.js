/**
 * StackMooblee
 * Module declaration
 * @author: Marcelo Aymone
 */

(function () {
    'use strict';
    // Include app dependency on ngMaterial
    define(['ngMaterial', 'StackMobleeServices', 'StackMobleeControllers'],
        function () {
            angular
                .module('StackMoblee', [
                    'ngMaterial',
                    'StackMobleeServices',
                    'StackMobleeControllers'
                ])
                .factory('httpInterceptor', httpInterceptor)
                .config(config);

            httpInterceptor.$inject = ['$q', '$rootScope', '$window'];

            function httpInterceptor($q, $rootScope, $window) {
                var numLoadings = 0;
                return {
                    request: request,
                    response: function (response) {
                        if ((--numLoadings) === 0) {
                            $rootScope.$broadcast('LoaderEvent', {
                                status: false
                            });
                        }
                        return response || $q.when(response);
                    },
                    responseError: function (response) {
                        if (!(--numLoadings)) {
                            $rootScope.$broadcast('LoaderEvent', {
                                status: false
                            });
                        }
                        return $q.reject(response);
                    }
                };
                function request(config) {
                    numLoadings++;
                    if (angular.isDefined(config.headers['X-Coll-Mode'])) {
                        if (!config.headers['X-Coll-Mode']) {
                            $window.open(serializeUrl(config), '_blank');
                            return $q.reject(config);
                        }
                    }
                    $rootScope.$broadcast('LoaderEvent', {
                        status: true
                    });
                    return config || $q.when(config)
                }

                function serializeUrl(config) {
                    var str = "";
                    var url = config.url;
                    var obj = config.params;
                    for (var key in  obj) {
                        if (str != "") {
                            str += "&";
                        }
                        str += key + "=" + encodeURIComponent(obj[key]);
                    }
                    return url + '?' + str;
                }
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
