<?php

  $routes->get('/', function() {
    TopicsController::index();
  });

  $routes->get('/topics/:id', function($id) {
    TopicsController::topic($id);
  });

  $routes->get('/signup', function() {
    MembersController::signup();
  });

  $routes->get('/login', function() {
    MembersController::login();
  });

  $routes->get('/members', function() {
    MembersController::members();
  });

  $routes->get('/categories', function() {
    CategoriesController::categories();
  });

