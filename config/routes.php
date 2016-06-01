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

  $routes->get('/members/:id', function($id) {
    MembersController::member($id);
  });

  $routes->post('/members', function(){
    MembersController::new_member();
  });

  $routes->get('/categories', function() {
    CategoriesController::categories();
  });

