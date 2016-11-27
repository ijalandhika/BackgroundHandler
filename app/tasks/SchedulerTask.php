<?php
/**
* this class purpose for dynamic scheduler task
*/
class SchedulerTask extends \Phalcon\CLI\Task
{
	public function mainAction()
	{
		$args = func_get_args();

        if (php_sapi_name() == "cli") {
            parse_str(implode('&', $args), $parameters);
        } else {
            $parameters = json_decode($args[0], true);
        }

        // task name parameter
        if (empty($parameters['task'])) {
            echo " ~> no task parameter given\n";
            return 1;
        }

        $studly = function($str){
            $str = ucwords(str_replace('.', ' ', trim($str)));
            return str_replace(' ', '', $str);
        };
        
        // sub task class name 
        $coreTask = 'CoreTasks\Schedulers\\'.$studly($parameters['task']);
        if (!class_exists($coreTask))
        {
            echo " ~> undefined task {$coreTask}\n";
            return 1;
        }

        $coreTask = new $coreTask();
        if (!$coreTask instanceof \CoreTasks\CoreTask) {
            echo " ~> task must be instance of CoreTasks\\CoreTask\n";
            return 1;
        }

        $params = $parameters;
        unset($params['task']);
        $coreTask->_setParams($params);

        $coreTask->_setConfig($this->getDI()->getConfig());
        return $coreTask->Invoke();
	}
}