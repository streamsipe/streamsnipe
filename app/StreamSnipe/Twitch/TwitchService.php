<?php namespace StreamSnipe\Twitch; 

use Guzzle\Http\Client;

class TwitchService {

	protected $client;

	function __construct(Client $client)
	{
		$this->client = $client;
	}

	public function getRandom($filter = null)
	{		
		// Get the number of streamers right now
		if ($filter)
		{
			$response = $this->client->get("search/streams?limit=1&offset=0&q=$filter")->send();
		}
		else
		{
			$response = $this->client->get('streams')->send();
		}
		$streamCount = $response->json()['_total'];

		// Generate a random number to selec the stream
		$streamId = rand(0, $streamCount);

		// Get that stream now!
		if ($filter)
		{
			$response = $this->client->get("search/streams?limit=1&offset=$streamId&q=$filter")->send();			
		}
		else
		{
			$response = $this->client->get("streams?limit=1&offset=$streamId")->send();
		}
		$stream = $response->json()['streams'][0];

		return $stream;
	}

}
