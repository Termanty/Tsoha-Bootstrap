<?php

  $routes->get('/', function() {
    TopicsController::index();
  });

  $routes->get('/topics/:id', function($id) {
    TopicsController::topic($id);
  });

  $routes->post('/topics', function() {
    TopicsController::new_topic();
  });

  $routes->post('/topics/:id', function($id) {
    MessagesController::reply($id);
  });

  $routes->get('/signup', function() {
    MembersController::signup();
  });

  $routes->get('/login', function() {
    MembersController::login();
  });

  $routes->post('/login', function() {
    MembersController::handle_login();
  });

  $routes->get('/logout', function() {
    MembersController::logout();
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
  
  $routes->post('/categories', function() {
    CategoriesController::new_category();
  });

  $routes->post('/tags', function() {
    TagsController::new_tag();
  });
