<?php

  class MessagesController extends BaseController{

    public static function reply($id){
      $user = self::fetch_current_user();
      $params = $_POST;
      $message = new Message(array(
        'topic_id' => $id,
        'user_id' => $user->id,
        'content' => $params['message'] 
      ));
      $errors = $message->errors();
      if(count($errors) > 0){
        $topic = Topic::find($id);
        $messages = Message::findMessagesForTopic($id);
        View::make('/topics/show.html', array(
          'errors' => $errors, 'topic' => $topic, 'messages' => $messages));
      }
      $message->save();
      Redirect::to('/topics/' . $id, array('alert_message' => 'new reply'));
    }

    public static function destroy($id){
      $message = Message::find($id);
      $message->delete();
      Redirect::to('/topics/'.$message->topic_id, array('alert_message' => 'Message removed'));
    }
  }
