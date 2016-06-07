<?php

  require 'app/models/topic.php';
  require 'app/models/message.php';
  class TopicsController extends BaseController{

    public static function index(){
      $topics = Topic::all(); 
   	  View::make('topics/index.html', array('topics' => $topics));
    }

    public static function topic($id){
      $topic = Topic::find($id);
      $messages = Message::findMessagesForTopic($id);
   	  View::make('topics/show.html', array('topic' => $topic, 'messages' => $messages));
    }

    public static function new_topic(){
      $params = $_POST;
      $topic = new Topic(array(
        'user_id' => 4,
        'title' => $params['title']
      ));
      $topic->save();
      $message = new Message(array(
        'topic_id' => $topic->id,
        'user_id' => 4,
        'content' => $params['message'] 
      ));
      $message->save();
      Redirect::to('/topics/'. $topic->id, array('alert_message' => 'new topic'));
    }

  }
