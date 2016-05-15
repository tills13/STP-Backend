<?php
    namespace StardewTP\Admin;

    use Sebastian\Core\Component\Component;
    use Sebastian\Core\Context\ContextInterface;
    use Sebastian\Utility\Configuration\Configuration;

    class AdminComponent extends Component {
        public function __construct(ContextInterface $context, $name, Configuration $config = null) {
            parent::__construct($context, $name, $config);

            $this->setWeight(-2);
        }

        public function checkRequirements(ContextInterface $context) {
            $request = $context->getRequest();
            $session = $request->getSession();
            return $session->check() && $session->getUser()->isAdmin();
        }
    }