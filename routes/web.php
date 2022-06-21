<?php
\Debugbar::disable();

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware' => 'no-cache'], function() {

Route::get('/', 'AuthController@index')->name('login');
Route::post('/', 'AuthController@login')->name('post.login');
Route::get('/logout', 'HomeController@logout')->name('logout');

Route::get('/register','RegisterController@register')->name('register');
Route::post('/register','RegisterController@create')->name('post.register');




Route::get('/home', 'HomeController@index')->name('home');


//gestion des utilisateurs

Route::get('/user/create/AZREYDTOYNEWHSTQVSLHX2127','UserController@create')->name('user.create');
Route::post('/user/create/AZREYDTOYNEWHSTQVSLHX2127','UserController@store')->name('user.store');
Route::get('/user/INDEXTArdEYuytrQDV','UserController@index')->name('user.index');
Route::get('/user/deleted/QGJSIreKDIgd','UserController@is_deleted')->name('user.deleted');
Route::get('/user/delete/{id}/REBVieNDEGBSGF','UserController@delete')->name('user.delete');
Route::get('/user/restorer/{id}/QCS=-JMNDY','UserController@restore')->name('user.restore');
Route::get('/user/show/{user}/REGGIFSiybv','UserController@show')->name('user.show');
Route::get('/Profil/EQBSpiuTVXD','UserController@showAuth')->name('user.show.auth');
Route::post('/user/show/{user}/VYSRQNSBUSR','UserController@update')->name('user.update');
Route::get('/user/print/IDWEGSrecOQB','UserController@printUsers')->name('user.print');
Route::get('/user/{id}/print/IESVIQBGrhbvWVHSAS-=MB','UserController@printUsersId')->name('user.print.id');
//gestion citerne
Route::get('/citerne/create/RSNSPQGVSL','CiterneController@create')->name('citerne.create');
Route::post('/citerne/create/RSNSPQGVSL','CiterneController@store')->name('citerne.store');
Route::get('/citerne/INDEXP==RQYDMAIRTENC','CiterneController@index')->name('citerne.index');
Route::get('/citerne/delete/{id}/PQTDSKDNisvbckj','CiterneController@delete')->name('citerne.delete');
Route::post('/search/Citerne/rdsnmsocqRAC','CiterneController@search')->name('citerne.search.post');
Route::get('/Search/Citerne/QPDSBATYidndsrPQRB=NSDIKS','CiterneController@result')->name('citerne.search.result');
Route::get('/citerne/print/PFGDBSDBQPBAudn','CiterneController@printCiterne')->name('citerne.print');
//les operations
Route::get('/operation/create/ODRQPDGSp==tdbs=NRQPNDG','OperationsController@create')->name('operation.create');
Route::post('/operation/create/ODRQPDGSp==tdbs=NRQPNDG','OperationsController@store')->name('operation.store');
Route::get('/operation/PSVQPIUDCFBDOI97d3','ConsommationController@index')->name('consommation.index');
Route::get('/operation/clients/42BVDKSNC7W9NSWSV','ConsommationController@clients')->name('consommation.clients');
Route::get('/operation/Vehicules/TSVQlidsj==HDYWB42','ConsommationController@vehicules')->name('consommation.vehicules');
Route::get('/operation/{id}/PDV==TTQBNDGSATADBDG','ConsommationController@show')->name('operation.show');
Route::get('/consommation/print/L==31539BDFGVAGVD','ConsommationController@printConso')->name('conso.print');
Route::get('/clients/print/PYWERVXNDM','ClientController@printClient')->name('clients.print');
Route::get('/vehicules/print/PYDVMWTNQpgdbsDH','ClientController@printVehicule')->name('vehicules.print');
Route::get('/consommation/{id}/print/PDodbnvhydqEH','ConsommationController@printConsoId')->name('conso.print.id');
Route::get('/consommation/delete/{id}/USNDSPQMZSFFDosn19DEGBSGF','ConsommationController@delete')->name('conso.delete');
Route::get('/consommation/is_delete/UmabrMNAPXFDosn19DEGBSGF','ConsommationController@deleted')->name('conso.deleted');
Route::get('/consommation/restorer/{id}/husQYAHXBPAYRQBZMSOTERVSaqtvx=spsbq','ConsommationController@restore')->name('conso.restore');

//les notifications
Route::get('/notifications/p=1943jtbdsiPQHJEDGBhsyd','NotificationController@index')->name('notifications');
Route::get('/notifications/isRead/pdtyebsYELKWSDHVZMVB','NotificationController@isRead')->name('notifications.isRead');


//les informations sur la journalisation des fichiers)
Route::get('/journaux/ODHATVSXysbsfzmvbxmSD','LogsController@index')->name('logs');
Route::get('/journaux/{id}/pdbdUQMZMCVPUendtq','LogsController@show')->name('logs.show');
Route::post('/journaux/Bons/GQODSHZiatrnmdtuwrmxbcv','LogsController@search')->name('logs.search.post');
Route::get('/journaux/Bons/GQODSHZiatrnmdtuwrmxbcv','LogsController@result')->name('logs.search.result');
Route::get('/logs/print/PSATQBXIBSBCpshdsXC','LogsController@printLog')->name('log.print');

//gestion des bons de carburant
Route::get('/bon/create/qqwuiGAODUETBLAkd','BonsController@create')->name('bon.create');
Route::post('/bon/create/qqwuiGAODUETBLAkd','BonsController@store')->name('bon.store');
Route::get('/Bons/tvdspacODNWLDYSVpqgmvcbczodg','BonsController@index')->name('bons');
Route::post('/search/Bons/uanwfPRQUDTBSmshdcfapq','BonsController@search')->name('bons.search.post');
Route::get('/Search/Bons/pqbFABCIQPTSZMVHDJ','BonsController@result')->name('bons.search.result');
Route::get('/bons/print/P==TQBDOidb=dbbzmdgtacvs','BonsController@printBon')->name('bon.print');
Route::get('/bon/delete/{identifiant}/ueoZRTvPQTDSKDNisvbckj','BonsController@delete')->name('bon.delete');
Route::get('/bons/deleted/QCSAYMjsdd-JMNDYsdsfg','BonsController@deleted')->name('bons.deleted');
Route::get('/bons/used/QCSAYMjsdd-JMNDYsdsfg','BonsController@used')->name('bons.used');
Route::get('/bons/restore/{identifiant}/ApdjstejOPSHZGWNQ','BonsController@restore')->name('bon.restor');
Route::get('/bons/show/{id}/KARAMALERAOidOPSHZGWNQ','BonsController@show')->name('bon.show');
    Route::get('/bon/{id}/print/LARDKQYApnsdhbvWVHSAS-=MB','BonsController@printBonId')->name('bon.print.id');

//gestion des soldest
Route::get('/solde','SoldeController@solde')->name('solde.post');

});