<?php

  class Category extends BaseModel{

    public $id, $name, $description, $refCount;

    public function __construct($attributes){
      parent::__construct($attributes);
      $this->validators = array('validate_name', 'validate_description');
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
    
    public static function tagsNotUsedForTopic($topic_id){
      $query = DB::connection()->prepare('
        SELECT * FROM Category
        EXCEPT
        SELECT c.id, name, description FROM Category c, Tag t
          WHERE c.id = t.category_id and t.topic_id = :id');
      $query->execute(array('id' => $topic_id));
      $rows = $query->fetchAll();
      $categories = array();
      foreach($rows as $row){
        $categories[] = Category::getCategory($row);
      }
      return $categories;
    }

    public static function find($id){
      $query = DB::connection()->prepare('
        SELECT * FROM Category WHERE id = :id LIMIT 1');
      $query->execute(array('id' => $id));
      $row = $query->fetch();
      if(is_null($row)) return null;
      return Category::getCategory($row);
    }      

    public static function findByName($name){
      $query = DB::connection()->prepare('
        SELECT * FROM Category WHERE name = :name LIMIT 1');
      $query->execute(array('name' => $name));
      $row = $query->fetch();
      if(is_null($row)) return null;
      return Category::getCategory($row);
    }      

    public function save(){
      $query = DB::connection()->prepare('
        INSERT INTO
        Category (name, description) 
        VALUES (:name, :description)
        returning *');     
      $query->execute(array(
        'name' => $this->name,
        'description' => $this->description));
      $row = $query->fetch();
      $this->id = $row['id'];
    }

    public function delete(){
      $query = DB::connection()->prepare('
        DELETE FROM Category WHERE id = :id');
      $query->execute(array('id' => $this->id));
    }
         
    private static function getCategory($row){
      $count = Tag::getNumberOfRefs($row['id']);
      return new Category(array(
        'id' => $row['id'],
        'name' => $row['name'],
        'description' => $row['description'],
        'refCount' => $count
      ));
    }

    public function validate_name(){
      $errors = array();
      if($this->name == '' || $this->name == null){
        $errors[] = "Name can't be empty.";
      }
      if(strlen($this->name) > 20){
        $errors[] = "Name can't be over 20 characters long.";
      }
      return $errors;
    }
    
    public function validate_description(){
      $errors = array();
      if($this->description == '' || $this->description == null){
        $errors[] = "Description can't be empty.";
      }
      if(strlen($this->description) > 150){
        $errors[] = "Description can't be over 150 characters long.";
      }
      return $errors;
    }
  }

