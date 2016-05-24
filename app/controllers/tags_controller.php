<?php

  class TagsController extends BaseController{

    public static function tags(){
      View::make('tags.html');
    }
  }
