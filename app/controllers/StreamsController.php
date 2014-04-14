<?php

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
			$stream = Twitch::getRandom()
		}
		catch (TwitchApiTimeoutException $e)
		{
			// 2** Error code: External service error.
			return Response::json(array(
				'message' 	=> 'Unable to communicate with Twitch servers.',
				'code'		=> '201',
			));
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
		// TODO: Implement the transformation
		
		return $stream;
	}

}
