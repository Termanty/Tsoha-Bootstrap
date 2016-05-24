<?php

  $routes->get('/', function() {
    TopicsController::index();
  });

  $routes->get('/topics/1', function() {
    TopicsController::topic();
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

  $routes->get('/tags', function() {
    TagsController::tags();
  });

