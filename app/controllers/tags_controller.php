<?php

  class TagsController extends BaseController{

    public static function new_tag(){
      $params = $_POST;
      $category = Category::findByName($params['tagName']);
      $tag = new Tag(array(
        'topic_id' => $params['topic_id'],
        'category_id' => $category->id));
      $tag->save();
      Redirect::to('/topics/' . $tag->topic_id, array(
        'alert_message' => 'New tag assigned for this topic.'));
    }

    public static function destroy($id){
      $topic_id = $_POST['topic_id'];
      $tag = new Tag(array('id' => $id));
      $tag->delete();
     // $topic = Topic::find($topic_id);
     // $messages = Message::findMessagesForTopic($topic_id);
    //  $tags = Category::tagsNotUsedForTopic($topic_id);
      Redirect::to('/topics/'.$topic_id, array(
     //   'topic' => $topic,
     //   'messages' => $messages,
     //   'tags' => $tags,
        'alert_message' => 'Tag removed'));
    }
  }
