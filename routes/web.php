<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix' => 'api'], function () use ($router) {
    $router->post('login/','AuthenticateController@authenticate');
    
    $router->group(['middleware' => 'auth'], function() use ($router) {
        
        //MATERIAL
        $router->group(['namespace' => 'Material','prefix' => 'material'], function () use ($router) {
            $router->post('store/','MaterialController@store');
            $router->post('update/','MaterialController@update');
            $router->post('delete/','MaterialController@delete');
            $router->post('one/','MaterialController@one');  
            
            $router->group(['prefix' => 'mine'], function () use ($router) {     
                $router->post('store/','MyMaterialController@store');  
                $router->post('update/','MyMaterialController@update'); 
                $router->post('delete/','MyMaterialController@delete'); 
                $router->post('one/','MyMaterialController@one'); 
                $router->post('enable/','MyMaterialController@enable'); 
            }); 

            $router->group(['prefix' => 'list'], function () use ($router) {     
                $router->post('show/','ListMaterialController@show');
                $router->post('show-only-trashed/','ListMaterialController@showOnlyTrashed');
                $router->post('show-all/','ListMaterialController@showAll');
                $router->post('show-by-state-step/','ListMaterialController@showByStateStep');
                $router->post('by-name-and-state-step/','ListMaterialController@showByNameAndStateStep');
                $router->post('by-category-state-step/','ListMaterialController@showByCategoryAndStateStep');
                $router->post('by-career-state-step/','ListMaterialController@showByCareerAndStateStep');
                $router->post('by-faculty-state-step/','ListMaterialController@showByFacultyAndStateStep');
                
                $router->group(['prefix' => 'mine'], function () use ($router) {
                    $router->post('show/','ListMyMaterialController@show');
                    $router->post('show-by-state-step/','ListMyMaterialController@showByStateStep');        
                });   
            });  

        });

        //FACULTY
        $router->group(['namespace' => 'Faculty','prefix' => 'faculty'], function () use ($router) {
            $router->post('store/','FacultyController@store');
            $router->post('update/','FacultyController@update');
            $router->post('delete/','FacultyController@delete');
            $router->post('one/','FacultyController@one'); 
            
            $router->group(['prefix' => 'list'], function () use ($router) {     
                $router->post('show/','ListFacultyController@show');  
                $router->post('show-only-trashed/','ListFacultyController@showOnlyTrashed');  
                $router->post('show-all/','ListFacultyController@showAll');  
            });  
        });  

        //CAREER
        $router->group(['namespace' => 'Career','prefix' => 'career'], function () use ($router) {
            $router->post('store/','CareerController@store');
            $router->post('update/','CareerController@update');
            $router->post('delete/','CareerController@delete');
            $router->post('one/','CareerController@one'); 
            
            $router->group(['prefix' => 'list'], function () use ($router) {     
                $router->post('show/','ListCareerController@all'); 
                $router->post('show-only-trashed/','ListCareerController@showOnlyTrashed');  
                $router->post('show-all/','ListCareerController@showAll');   
            });  
        });  

        //CATEGORY
        $router->group(['namespace' => 'Category','prefix' => 'category'], function () use ($router) {
            $router->post('store/','CategoryController@store');
            $router->post('update/','CategoryController@update');
            $router->post('delete/','CategoryController@delete');
            $router->post('one/','CategoryController@one'); 
            
            $router->group(['prefix' => 'list'], function () use ($router) {     
                $router->post('show/','ListCategoryController@show'); 
                $router->post('show-only-trashed/','ListCategoryController@showOnlyTrashed');  
                $router->post('show-all/','ListCategoryController@showAll');  
            });  
        });  

        //CONDITION
        $router->group(['namespace' => 'Condition','prefix' => 'condition'], function () use ($router) {
            $router->post('store/','ConditionController@store');
            $router->post('update/','ConditionController@update');
            $router->post('delete/','ConditionController@delete');
            $router->post('one/','ConditionController@one'); 
            
            $router->group(['prefix' => 'list'], function () use ($router) {     
                $router->post('show/','ListConditionController@show');  
                $router->post('show-only-trashed/','ListConditionController@showOnlyTrashed');  
                $router->post('show-all/','ListConditionController@showAll');  
            });  
        });  

        //PLACE
        $router->group(['namespace' => 'Place','prefix' => 'place'], function () use ($router) {
            $router->post('store/','PlaceController@store');
            $router->post('update/','PlaceController@update');
            $router->post('delete/','PlaceController@delete');
            $router->post('one/','PlaceController@one'); 
            
            $router->group(['prefix' => 'list'], function () use ($router) {     
                $router->post('show/','ListPlaceController@show'); 
                $router->post('show-only-trashed/','ListPlaceController@showOnlyTrashed');  
                $router->post('show-all/','ListPlaceController@showAll');  
            });  
        });  

        //PERSON
        $router->group(['namespace' => 'Person','prefix' => 'person'], function () use ($router) {
            $router->post('store/','PersonController@store');
            $router->post('update/','PersonController@update');
            $router->post('delete/','PersonController@delete');
            $router->post('one/','PersonController@one'); 

            $router->group(['prefix' => 'mine'], function () use ($router) {   
                $router->post('store/','MyPersonController@store');
                $router->post('update/','MyPersonController@update');
                $router->post('one/','MyPersonController@one');   
            });  
            
            $router->group(['prefix' => 'list'], function () use ($router) {     
                $router->post('show/','ListPersonController@show');  
                $router->post('show-only-trashed/','ListPersonController@showOnlyTrashed');  
                $router->post('show-all/','ListPersonController@showAll'); 
            });  
        });  


        //TYPE
        $router->group(['namespace' => 'Type','prefix' => 'type'], function () use ($router) {
            $router->post('store/','TypeController@store');
            $router->post('update/','TypeController@update');
            $router->post('delete/','TypeController@delete');
            $router->post('one/','TypeController@one'); 
            
            $router->group(['prefix' => 'list'], function () use ($router) {     
                $router->post('show/','ListTypeController@show');  
                $router->post('show-only-trashed/','ListTypeController@showOnlyTrashed');  
                $router->post('show-all/','ListTypeController@showAll'); 
            });  
        });  

        //ORDER
        $router->group(['namespace' => 'Order','prefix' => 'order'], function () use ($router) {
            $router->post('store/','OrderController@store');
            $router->post('update/','OrderController@update');
            $router->post('delete/','OrderController@delete');
            $router->post('one/','OrderController@one');  
            
            $router->group(['prefix' => 'mine'], function () use ($router) {
                $router->post('store/','MyOrderController@store');
                $router->post('delete/','MyOrderController@delete');
                $router->post('one/','MyOrderController@one');  
                $router->post('accept/','MyOrderController@accept');        
            });  

            $router->group(['prefix' => 'list'], function () use ($router) {     
                $router->post('show/','ListOrderController@show');
                $router->post('show-only-trashed/','ListOrderController@showOnlyTrashed');  
                $router->post('show-all/','ListOrderController@showAll'); 
                
                $router->group(['prefix' => 'mine'], function () use ($router) {
                    $router->post('show/','ListMyOrderController@show');
                    $router->post('show-for-my-materials/','ListMyOrderController@showForMyMaterials'); 
                    $router->post('show/','ListMyOrderController@showByAccept');
                    $router->post('show-for-my-materials/','ListMyOrderController@showForMyMaterialsByAccept');        
                });   
            });  

        });

        //TRANSACTION
        $router->group(['namespace' => 'Transaction','prefix' => 'transaction'], function () use ($router) {
            $router->post('store/','TransactionController@store');
            $router->post('update/','TransactionController@update');
            $router->post('delete/','TransactionController@delete');
            $router->post('one/','TransactionController@one');        

            $router->group(['prefix' => 'list'], function () use ($router) {     
                $router->post('show/','ListTransactionController@show');
                $router->post('show-only-trashed/','ListTransactionController@showOnlyTrashed');  
                $router->post('show-all/','ListTransactionController@showAll'); 
                
                $router->group(['prefix' => 'mine'], function () use ($router) {
                    $router->post('show/','ListMyTransactionController@show');
                    $router->post('show-for-my-materials/','ListMyTransactionController@showForMyMaterials');        
                });   
            });  

        });

        //STATE
        $router->group(['namespace' => 'State','prefix' => 'state'], function () use ($router) {
            $router->post('store/','StateController@store');
            $router->post('update/','StateController@update');
            $router->post('delete/','StateController@delete');
            $router->post('one/','StateController@one'); 
            
            $router->group(['prefix' => 'list'], function () use ($router) {     
                $router->post('show/','ListStateController@show');  
                $router->post('show-only-trashed/','ListStateController@showOnlyTrashed');  
                $router->post('show-all/','ListStateController@showAll'); 
            });  
        });  


    });
});
