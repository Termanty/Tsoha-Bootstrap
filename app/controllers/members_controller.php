<?php

  require 'app/models/member.php';
  class MembersController extends BaseController{
    
    public static function members(){
      $members = Member::all();
      View::make('members/index.html', array('members' => $members));
    }

    public static function member($id){
      $member = Member::find($id);
      View::make('members/show.html', array('member' => $member));
    }

    public static function signup(){
      View::make('members/signup.html');
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
      View::make('members/login.html');
    }
  }
