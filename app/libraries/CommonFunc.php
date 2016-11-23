<?php 

class CommonFunc{

	public function __construct(){}

	public function CurlLink($baseUrl){
		$result = [];
		try{
            $curl = curl_init();

            curl_setopt_array($curl, [
                CURLOPT_RETURNTRANSFER  => 1,
                CURLOPT_URL             => $baseUrl,
                CURLOPT_TIMEOUT         => 3,
            ]);
            $result = curl_exec($curl);
            curl_close($curl);
            $result = json_decode($result,true);

            $result['status'] = '1';
            $result['msg'] = 'success';

        }catch(\Exception $e){
        	$result['status'] = '0';
            $result['msg'] = 'have an error while the process';
        }	

        return $result;
	}
	
}