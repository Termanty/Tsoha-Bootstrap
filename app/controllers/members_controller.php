<?php

  require 'app/models/member.php';
  class MembersController extends BaseController{
    
    public static function members(){
      $members = Member::all();
      View::make('members.html', array('members' => $members));
    }

    public static function signup(){
      View::make('signup.html');
    }

    public static function login(){
      View::make('login.html');
    }
  }
