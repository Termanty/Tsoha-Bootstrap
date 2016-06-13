<?php

  class MembersController extends BaseController{
    
    public static function members(){
      $members = Member::all();
      View::make('members/index.html', array('members' => $members));
    }

    public static function member($id){
      $member = Member::find($id);
      View::make('members/show.html', array('member' => $member));
    }

    public static function new_member(){
      $params = $_POST;
      $member = new Member(array(
        'username' => $params['username'],
        'password' => $params['password']
      ));
      $errors = $member->errors();
      if(count($errors) > 0){
        View::make('members/signup.html', array('errors' => $errors));
      }
      $member->save();
      Redirect::to('/members/' . $member->id, array(
        'alert_message' => 'Well come to Juttupaikka'));
    }
    
    public static function edit($id){
      $params = $_POST;
      $member = new Member(array(
        'id' => $id,
        'username' => $params['username'],
        'password' => $params['password']
      ));
      $errors = $member->errors();
      if(count($errors) > 0){
        $member = Member::find($id);
        View::make('members/show.html', array(
          'member' => $member,
          'errors' => $errors));
      }
      $member->edit();
      $member = Member::find($id);
      Redirect::to('/members/' . $id, array(
        'member' => $member,
        'alert_message' => 'Edit successfull'));
    }

    public static function destroy($id){
      $member = new Member(array('id' => $id));
      $member->delete();
      unset($_SESSION['user']);
      Redirect::to('/', array('alert_message' => 'You are so dead'));
    }

    public static function signup(){
      View::make('members/signup.html');
    }

    public static function login(){
      View::make('members/login.html');
    }

    public static function handle_login(){
      $params = $_POST;
      $member = Member::authenticate($params['username'], $params['password']);

      if(!$member){
        View::make('members/login.html', array(
          'errors' => array('Wrong username or password')));
      }else{
        $_SESSION['user'] = $member->id;
        Redirect::to('/', array(
          'alert_message' => 'Wellcome back ' . $member->username . '!'));
      }
    }

    public static function logout(){
      $user = self::fetch_current_user();
      if($user){
        unset($_SESSION['user']);
        Redirect::to('/', array(
          'alert_message' => 'Bye bye ' . $user->username . '!'));
      }
      View::make('/');
    }
  }
