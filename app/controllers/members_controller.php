<?php

  class MembersController extends BaseController{

    public static function members(){
      View::make('members.html');
    }

    public static function signup(){
      View::make('signup.html');
    }

    public static function login(){
      View::make('login.html');
    }
  }
