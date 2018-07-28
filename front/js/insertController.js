app.controller('insertController',function($scope,$http,$location){

    $scope.insertNews = function (res) {
      $http.get(website + "opt=insert&title=" + res.title + "&content=" + res.content)
      .then(function (status){
        alert(status.data.ok)
        //console.log(status.data.ok)
        $location.path( "/list" );
      });
    }
  })
