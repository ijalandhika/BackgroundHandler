<?php 

namespace CoreTasks\Models;

class InstagramModel
{
	const postType = [
		'1' => 'image',
		'2' => 'video'
	];

	public function SetPayload($request)
	{
		$payload = [
			"id" =>$request['id'] ,
			"user" => $request['user'],
			"link" => $request['link'],
			"location" => $request['location'],
			"created_time" => $request['created_time'],
			"source" => $request['source']
		];
		$payload['detail'] = $this->GetPayloadType($request);

		return $payload;
	}

	private function GetPayloadType($request)
	{
		$value = [];
		$value['type'] = $request['type'];
		switch (strtoupper($request['type'])) {
			case strtoupper(self::postType['1']):
				$value['low_resolution'] = $request['images']['low_resolution']; 
				$value['standard_resolution'] = $request['images']['standard_resolution'];
				break;
			case strtoupper(self::postType['2']):
				$value['low_resolution'] = $request['videos']['low_resolution']; 
				$value['standard_resolution'] = $request['videos']['standard_resolution'];
				break;
		}

		return $value; 
	}
}