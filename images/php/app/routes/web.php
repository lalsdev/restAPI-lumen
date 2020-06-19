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

$router->group(['prefix'=>'api/v1'], function() use($router){
    // Find Authors
    $router->get('/authors', ['uses' => 'AuthorController@showAllAuthors']);
    $router->get('/authors/{author_id}', ['uses' => 'AuthorController@showOneAuthor']);
    // Author CRUD
    $router->post('/authors', ['uses' => 'AuthorController@createAuthor']);
    $router->put('/authors/{author_id}', ['uses' => 'AuthorController@updateAuthor']);
    $router->delete('/authors/{author_id}', ['uses' => 'AuthorController@deleteAuthor']);
    $router->post('/authors/{author_id}/books', ['uses' => 'AuthorController@createBook']);
    $router->get('/authors/{author_id}/books', ['uses' => 'AuthorController@showAllBooksFromAuthor']);
    $router->get('/authors/{author_id}/books/{book_id}', ['uses' => 'AuthorController@showOneBook']);
    $router->get('/books', ['uses' => 'AuthorController@showAllBooks']);
    $router->get('/books/{book_id}', ['uses' => 'AuthorController@showOneBooks']);
    $router->get('/authors/{author_id}/books/{book_id}', ['uses' => 'AuthorController@showOneBook']);
    $router->put('/authors/{author_id}/books/{book_id}', ['uses' => 'AuthorController@updateBook']);
    $router->delete('/authors/{author_id}/books/{book_id}', ['uses' => 'AuthorController@deleteBook']);

    // Client CRUD
    $router->post('/clients', ['uses' => 'ClientController@createClient']);
    $router->put('/clients/{client_id}', ['uses' => 'ClientController@updateClient']);
    $router->delete('/clients/{client_id}', ['uses' => 'ClientController@deleteClient']);
    $router->get('/clients', ['uses' => 'ClientController@showAllClients']);
    $router->get('/clients/{client_id}', ['uses' => 'ClientController@showOneClient']);
    
    // Contrat CRUD
    $router->post('clients/{client_id}/contrats', ['uses' => 'ClientController@createContrat']);
    $router->put('/clients/{client_id}/contrats/{contrat_id}', ['uses' => 'ClientController@updateContrat']);
    $router->delete('/clients/{client_id}/contrats/{contrat_id}', ['uses' => 'ClientController@deleteContrat']);
    // Find all contracts linked to one client
    $router->get('/clients/{client_id}/contrats', ['uses' => 'ClientController@showAllContratsFromClient']);
    // Find one contract
    $router->get('/contrats/{contrat_id}', ['uses' => 'ClientController@showOneContrat']);
    // Find all contracts
    $router->get('/contrats', ['uses' => 'ClientController@showAllContrats']);
    // Find one contract specific to one client
    $router->get('/clients/{client_id}/contrats/{contrat_id}', ['uses' => 'ClientController@showOneContratSpecificClient']);


});