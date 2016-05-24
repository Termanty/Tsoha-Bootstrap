<?php

  class TopicsController extends BaseController{

    public static function index(){
   	  View::make('topics.html');
    }

    public static function topic(){
   	  View::make('topic.html');
    }
  }
