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
