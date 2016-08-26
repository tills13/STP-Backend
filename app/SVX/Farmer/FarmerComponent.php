<?php
	namespace SVX\Farmer;

	use Sebastian\Core\Component\Component;
	use Sebastian\Core\Context\ContextInterface;
	use Sebastian\Utility\Configuration\Configuration;

	class FarmerComponent extends Component {
		public function __construct(ContextInterface $context, $name, Configuration $config = null) {
			parent::__construct($context, $name, $config);
			$this->setWeight(-1);
		}

		public function checkRequirements() {
			$request = $this->getContext()->getRequest();
			$session = $request->getSession();
			return $session->check();
		}
	}