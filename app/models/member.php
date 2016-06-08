<?php

  class Member extends BaseModel{

    public $id, $username, $password, $joined;

    public function __construct($attributes){
      parent::__construct($attributes);
      $this->validators = array('validate_username', 'validate_password');
    }
    
    public static function find($id){
      $query = DB::connection()->prepare('SELECT * FROM Member WHERE id = :id LIMIT 1');
      $query->execute(array('id' => $id));
      $row = $query->fetch();
      if($row){
        return Member::getMember($row);
      }
      return null;
    }

    public static function all(){
      $query = DB::connection()->prepare('SELECT * FROM Member');
      $query->execute();
      $rows = $query->fetchAll();
      $members = array();
      foreach($rows as $row){
        $members[] = Member::getMember($row); 
      }
      return $members;
    }

    public function save(){
      $query = DB::connection()->prepare('
        INSERT INTO Member (username, password, joined)
        VALUES (:username, :password, NOW()) RETURNING *');
      $query->execute(array(
        'username' => $this->username,
        'password' => $this->password
      ));
      $row = $query->fetch();
      $this->id = $row['id'];
      $this->joined = $row['joined'];
    }

    public static function authenticate($username, $password) {
      $query = DB::connection()->prepare('
        SELECT * FROM Member 
        WHERE username = :username AND password = :password LIMIT 1');
      $query->execute(array(
        'username' => $username,
        'password' => $password
      ));
      $row = $query->fetch();
      if($row) {
        return Member::getMember($row);
      }
      return null;
    }

    public static function getMember($row){
      return new Member(array( 
        'id' => $row['id'],
        'username' => $row['username'],
        'password' => $row['password'],
        'joined' => $row['joined']
      ));
    }

    public function validate_username(){
      $errors = array();
      if($this->username == '' || $this->username == null){
        $errors[] = "Username can't be empty.";
      }
      if(strlen($this->username) < 3 || strlen($this->username) > 15){
        $errors[] = "Username has to be between 3 and 15 characters long.";
      }
      return $errors;
    }

    public function validate_password(){
      $errors = array();
      if($this->password == '' || $this->password == null){
        $errors[] = "Password can't be empty.";
      }
      if(strlen($this->username) < 8 || strlen($this->password) > 30){
        $errors[] = "Password has to be between 8 and 30 characters long.";
      }
      return $errors;
    }
  }


