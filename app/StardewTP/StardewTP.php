<?php
	namespace StardewTP;

	use \Exception;

	use Sebastian\Kernel;
	use Sebastian\Application;

	use Sebastian\Core\Http\Request;
	use Sebastian\Core\Http\Response\Response;
	use Sebastian\Internal\InternalComponent;
    use Sebastian\Utility\Configuration\Configuration;
	use Sebastian\Utility\Exception\Handler\ExceptionHandlerInterface;

	use SebastianExtra\SebastianExtraComponent;

	class StardewTP extends Application implements ExceptionHandlerInterface {
		protected $startTime;

        public function __construct(Kernel $kernel, Configuration $config = null) {
			$this->startTime = microtime(true);
			parent::__construct($kernel, $config);

			$this->registerComponents([
				new Common\CommonComponent($this, "Common"),
				new API\APIComponent($this, "API"),
				new Farmer\FarmerComponent($this, "Farmer"),
				new SebastianExtraComponent($this, "Extra", $config->sub('components.sebastian_extra')),
				new InternalComponent($this, "Internal", $config->sub('components.sebastian_internal'))
			]);

			$this->registerExceptionHandler($this);
		}

		public function onException(Exception $e) {
			print ($e->getMessage());
			return true;
		}

		public function shutdown(Request $request, Response $response) {
			parent::shutdown($request, $response);

			$diff = microtime(true) - $this->startTime;
			//print ("rendered in: {$diff} seconds");
			//$this->getLogger()->info("completed request in {$diff} seconds", "StardewTP");
		}
	}