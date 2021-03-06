<?php

  class Topic extends BaseModel{

    public $id, $user_id, $username, $title, $published, $tags;

    public function __construct($attributes){
      parent::__construct($attributes);
      $this->validators = array('validate_title');
    }

    public static function find($id){
      $query = DB::connection()->prepare('SELECT * FROM Topic WHERE id = :id LIMIT 1');
      $query->execute(array('id' => $id));
      $row = $query->fetch();
      if($row){
        return Topic::getTopic($row);
      }
      return null;
    }

    public static function all(){
      $query = DB::connection()->prepare('SELECT * FROM Topic');
      $query->execute();
      $rows = $query->fetchAll();
      $topics = array();
      foreach($rows as $row){
          $topics[] = Topic::getTopic($row);
      }
      return $topics;
    }

    public static function numberOfpostByUser($user_id){
      $query = DB::connection()->prepare('
        SELECT COUNT(*) FROM Topic WHERE user_id = :id');
      $query->execute(array('id' => $user_id));
      $row = $query->fetch();
      return $row['count'];
    }

    public function save(){
      $query = DB::connection()->prepare('INSERT INTO 
        Topic (user_id, title, published) 
        VALUES (:user_id, :title, NOW()) 
        returning *');
      $query->execute(array(
        'user_id' => $this->user_id,
        'title' => $this->title,
      ));
      $row = $query->fetch();
      $this->id = $row['id'];
      $this->published = $row['published'];
    }

    private static function getTopic($row){
      $member = Member::find($row['user_id']);
      $tags = Tag::fetchTags($row['id']);
      return new Topic(array(
        'id' => $row['id'],
        'user_id' => $row['user_id'],
        'username' => $member->username,   
        'title' => $row['title'],
        'published' => $row['published'],
        'tags' => $tags
      ));
    }

    public function validate_title(){
      $errors = array();
      if($this->title == '' || $this->title == null){
        $errors[] = "Title can't be empty.";
      }
      if(strlen($this->title) > 100){
        $errors[] = "Title has max length 100 characters.";
      }
      return $errors;
    }
  }
