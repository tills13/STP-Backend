<?php
    namespace SVX\Common\Service;

    use Sebastian\Application;
    use Sebastian\Core\Service\ServiceInterface;

    use SebastianExtra\ORM\EntityManager;

    class TestService implements ServiceInterface {
        protected $application;
        protected $em;

        public function __construct(Application $application, EntityManager $em) {
            $this->application = $application;
            $this->em = $em;
        }
    }