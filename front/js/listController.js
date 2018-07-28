app.controller('listController',function($scope,$http,$route,$rootScope){

    $http.get( website + "opt=list")
    .then(function (response){
      //console.log(response.data.ok);
      $rootScope.list = response.data.results;
      $scope.rowCount = response.data.rowCount;
    });


    $scope.tcheck = function () {
        for (i = 0; i <= $scope.list.length -1; i ++){
          $scope.list[i].Selected = $scope.checkAll;
        }
    };

    $scope.selectOne = function(){
        $scope.checkAll = true;
        for (var i = 0; i < $scope.list.length; i++) {
            if (!$scope.list[i].Selected) {
              // console.log($scope.list[i]);
                $scope.checkAll = false;
                break;
            }
        };
    };

    $scope.selectOne = function () {
        $scope.checkAll = true;
        for (var i = 0 ; i < $scope.list.length ; i++){
          if(!$scope.list[i].Selected) {
            $scope.checkAll = false;
            break;
          }
        }
      }

      $scope.delete = function(){
          id = [];
          for (var i = 0; i < $scope.list.length; i++) {
              if ($scope.list[i].Selected) {
                  id.push($scope.list[i].id);
              }
          }
          //console.log(id);
          $http.get(website + "opt=delete&ids=" + id)
          .then(function(status){
            alert(status.data.ok);
            $route.reload();
            });
      }

  }).directive("divCoustom", function() {
      return {
          template : "<div>Total : {{rowCount}}</div>"
      };
  })
