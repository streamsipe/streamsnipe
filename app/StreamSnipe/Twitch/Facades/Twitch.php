<?php namespace StreamSnipe\Twitch\Facades;

use Illuminate\Support\Facades\Facade;

class Twitch extends Facade {

   protected static function getFacadeAccessor() 
   {
      return 'twitch';
   }

}
