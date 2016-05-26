<?php

  class Member extends BaseModel{

    public $id, $username, $password, $joined;

    public function __construct($attributes){
      parent::__construct($attributes);
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

    public static function getMember($row){
      return new Member(array( 
        'id' => $row['id'],
        'username' => $row['username'],
        'password' => $row['password'],
        'joined' => $row['joined']
      ));
    }
  }


