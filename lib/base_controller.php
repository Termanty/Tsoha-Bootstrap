<?php

  class BaseController{

    public static function fetch_current_user(){
      if(isset($_SESSION['user'])){
        $user = Member::find($_SESSION['user']);
        return $user;
      }
      return null;
    }

    public static function check_logged_in(){
      // Toteuta kirjautumisen tarkistus tähän.
      // Jos käyttäjä ei ole kirjautunut sisään, ohjaa hänet toiselle sivulle (esim. kirjautumissivulle).
    }

  }
