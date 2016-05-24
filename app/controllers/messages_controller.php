<?php

  class MessageController extends BaseController{

    public static function messages(){
      View::make('messages.html');
    }
  }
