<?php namespace StreamSnipe\Twitch; 

use StreamSnipe\Twitch\Exceptions\TwitchApiTimeoutException;
use StreamSnipe\Twitch\Exceptions\FailedSearchException;
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

		if ($response->getStatusCode() != 200) throw new TwitchApiTimeoutException;

		// Generate a random number to selec the stream
		$streamCount = $response->json()['_total'];		
		$streamId = rand(0, $streamCount);

		// Get that stream now!
		if ($filter)
		{
			$response = $this->client->get("search/streams?limit=25&offset=$streamId&q=$filter")->send();			
		}
		else
		{
			$response = $this->client->get("streams?limit=1&offset=$streamId")->send();
		}

		if ($response->getStatusCode() != 200) throw new TwitchApiTimeoutException;

		try 
		{
			$stream = $response->json()['streams'][0];	
		} 
		catch (\ErrorException $e) 
		{
			throw new FailedSearchException;
		}

		return $stream;
	}

}
