<?php

  class Message extends BaseModel{
    
    public $id, $topic_id, $user_id, $username, $content, $published;

    public function __construt($attributes){
      parent::__construct($attributes);
    }

    public static function findMessagesForTopic($topic_id){
      $query = DB::connection()->prepare('SELECT * FROM Message Where topic_id = :topic_id');
      $query->execute(array('topic_id' => $topic_id));
      $rows = $query->fetchAll();
      $messages = array();
      foreach($rows as $row){
        $messages[] = Message::getMessage($row);
      }
      return $messages;
    }

    public function save(){
      $query = DB::connection()->prepare('INSERT INTO 
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

    public static function getMessage($row){
      $member = Member::find($row['user_id']);
      return new Message(array(
          'id' => $row['id'],
          'topic_id' => $row['topic_id'],
          'user_id' => $row['user_id'],
          'username' => $member->username,
          'content' => $row['content'],
          'published' => $row['published']
      ));
    }
  }
