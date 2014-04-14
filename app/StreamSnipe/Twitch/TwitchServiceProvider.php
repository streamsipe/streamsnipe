<?php namespace StreamSnipe\Twitch;

use Illuminate\Support\ServiceProvider;
use Guzzle\Http\Client;

class TwitchServiceProvider extends ServiceProvider {

   public function register()
   {
      $this->app->bind('twitch', function()
      {
         $client = new Client(\Config::get('twitch.base_url'));

         return new TwitchService($client);
      });
   }

}
