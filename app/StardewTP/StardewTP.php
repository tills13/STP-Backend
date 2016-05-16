<?php
	namespace StardewTP;

	use \Exception;

	use Sebastian\Kernel;
	use Sebastian\Application;

	use Sebastian\Core\Http\Request;
	use Sebastian\Core\Http\Response\Response;
    use Sebastian\Utility\Configuration\Configuration;
	use Sebastian\Utility\Exception\Handler\ExceptionHandlerInterface;

	class StardewTP extends Application implements ExceptionHandlerInterface {
		protected $startTime;

        public function __construct(Kernel $kernel, Configuration $config = null) {
			$this->startTime = microtime(true);
			parent::__construct($kernel, $config);

			$this->registerExceptionHandler($this);
		}

		public function preHandle() {
			parent::preHandle();
			$this->get('templating')->addMacro('test', function() { print ('test'); });
		}

		public function onException(Exception $e) {
			print ($e->getMessage());
			return true;
		}

		public function shutdown(Request $request, Response $response) {
			parent::shutdown($request, $response);
			$diff = microtime(true) - $this->startTime;
		}
	}