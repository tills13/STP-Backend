<?php
    namespace SVX\Common\Service;

    use Sebastian\Core\Service\Service;
    use Sebastian\Core\Http\Request;

    class TestService implements Service {
        public function __construct(Request $request) {
            //print ("here");
        }
    }