<?php

use Mockery as m;

class StreamsControllerTest extends TestCase {

   public function test_it_return_stream_data_as_json()
   {
      Twitch::shouldReceive('getRandom')->andReturn(array());

      $this->action('GET', 'StreamsController@random');
      $this->assertResponseOk();
   }

   public function test_it_returns_504_on_api_timeout_on_random()
   {
      Twitch::shouldReceive('getRandom')
         ->andThrow('StreamSnipe\Twitch\Exceptions\TwitchApiTimeoutException');

      $this->action('GET', 'StreamsController@random');
      $this->assertResponseStatus(504);
   }

}
