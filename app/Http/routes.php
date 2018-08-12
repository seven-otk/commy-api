<?php

/**
 *--------------------------------------------------------------------------
 * Application Routes
 *--------------------------------------------------------------------------
 *
 * Here is where you can register all of the routes for an application.
 * It is a breeze. Simply tell Lumen the URIs it should respond to
 * and give it the Closure to call when that URI is requested.
 *
 * @var $router \Laravel\Lumen\Routing\Router
 */

$router->post('store', 'StoreController@store');

$router->post('authenticate/register', 'AuthenticationController@register');
$router->post('authenticate/login', 'AuthenticationController@login');

// Get user information -> get ~ needs middleware
// Login User -> post

// Register User -> post

// Get all categories -> get
// Create category -> post
// Delete category -> delete ~ assign all other categories to a new one?
// Update Category -> patch

// Get Store -> get
// Add Store -> post ~ middleware for user id
// Update Store -> patch ~ middleware for user id
// Delete Store -> delete ~ middleware for user id

// Get Domain Information ~ Who is? -> get ~ middleware for user id -> store->id
// Update Domain -> patch ~ middleware for user id -> store->id
// Add Domain -> post ~ middleware for user id -> store->id
// Deactivate Domain -> delete ~ middleware for user id -> store->id