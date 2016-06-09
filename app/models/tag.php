<?php

class Tag extends BaseModel{

    public $id, $topic_id, $category_id, $name;

    public function __construct($attributes){
      parent::__construct($attributes);
    }

    public static function fetchTags($topic_id){
      $query = DB::connection()->prepare('SELECT * FROM Tag WHERE topic_id = :id');
      $query->execute(array('id' => $topic_id));
      $rows = $query->fetchAll();
      $tags = array();
      foreach($rows as $row){
          $tags[] =  Tag::getTag($row);
      }
      return $tags;
    }

    private static function getTag($row){
      $category = Category::find($row['category_id']);
      return new Tag(array(
        'id' => $row['id'],
        'topic_id' => $row['topic_id'],
        'name' => $category->name,
        'category_id' => $row['category_id']
      ));
    }
}
