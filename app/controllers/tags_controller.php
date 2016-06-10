<?php

  class TagsController extends BaseController{

    public static function new_tag(){
      $params = $_POST;
      $category = Category::findByName($params['name']);
      $tag = new Tag(array(
        'topic_id' => $params['topic_id'],
        'category_id' => $category->id));
      $tag->save();
      Redirect::to('/topics/' . $tag->topic_id, array('
        alert_message' => 'New tag assigned for this topic.'));
    }
    
  }
