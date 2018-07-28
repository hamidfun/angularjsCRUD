var website = "http://localhost:8000/crud-sample-angular/back/news.php?";
var app = angular.module('news',['ngRoute']);
app.config(function($routeProvider) {
  $routeProvider
  .when("/post/:id", {
    templateUrl: "Templates/post.html",
    controller:"singlePostController"
  })
  .when("/list",{
    templateUrl:"Templates/list.html",
    controller:"listController"
  })
  .when("/insert",{
    templateUrl:"Templates/insert.html",
    controller:"insertController"
  })
  .when("/update/:id",{
    templateUrl:"Templates/update.html",
    controller:"updateController"
  })
  .otherwise("/list")
})
