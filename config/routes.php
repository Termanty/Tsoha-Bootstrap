<?php

  $routes->get('/', function() {
    TopicsController::index();
  });

  $routes->get('/signup', function() {
    MembersController::signup();
  });
