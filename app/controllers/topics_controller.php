<?php

  class TopicsController extends BaseController{

    public static function index(){
      $topics = Topic::all(); 
   	  View::make('topics/index.html', array('topics' => $topics));
    }

    public static function topic($id){
      $topic = Topic::find($id);
      $messages = Message::findMessagesForTopic($id);
      $tags = Category::tagsNotUsedForTopic($id);
      View::make('topics/show.html', array(
        'topic' => $topic,
        'messages' => $messages,
        'tags' => $tags));
    }

    public static function new_topic(){
      $params = $_POST;
      $user = self::fetch_current_user();
      $topic = new Topic(array(
        'user_id' => $user->id,
        'title' => $params['title']
      ));
      $message = new Message(array(
        'topic_id' => $topic->id,
        'user_id' => $user->id,
        'content' => $params['message'] 
      ));
      $errors = array_merge($topic->errors(), $message->errors());
      if(count($errors) > 0){
        $topics = Topic::all(); 
        View::make('/topics/index.html', array(
          'errors' => $errors, 'topics' => $topics));
      }
      $topic->save();
      $message->save();
      Redirect::to('/topics/'. $topic->id, array('alert_message' => 'new topic'));
    }
  }
