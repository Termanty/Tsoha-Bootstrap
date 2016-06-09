<?php

  class CategoriesController extends BaseController{

    public static function categories(){
      $categories = Category::all();
      Kint::dump($categories);
      View::make('categories/index.html', array('categories' => $categories));
    }

    public static function new_category(){
      $params = $_POST;
      $category = new Category(array(
        'name' => $params['name'],
        'description' => $params['description']));
      $errors = $category->errors();
      if(count($errors) > 0){
        $categories = Category::all();
        View::make('/categories/index.html', array(
          'errors' => $errors, 'categories' => $categories)); 
      }
      $category->save();
      Redirect::to('/categories', array('alert_message' => 'New category created.'));
    }
  }
