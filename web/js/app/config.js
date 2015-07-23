/**
 * Stack2Mooblee
 * Module Config
 * @author: Marcelo Aymone
 */
define([],function(){

moduleConfig.$inject = ['$httpProvider', '$locationProvider', '$interpolateProvider'];
function moduleConfig($httpProvider, $locationProvider, $interpolateProvider) {
    $httpProvider.interceptors.push('httpInterceptor');
    $interpolateProvider.startSymbol('{[{').endSymbol('}]}');
    $locationProvider.html5Mode(false);
}

httpInterceptor.$inject = ['$q', '$rootScope'];
function httpInterceptor($q, $rootScope) {
    var numLoadings = 0;
    return {
        request: function (config) {
            numLoadings++;
            $rootScope.$broadcast('LoaderEvent', {
                status: true
            });
            return config || $q.when(config)
        },
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
}
return config;
});
