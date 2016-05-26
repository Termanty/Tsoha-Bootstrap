<?php

  class Category extends BaseModel{

    public $id, $name, $description;

    public function __construct($attributes){
      parent::__construct($attributes);
    }

    public static function all(){
      $query = DB::connection()->prepare('SELECT * FROM Category');
      $query->execute();
      $rows = $query->fetchAll();
      $categories = array();
      foreach($rows as $row){
          $categories[] = Category::getCategory($row);
      }
      return $categories;
    }

    private static function getCategory($row){
      return new Category(array(
        'id' => $row['id'],
        'name' => $row['name'],
        'description' => $row['description'],
      ));
    }
  }

