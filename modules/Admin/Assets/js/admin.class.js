var app = angular.module('app', ['datatables'])
        
.constant('API_URL', 'http://localhost:8000/admin/');

app.controller('UserController', function($scope, $http, API_URL, DTOptionsBuilder, DTColumnBuilder) 
{
    //retrieve employees listing from API
   var vm = this;
    vm.dtOptions = DTOptionsBuilder.newOptions()
        .withOption('ajax', {
         // Either you specify the AjaxDataProp here
         // dataSrc: 'data',
         url: API_URL+'users',
         type: 'GET'
     })
     // or here
     .withDataProp('data')
        .withOption('processing', true)
        .withOption('serverSide', true)
        .withPaginationType('full_numbers');

       vm.dtColumns = [
            DTColumnBuilder.newColumn('0'),
            DTColumnBuilder.newColumn('1'),
            DTColumnBuilder.newColumn('2'),
            DTColumnBuilder.newColumn('3'),
            DTColumnBuilder.newColumn('4'),
            DTColumnBuilder.newColumn('5'),
            DTColumnBuilder.newColumn('6')
       ];

    $scope.model = "teste angular";
    
    //show modal form
    $scope.toggle = function(modalstate, id) {
        $scope.modalstate = modalstate;

        switch (modalstate) {
            case 'add':
                $scope.form_title = "Add New Employee";
                break;
            case 'edit':
                $scope.form_title = "Employee Detail";
                $scope.id = id;
                $http.get(API_URL + 'admin/users/' + id + '/edit')
                        .success(function(response) {
                            console.log(response);
                            $scope.employee = response;
                        });
                break;
            default:
                break;
        }
        console.log(id);
        $('#formModal').modal('show');
    }

    //save new record / update existing record
    $scope.save = function(modalstate, id) {
        var url = API_URL + "employees";
        
        //append employee id to the URL if the form is in edit mode
        if (modalstate === 'edit'){
            url += "/" + id;
        }
        
        $http({
            method: 'POST',
            url: url,
            data: $.param($scope.employee),
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        }).success(function(response) {
            console.log(response);
            location.reload();
        }).error(function(response) {
            console.log(response);
            alert('This is embarassing. An error has occured. Please check the log for details');
        });
    }

    //delete record
    $scope.confirmDelete = function(id) {
        var isConfirmDelete = confirm('Are you sure you want this record?');
        if (isConfirmDelete) {
            $http({
                method: 'DELETE',
                url: API_URL + 'employees/' + id
            }).
                    success(function(data) {
                        console.log(data);
                        location.reload();
                    }).
                    error(function(data) {
                        console.log(data);
                        alert('Unable to delete');
                    });
        } else {
            return false;
        }
    }
});

function Admin() {
    var nome;

    this.getNome = function () {
        return nome;
    };

    this.setNome = function (value) {
        nome = value;
    };
}