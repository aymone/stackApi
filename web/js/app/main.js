/**
 * Stack2Mooblee
 * Autoloading for Angular deps
 * @author: Marcelo Aymone
 */

//Module bootstrap Config
require.config({
    waitSeconds: 0,
    paths: {
        //Angular SRC's
        'angular': '/node_modules/angular/angular',
        'ngAria': '/node_modules/angular-aria/angular-aria',
        'ngAnimate': '/node_modules/angular-animate/angular-animate',
        'ngMaterial': '/node_modules/angular-material/angular-material',
        //App Modules
        'StackMoblee': '/js/app/StackMoblee',
        'StackMobleeServices': '/js/app/StackMobleeServices',
        'StackMobleeControllers' : '/js/app/StackMobleeControllers'
    },
    shim: {
        'angular': {
            exports: 'angular'
        },
        'ngAria':{
            deps: ['angular'],
            exports: 'ngAria'
        },
        'ngAnimate':{
            deps: ['angular'],
            exports: 'ngAnimate'
        },
        'ngMaterial':{
            deps: ['angular'],
            exports: 'ngMaterial'
        },
        'StackMoblee': {
            deps: ['angular', 'ngAria', 'ngAnimate', 'ngMaterial', 'ngSanitize'],
            exports: 'StackMoblee'
        }
    }
});

//Module Bootstrap
require(['StackMoblee'], function () {
    angular.element(document).ready(function() {
        angular.bootstrap(document, ['StackMoblee']);
    });
});
