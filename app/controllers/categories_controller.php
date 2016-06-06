<?php

  require 'app/models/category.php';
  class CategoriesController extends BaseController{

    public static function categories(){
      $categories = Category::all();
      Kint::dump($categories);
      View::make('categories/index.html', array('categories' => $categories));
    }
  }
