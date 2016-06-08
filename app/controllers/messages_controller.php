<?php

  require 'app/models/topic.php';
  require 'app/models/message.php';
  class MessagesController extends BaseController{

    public static function reply($id){
      $user = self::fetch_current_user();
      $params = $_POST;
      $message = new Message(array(
        'topic_id' => $id,
        'user_id' => $user->id,
        'content' => $params['message'] 
      ));
      $message->save();
      Redirect::to('/topics/' . $id, array('alert_message' => 'new reply'));
    }
  }
