<?php

  require 'app/models/member.php';
  class MembersController extends BaseController{
    
    public static function members(){
      $members = Member::all();
      View::make('members.html', array('members' => $members));
    }

    public static function member($id){
      $member = Member::find($id);
      View::make('member.html', array('member' => $member));
    }

    public static function signup(){
      View::make('signup.html');
    }

    public static function new_member(){
      $params = $_POST;
      $member = new Member(array(
        'username' => $params['username'],
        'password' => $params['password']
      ));
      $member->save();
      Redirect::to('/members/' . $member->id, 
        array('alert_message' => 'Well come to Juttupaikka'));
    }

    public static function login(){
      View::make('login.html');
    }
  }
