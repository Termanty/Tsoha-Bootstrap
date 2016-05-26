<?php

  require 'app/models/topic.php';
  require 'app/models/message.php';
  class TopicsController extends BaseController{

    public static function index(){
      $topics = Topic::all(); 
   	  View::make('topics.html', array('topics' => $topics));
    }

    public static function topic($id){
      $topic = Topic::find($id);
      $messages = Message::findMessagesForTopic($id);
      Kint::dump($messages);
   	  View::make('topic.html', array('topic' => $topic, 'messages' => $messages));
    }
  }
