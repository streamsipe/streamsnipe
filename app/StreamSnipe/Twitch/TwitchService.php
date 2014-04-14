<?php namespace StreamSnipe\Twitch; 

use Guzzle\Http\Client;

class TwitchService {

	protected $client;

	function __construct(Client $client)
	{
		$this->client = $client;
	}

	public function getRandom()
	{
		// Get the number of streamers right now
		$response = $this->client->get('streams')->send();
		$streamCount = $response->json()['_total'];

		// Generate a random number to selec the stream
		$streamId = rand(0, $streamCount);

		// Get that stream now!
		$response = $this->client->get("streams?limit=1&offset=$streamId")->send();
		$stream = $response->json()['streams'][0];

		return $stream;
	}

}
