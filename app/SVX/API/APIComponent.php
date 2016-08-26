<?php
	namespace SVX\API;

	use Sebastian\Core\Session\Session;
	use Sebastian\Core\Component\Component;
	use Sebastian\Core\Context\ContextInterface;
	use Sebastian\Utility\Configuration\Configuration;

	class APIComponent extends Component {
		public function __construct(ContextInterface $context, $name, Configuration $config = null) {
			parent::__construct($context, $name, $config);

			$this->setRoutePrefix('api');
			$this->setWeight(100);
		}

		public function checkIsAuthenticated(Session $session) {
			return $session->check();
		}
	}