app.controller('updateController',function ($scope,$http,$location,$rootScope){
  var urls = $location.path().split('/');
  var id = urls[2];
  for (i = 0; i <= $rootScope.list.length; i++){
    if( $rootScope.list[i].id == id){
      $scope.post = $rootScope.list[i];
      break;
    }
  }
  $scope.updateNews = function (res) {
    $http.get(website + "opt=update&id=" + id + "&title=" + res.title + "&content=" + res.content)
    .then(function (status){
      alert(status.data.ok)
      $location.path( "/list" );
    });
  }
});
