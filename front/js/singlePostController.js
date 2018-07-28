app.controller('singlePostController',function($scope,$http,$location){
  var url = $location.path().split('/');
  $http.get(website + "opt=post&id=" + url[2]).then(function(response){
    $scope.post = response.data.post[0];
  })
})
