userApp.controller('UserController', function($scope, $http) {
  
  $scope.form = {
    state: {},
    data: {}
  };
  
  $scope.saveForm = function() {
    console.log('Saving form data ...', $scope.form.data);   
            return $http({
                method: 'POST',
                url: 'preferences',
                //headers: { 'Content-Type' : 'application/x-www-form-urlencoded' },
                data: $scope.form.data
            });
  };
  
});