<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html>

<head>
	<title>CI3 Angular JS</title>
	<style>
		.loading-spinner {
			text-align: center;
			margin: 20px;
		}
	</style>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.8.2/angular.min.js"></script>
</head>

<body>
	<div ng-app="myApp" ng-controller="myCtrl">
		<div class="container">
			<div class="loading-spinner" ng-show="loading">
				<div class="spinner">Loading</div>
			</div>
			<table class="table table-striped" ng-show="!loading">
				<thead>
					<tr>
						<th>ID</th>
						<th>Name</th>
						<th>Created At</th>
					</tr>
				</thead>
				<tbody>
					<tr ng-repeat="item in data">
						<td>{{ item.id }}</td>
						<td>{{ item.name }}</td>
						<td>{{ item.created_at}}</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>

	<script>
		var app = angular.module('myApp', []);
		app.controller('myCtrl', function($scope, $http, $timeout) {
			$scope.loading = true;
			$timeout(function() {
				$http.get('/api/category')
					.then(function(response) {
						$scope.data = response.data;
						$scope.loading = false;
					});
			}, 1000);
		});
	</script>
</body>

</html>