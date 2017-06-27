var countryApp = angular.module("countryApp",[],function($interpolateProvider){
  $interpolateProvider.startSymbol('<%');
  $interpolateProvider.endSymbol('%>');
});

countryApp.controller("countryCtrl",function($scope){
    $scope.countries = [
      {name : 'Country', value : ''},
      {name : 'Korea', value : 'Korea'},
      {name : 'United State', value : 'United State'},
      {name : 'Russia', value : 'Russia'},
      {name : 'Japan', value : 'Japan'},
      {name : 'China', value : 'China'},
      {name : 'France', value : 'France'}
    ];
});
