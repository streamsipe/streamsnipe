<?php

use StreamSnipe\Twitch\Exceptions\TwitchApiTimeoutException;

class StreamsController extends BaseController {

	/**
	 * Returns a totally random stream from the twitch api.
	 * 
	 * @return Reponse
	 */
	public function random()
	{
		try
		{
			$stream = Twitch::getRandom();
		}
		catch (TwitchApiTimeoutException $e)
		{
			// 2** Error code: External service error.
			return Response::json(array(
				'message' 	=> 'Unable to communicate with Twitch servers.',
				'code'		=> '201',
			), 504);
		}

		return Response::json($this->transformStream($stream));
	}

	public function filterRandom($filter)
	{
		try
		{
			$stream = Twitch::getRandom($filter);
		}
		catch (TwitchApiTimeoutException $e)
		{
			// 2** Error code: External service error.
			return Response::json(array(
				'message' 	=> 'Unable to communicate with Twitch servers.',
				'code'		=> '201',
			), 504);
		}

		return Response::json($this->transformStream($stream));
	}
	
	/**
	 * Transforms the data from the RAW Twitch API to StreamSnipe more 
	 * digestible format
	 * 
	 * @param  array the stream to be transformed
	 * @return array
	 */
	private function transformStream($stream)
	{
		$transformedStream = [
			'title'		=> $stream['channel']['name'],
			'streamer'	=> $stream['channel']['display_name'],
			'game' 		=> $stream['game'],
			'link'		=> $stream['channel']['url'],
			'viewers' 	=> $stream['viewers'],
			'followers'	=> $stream['channel']['followers'],
			'mature'		=> $stream['channel']['mature'],
			'preview'	=> $stream['preview']['large'],
			'logo'		=> $stream['channel']['logo'],
		];
		
		return $transformedStream;
	}

}
