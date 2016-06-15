<?php

  class Message extends BaseModel{
    
    public $id, $topic_id, $user_id, $username, $content, $published, $deleted;

    public function __construct($attributes){
      parent::__construct($attributes);
      $this->validators = array('validate_content');
    }

    public static function find($id){
      $query = DB::connection()->prepare(
        'SELECT * FROM Message WHERE id = :id LIMIT 1');
      $query->execute(array('id' => $id));
      $row = $query->fetch();
      if(is_null($row)) return null;
      return Message::getMessage($row);
    }

    public static function findMessagesForTopic($topic_id){
      $query = DB::connection()->prepare(
        'SELECT * FROM Message Where topic_id = :topic_id');
      $query->execute(array('topic_id' => $topic_id));
      $rows = $query->fetchAll();
      $messages = array();
      foreach($rows as $row){
        $messages[] = Message::getMessage($row);
      }
      return $messages;
    }

    public static function numberOfmsgByUser($user_id){
      $query = DB::connection()->prepare('
        SELECT COUNT(*) FROM Message WHERE user_id = :id');
      $query->execute(array('id' => $user_id));
      $row = $query->fetch();
      return $row['count'];
    }

    public function save(){
      $query = DB::connection()->prepare('
        INSERT INTO 
        Message (topic_id, user_id, content, published) 
        VALUES (:topic_id, :user_id, :content, NOW()) 
        returning *');
      $query->execute(array(
        'topic_id' => $this->topic_id,
        'user_id' => $this->user_id,
        'content' => $this->content
      ));
      $row = $query->fetch();
      $this->id = $row['id'];
      $this->published = $row['published'];
    }

    public function delete(){
      $query = DB::connection()->prepare('
        UPDATE Message SET deleted = true WHERE id = :id');
      $query->execute(array('id' => $this->id));
    }

    public static function getMessage($row){
      $member = Member::find($row['user_id']);
      return new Message(array(
          'id' => $row['id'],
          'topic_id' => $row['topic_id'],
          'user_id' => $row['user_id'],
          'username' => $member->username,
          'content' => $row['content'],
          'published' => $row['published'],
          'deleted' => $row['deleted']
      ));
    }

    public function validate_content(){
      $errors = array();
      if($this->content == '' || $this->content == null){
        $errors[] = "Content can't be empty.";
      }
      return $errors;
    }
  }
