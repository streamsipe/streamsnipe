<?php

use Mockery as m;

class StreamsControllerTest extends TestCase {

	public function test_it_return_stream_data_as_json()
	{
		Twitch::shouldReceive('getRandom')->andReturn($this->getFakeStreamData());

		$this->action('GET', 'StreamsController@random');
		$this->assertResponseOk();		
	}

	public function test_it_returns_filtered_data_as_json()
	{
		Twitch::shouldReceive('getRandom')->with(m::any())
			->andReturn($this->getFakeStreamData());

		$this->action('GET', 'StreamsController@filterRandom');
		$this->assertResponseOk();
	}

	public function test_it_return_503_on_api_issue()
	{
		Twitch::shouldReceive('getRandom')
			->andThrow('StreamSnipe\Twitch\Exceptions\FailedSearchException');

		$this->action('GET', 'StreamsController@random');
		$this->assertResponseStatus(503);
	}

	public function test_it_returns_504_on_api_timeout_on_random()
	{
		Twitch::shouldReceive('getRandom')
			->andThrow('StreamSnipe\Twitch\Exceptions\TwitchApiTimeoutException');

		$this->action('GET', 'StreamsController@random');
		$this->assertResponseStatus(504);
	}

	private function getFakeStreamData()
	{
		return [
			'game'      => 'data',
			'viewers'   => 'data',
			'preview'   => ['large' => 'data'],
			'channel'   => [
				'name'            => 'data',
				'display_name'    => 'data',
				'url' 				=> 'data',
				'followers' 		=> 'data',
				'mature' 			=> 'data',
				'logo' 				=> 'data',
			]	
		];
	}

}
