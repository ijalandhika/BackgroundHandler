<?php 

use Phalcon\Db\Adapter\Pdo\Mysql as DbAdapter;
use nsqphp\nsqphp;
/**
* Use this class for connection adapter
*/
class Adapter{

	public function MysqlCon($config){
		// to do connect to mysql
	}

	public function NsqCon(){
		$this->nsq = new nsqphp();
        return $this->nsq;
	}

	public function ElasticCon($config){
		// to do connect to elastic
	}
}