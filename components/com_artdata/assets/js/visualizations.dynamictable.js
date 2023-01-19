/**
 * @version     2.2.9
 * @package     com_artdata
 * @copyright   Copyright (C) 2016. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Mike Hill <info@artetics.com> - http://artetics.com
 */

//Searching and Sorting Table with AngularJS
var ArtDataTable = angular.module('ArtDataTable', ['ngSanitize']);

ArtDataTable.service('filteredListService', function () {

    this.searched = function (valLists, toSearch, artDataId) {

        //console.log(artDataId)

        return _.filter(valLists,

        function (i) {
            /* Search Text in all 3 fields */
            //return searchUtil(i, toSearch);
            var searchFunctionToRun = 'searchUtil'+artDataId;
            //console.log(searchFunctionToRun)
            return window[searchFunctionToRun](i,toSearch);
        });
    };

    this.paged = function (valLists, pageSize) {

        //console.log(valLists)

        retVal = [];
        for (var i = 0; i < valLists.length; i++) {
            if (i % pageSize === 0) {
                retVal[Math.floor(i / pageSize)] = [valLists[i]];
            } else {
                retVal[Math.floor(i / pageSize)].push(valLists[i]);
            }
        }
        return retVal;
    };

    
});

ArtDataTable.directive('convertToNumber', function() {
  return {
    require: 'ngModel',
    link: function(scope, element, attrs, ngModel) {
      ngModel.$parsers.push(function(val) {
        return val ? parseInt(val, 10) : null;
      });
      ngModel.$formatters.push(function(val) {
        return val ? '' + val : null;
      });
    }
  };
});

/*ArtDataTable.directive('paginationRepeatFinished', [function () {
    return {
        scope: {
          currentPage: '=currentPage'
        },
        link: function (scope, element, attrs) {

            console.log(scope.currentPage)

        }
    };
}]) */


//pagination-repeat-finished directive - do something after pagination loads
ArtDataTable.directive('paginationRepeatFinished', function() {
  return function(scope, element, attrs) {

    //if (scope.$last){
      //window.alert("im the last!");
    //}

    //angular.element(element)

    //console.log(jQuery(element))

    var ul = jQuery(element).parent();
    var lis = ul.children();

    //console.log(lis)

    //console.log( scope.$eval(attrs.paginationRange) )

    var currentRange = scope.$eval(attrs.paginationRange);
    var index = currentRange.indexOf(scope.currentPage+1);
    //console.log(li.text())

    /*var paginationPageNumber = parseInt(li.text()) - 1;

    //console.log(paginationPageNumber)

    if (scope.currentPage == paginationPageNumber) {
        li.removeAttr('class'); //remove the class
        li.attr('class','art-data-active'); //set the active class on the li that was clicked
    } else {
        li.removeAttr('class'); //remove the class
    }*/

    //console.log(scope.currentPage)
    //console.log(angular.element(element))

  };
}); 

//Inject Custom Service and Global service $filter. This is one way of specifying dependency Injection
var ArtDataTableCtrl = ArtDataTable.controller('ArtDataTableCtrl',function ($scope,$filter,filteredListService,DynamicTableConfig) {

    //put needed visualization specific data into $scope
    $scope.artDataId = DynamicTableConfig.artdataid; //set artdataid in $scope
    $scope.VisualizationItem = DynamicTableConfig.item; //set the visualization item in scope

    //set pageSize equal to the value set by administrator for visualization or use 10 if set to zero somehow
    $scope.pageSize = (parseInt($scope.VisualizationItem.pagination_limit) > 0) ? parseInt($scope.VisualizationItem.pagination_limit) : 10 ;
    $scope.allItems = DynamicTableConfig.table_data;

    //console.log(window.ArtDataData)
    $scope.filteredList = $scope.allItems;
    $scope.reverse = false;
    $scope.currentPage = 0;

    $scope.search = function () {
        $scope.filteredList = filteredListService.searched($scope.allItems, $scope.searchText, $scope.artDataId);

        if ($scope.searchText == '') {
            $scope.filteredList = $scope.allItems;
        }
  
        $scope.pagination();
        $scope.setPaginationRange(); //set the pagination range based upon amount of pagination pages 
    }

    // Calculate Total Number of Pages based on Search Result
    $scope.pagination = function () {
        $scope.ItemsByPage = filteredListService.paged($scope.filteredList, $scope.pageSize);
    };

    $scope.setPage = function ($event) {
        $scope.currentPage = this.n;

        if ($event) {
            var clickedLi = angular.element($event.currentTarget).parent(); // get li that was clicked
            var ul = clickedLi.parent(); //get the ul thats the parent of this list

            //console.log(ul)
            var lis = ul.children();
            lis.each(function(idx,li) { //iterate through ul removing any active classnames
                jQuery(li).removeAttr('class'); //remove the class
            });
            clickedLi.attr('class','art-data-active'); //set the active class on the li that was clicked
            
            if ($scope.currentPage > 0) {
                //show the previous buttons
                jQuery(lis[0]).removeAttr('style'); 
                jQuery(lis[1]).removeAttr('style'); 
            }


        }
    };

    $scope.firstPage = function ($event) {
        $scope.currentPage = 0;

        $scope.setPaginationRange();

        if ($event) {
            var clickedLi = angular.element($event.currentTarget).parent(); // get li that was clicked
            var ul = clickedLi.parent(); //get the ul thats the parent of this list

            

            var lis = ul.children();

            //console.log(lis)

            var index = 2;
            //console.log(index)

            $scope.setActivePagination(index,lis);

            //hide the previous buttons
            jQuery(lis[0]).removeAttr('style'); 
            jQuery(lis[0]).attr('style','display:none !important;'); 
            jQuery(lis[1]).removeAttr('style'); 
            jQuery(lis[1]).attr('style','display:none !important;'); 

            //hide the separator
            jQuery(lis[3]).removeAttr('style'); 
            jQuery(lis[3]).attr('style','display:none !important;'); 
        }
    };

    $scope.lastPage = function ($event) {
        $scope.currentPage = $scope.ItemsByPage.length - 1;

        if ($scope.currentPage > 9) {
            var lastPage = $scope.ItemsByPage.length;
            var input = ($scope.currentPage - 4);
            var total = ($scope.currentPage + 4);

            total = (total > lastPage) ? lastPage : total ;

            $scope.paginationRange = $scope.range(input,total);
        }


        //modify pagination items layout
        if ($event) {
            var clickedLi = angular.element($event.currentTarget).parent(); // get li that was clicked
            

            //wait 1/10 sec before manipulating dom
            setTimeout(function(){ 


                var ul = clickedLi.parent(); //get the ul thats the parent of this list
                var lis = ul.children();

                //remove any active classes in preparation for a new active item
                lis.each(function(idx,li) { //iterate through ul removing any active classnames
                    jQuery(li).removeAttr('class'); //remove the class
                });
                
                //show the previous buttons (if we're going forward we must be able to go back)
                jQuery(lis[0]).css('display','inline-block'); //prev prev (firstpage) button
                jQuery(lis[1]).css('display','inline-block'); //prev button
                
                jQuery(lis[lastPage-2]).css('display','none !important'); //lastpage button
                jQuery(lis[lastPage-1]).css('display','none !important'); //next button

                //console.log($scope.currentPage)
                //show and hide the separator 
                //between paginationRange items and item #1
                if ($scope.currentPage > 9) {
                    jQuery(lis[3]).removeAttr('style'); 
                    //set the active class on the li that was clicked
                    //the active item is always the eigth one when currentpage > 9
                    //console.log(lis[8])
                    jQuery(lis[8]).attr('class','art-data-active');

                } else {
                    jQuery(lis[3]).removeAttr('style'); 
                    jQuery(lis[3]).attr('style','display:none !important;'); 

                    //set the active class on the li that was clicked
                    jQuery(lis[$scope.currentPage+3]).attr('class','art-data-active');
                }



            }, 100);


        }


    };

    $scope.nextPage = function ($event) {

        //set the currentPage
        var lastPage = $scope.ItemsByPage.length;
        if (lastPage == $scope.currentPage) { //last page
            //I can't pull over-- Sir, I'm already pulled over! He's already pulled over! He can't pull over any farther!
            
            //hide next and last page buttons when we get to the end
            if ($event) {
                var clickedLi = angular.element($event.currentTarget).parent(); // get li that was clicked
                var ul = clickedLi.parent(); //get the ul thats the parent of this list
                var lis = ul.children();

                //console.log(lis[lastPage-2])
                //console.log(lis[lastPage-1])

                jQuery(lis[lastPage-2]).css('display','none !important'); //prev prev (firstpage) button
                jQuery(lis[lastPage-1]).css('display','none !important'); //prev button
            }    

            /*TODO disable both next buttons when we're on the last page*/
            return;

        } else { //this isn't the last page
            //keep going
             $scope.currentPage = $scope.currentPage + 1;
        }

        //set the paginationRange
        if ($scope.currentPage > 9) {
            var input = ($scope.currentPage - 4);
            var total = ($scope.currentPage + 4);
            total = (total > lastPage) ? lastPage : total ;
            $scope.paginationRange = $scope.range(input,total);
        } else {

            if ($scope.ItemsByPage.length > 9) {
                $scope.paginationRange = $scope.range(10);
            } else {
                $scope.paginationRange = $scope.range($scope.ItemsByPage.length);
            }
            //$scope.paginationRange = $scope.range($scope.ItemsByPage.length);
            //$scope.paginationRange = $scope.range(10);
        }

        //modify pagination items layout
        if ($event) {
            var clickedLi = angular.element($event.currentTarget).parent(); // get li that was clicked
            
            //wait 1/10 sec before manipulating dom
            setTimeout(function(){ 

                var ul = clickedLi.parent(); //get the ul thats the parent of this list
                var lis = ul.children();

                //remove any active classes in preparation for a new active item
                lis.each(function(idx,li) { //iterate through ul removing any active classnames
                    jQuery(li).removeAttr('class'); //remove the class
                });
                
                //show the previous buttons (if we're going forward we must be able to go back)
                jQuery(lis[0]).css('display','inline-block'); //prev prev (firstpage) button
                jQuery(lis[1]).css('display','inline-block'); //prev button
                
                //console.log($scope.currentPage)
                //show and hide the separator 
                //between paginationRange items and item #1
                if ($scope.currentPage > 9) {
                    jQuery(lis[3]).removeAttr('style'); 

                    //set the active class on the li that was clicked
                    //the active item is always the eigth one when currentpage > 9
                    //console.log(lis[8])
                    jQuery(lis[8]).attr('class','art-data-active');
                } else {
                    jQuery(lis[3]).removeAttr('style'); 
                    jQuery(lis[3]).attr('style','display:none !important;'); 

                    //set the active class on the li that was clicked
                    jQuery(lis[$scope.currentPage+3]).attr('class','art-data-active');
                }

            }, 100);
        }



        /*if ($event) {
            var clickedLi = angular.element($event.currentTarget).parent(); // get li that was clicked
            var ul = clickedLi.parent(); //get the ul thats the parent of this list

            //console.log(ul)

            var index = $scope.currentPage + 2;
            console.log(index)
            var lis = ul.children();

            $scope.setActivePagination(index,lis);
        }*/

    };

    $scope.prevPage = function ($event) {

        //set the currentPage
        if ($scope.currentPage == 0) { //first page
            //I can't pull over-- Sir, I'm already pulled over! He's already pulled over! He can't pull over any farther!
            /*TODO disable both previous buttons when we're on the first page*/

            if ($event) {
                var clickedLi = angular.element($event.currentTarget).parent(); // get li that was clicked

                var ul = clickedLi.parent(); //get the ul thats the parent of this list
                var lis = ul.children();

                jQuery(lis[0]).css('display','none !important'); //prev prev (firstpage) button
                jQuery(lis[1]).css('display','none !important'); //prev button
            
                jQuery(lis[3]).removeAttr('style'); 
                jQuery(lis[3]).attr('style','display:none !important;'); 

                //remove any active classes in preparation for a new active item
                lis.each(function(idx,li) { //iterate through ul removing any active classnames
                    jQuery(li).removeAttr('class'); //remove the class
                });
                //set the active class on the li that was clicked
                jQuery(lis[$scope.currentPage+2]).attr('class','art-data-active');


            }    

            //console.log(lis)

            return;

            //I can't pull over-- Sir, I'm already pulled over! He's already pulled over! He can't pull over any farther!
        } else { //this isn't the first page
            //keep going
             $scope.currentPage = $scope.currentPage - 1;

             //show the previous buttons because we're not on the first page
            if ($event) {

                var clickedLi = angular.element($event.currentTarget).parent(); // get li that was clicked
                
                //wait 1/10 sec before manipulating dom
                setTimeout(function(){ 

                    var ul = clickedLi.parent(); //get the ul thats the parent of this list
                    var lis = ul.children();

                    //remove any active classes in preparation for a new active item
                    lis.each(function(idx,li) { //iterate through ul removing any active classnames
                        jQuery(li).removeAttr('class'); //remove the class
                    });
                    
                    //show the previous buttons (if we're going forward we must be able to go back)
                    jQuery(lis[0]).css('display','inline-block'); //prev prev (firstpage) button
                    jQuery(lis[1]).css('display','inline-block'); //prev button
                    
                    //console.log($scope.currentPage)
                    //show and hide the separator 
                    //between paginationRange items and item #1
                    if ($scope.currentPage > 9) {
                        jQuery(lis[3]).removeAttr('style'); 

                        //set the active class on the li that was clicked
                        //the active item is always the eigth one when currentpage > 9
                        //console.log(lis[8])
                        jQuery(lis[8]).attr('class','art-data-active');
                    } else {
                        jQuery(lis[3]).removeAttr('style'); 
                        jQuery(lis[3]).attr('style','display:none !important;'); 

                        //set the active class on the li that was clicked
                        if ($scope.currentPage == 0) {
                            jQuery(lis[$scope.currentPage+2]).attr('class','art-data-active');
                        } else {
                            jQuery(lis[$scope.currentPage+3]).attr('class','art-data-active');
                        }

                        
                        
                    }

                }, 100);

            
            }    

        }

        var lastPage = $scope.ItemsByPage.length;
        //set the paginationRange
        if ($scope.currentPage > 9) {
            var input = ($scope.currentPage - 4);
            var total = ($scope.currentPage + 4);
            total = (total > lastPage) ? lastPage : total ;
            $scope.paginationRange = $scope.range(input,total);
        } else {

            if ($scope.ItemsByPage.length > 9) {
                $scope.paginationRange = $scope.range(10);
            } else {
                $scope.paginationRange = $scope.range($scope.ItemsByPage.length);
            }
            
            //$scope.ItemsByPage.length
            //$scope.paginationRange = $scope.range(10);
        }




        /*if ($event) {
            var clickedLi = angular.element($event.currentTarget).parent(); // get li that was clicked
            var ul = clickedLi.parent(); //get the ul thats the parent of this list

            //console.log(ul)

            var lis = ul.children();
            var index = $scope.currentPage + 2;
            console.log(index)

            $scope.setActivePagination(index,lis);
        }*/

    };

    $scope.setActivePagination = function (index, lis) {
        lis.each(function(idx,li) { //iterate through ul removing any active classnames
            if (idx == index) {
                jQuery(li).removeAttr('class'); //remove the class
                jQuery(li).attr('class','art-data-active'); //set the active class on the li that was clicked
            } else {
                jQuery(li).removeAttr('class'); //remove the class
            }
        });
    };

    $scope.changeLimit = function (value) {
        $scope.pageSize = value;
        $scope.ItemsByPage = filteredListService.paged($scope.filteredList, $scope.pageSize);
                $scope.setPaginationRange(); //set the pagination range based upon amount of pagination pages  
        $scope.firstPage();
    }

    $scope.range = function (input, total) {
        var ret = [];
        if (!total) {
            total = input;
            input = 0;
        }
        for (var i = input; i < total; i++) {
            if (i != 0) { // && i != total - 1
                ret.push(i);
            }
        }
        return ret;
    };

    $scope.setDefaultLimit = function() {
        $scope.pageSize = (parseInt($scope.VisualizationItem.pagination_limit) > 0) ? parseInt($scope.VisualizationItem.pagination_limit) : 10 ;
    };

    $scope.sort = function (sortBy) {

        $scope.columnToOrder = sortBy;

        //$Filter - Standard Service
        $scope.filteredList = $filter('orderBy')($scope.filteredList, $scope.columnToOrder, $scope.reverse);

        //TODO adding icons to the sort table headers
        //rewrite this and get it into view.html.php to be constructed by php based on given column headers and inserted into document head
        /**if ($scope.reverse) iconName = 'glyphicon glyphicon-chevron-up';
        else iconName = 'glyphicon glyphicon-chevron-down';

        if (sortBy === 'EmpId') {
            $scope.Header[0] = iconName;
        } else if (sortBy === 'name') {
            $scope.Header[1] = iconName;
        } else {
            $scope.Header[2] = iconName;
        } */

        $scope.reverse = !$scope.reverse;

        $scope.pagination();
    };

    $scope.setPaginationRange = function () {
        if ($scope.ItemsByPage.length > 9) {
            $scope.paginationRange = $scope.range(10);
        } else {
            $scope.paginationRange = $scope.range($scope.ItemsByPage.length);
        }
    };

    $scope.setDefaultLimit(); //set default limit
    $scope.sort(window.ArtDataFirstColumn); //default sort to first column of data set

    $scope.firstPage(); //show the first page

});

//when the dom is ready
document.addEventListener("DOMContentLoaded", function(event) { 

    //loop over instances of dynamic table and bootstrap the angular module to each one
    var ArtDataTableApps = document.getElementsByClassName("art-data-dynamic-table-app");
    //console.log(ArtDataTableApps)
    for (var i=0;i<ArtDataTableApps.length;i++) {

        var ArtDataId = jQuery(ArtDataTableApps[i]).data( "artdataid" );
        var config = {table_data:window['ArtDataData'+ArtDataId],artdataid:ArtDataId,item:window['ArtDataItem'+ArtDataId]};
        angular.module('ArtDataConfig',[]).value('DynamicTableConfig',config);

        angular.bootstrap(ArtDataTableApps[i],['ArtDataTable','ArtDataConfig']);

    }

});




