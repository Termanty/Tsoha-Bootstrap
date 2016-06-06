<?php

  require 'app/models/topic.php';
  require 'app/models/message.php';
  class MessagesController extends BaseController{

    public static function reply($id){
      $params = $_POST;
      $message = new Message(array(
        'topic_id' => $id,
        'user_id' => 5,
        'content' => $params['message'] 
      ));
      Kint::dump($message);
      $message->save();
      Redirect::to('/topics/' . $id, array('alert_message' => 'new reply'));
    }
  }
