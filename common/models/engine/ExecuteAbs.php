<?php 
namespace common\models\engine;

use Yii;
use common\models\engine\ITrace;
use common\models\engine\IExecute;
use common\models\engine\IForkable;
use common\models\engine\ExecutionResponse;
use common\models\utils\DevUtils;


abstract class ExecuteAbs implements IExecute, ITrace, IForkable
{
	private $data;
	private $beforTimestamp;
	private $diffTimestamp;
	private $logDoc; 
	private $isContinueOnFalse;
	// public abstract function getDescription();
	// public abstract function getConf();
	// public abstract function fork();

	public function __construct()
	{
		$this->beforTimestamp = 0;
		$this->diffTimestamp = 0;
		$this->logDoc = [];
		$this->isContinueOnFalse = false;
	}

	public function &getData()
	{
		return $this->data;
	}
	
	public function setData(&$data)
	{
		$this->data = $data;
	}

	public function pushMessage($messageId, $message)
	{
		$caller = get_class($this);
		$this->logDoc[] = [$messageId => $caller . " - " . ExecutionResponse::getDescription($messageId, $message)];
	}

	public function &getTracingDoc()
	{
		return $this->logDoc;
	}

	public function &continueOnFalse($bool)
	{
		$this->isContinueOnFalse = $bool;
		return $this;
	}

	public function isContinueOnFalse()
	{
		return $this->isContinueOnFalse;
	}

	public function execute()
	{
		$retVal = false;
		$this->beforeExec();

		try
		{
			$retVal = $this->fork();
		}
		catch(Exception $e)
		{
			$this.pushMessage(ExecutionResponse::ERROR, "Error on child (" + get_class($this) + ") fork return false, msg : " + $e->getMessage());
			return false;
		}

		if(!$this->isContinueOnFalse)
		{
			if(!$retVal)
			{
				$this->pushMessage(ExecutionResponse::INFO, "isContinueOnFalse == false, (" + get_class($this) + ") return false");
				$this->appendMessageDocs2Log($this->getTracingDoc());
				return $retVal;
			}
		}



		$jobs = $this->getConf();
		$data = &$this->getData();

		if(!empty($jobs))
		{
			foreach($jobs as $job)
			{
				if(YII_ENV == 'test')
				{
					//use for test 
					$job = $this->injectMock($job);
				}
				$job->setData($data);
				$retVal = $job->execute();
				$this->appendMessageDocs2Log($job->getTracingDoc());

				if(!$job->isContinueOnFalse() && !$retVal)
				{
					$this->pushMessage(ExecutionResponse::INFO, "isContinueOnFalse == false, (" + get_class($job) + ") returned false");
					return $retVal;
				}
				
			}
		}

		$this->afterExec();
		$this->appendMessageDocs2Log($this->getTracingDoc());
		return $retVal;
	}

	//privates
	private function beforeExec()
	{
		$this->beforTimestamp = DevUtils::getCurrentFloatTimestamp();
	}

	private function afterExec()
	{
		$this->diffTimestamp = (DevUtils::getCurrentFloatTimestamp() - $this->beforTimestamp) * 1000;
		$this->pushMessage(ExecutionResponse::INFO, "time diff : {$this->diffTimestamp} ms");
	}

	private function appendMessageDocs2Log($messages)
	{
		if(empty($messages))
		{
			return;
		}

		foreach ($messages as $message) 
		{
			foreach ($message as $key => $value) 
			{
				$level = ExecutionResponse::getLogLevel($key);
				Yii::$level($value);
			}
		}
	}
	/**
	 * load mock prosess for $job if mock exists - the mock class soud be the job class + Mock postfix. 
	 * @param  [IExecute] $job - load mock prosess for $job. 
	 * @return [IExecute]      [mock object if mock exists]
	 */
	private function &injectMock($job)
	{
		$mock = $job;
		$className = get_class($job) . Yii::$app->params['mock_extention'];
		if(class_exists($className))
		{
			$mock = \yii\di\Instance::ensure(
		        $className,
		        IParseProvider::class
		    ); 
		    DevUtils::pPrint($className, 'mock className', __METHOD__, __LINE__);
		}
		return $mock;
	}
}