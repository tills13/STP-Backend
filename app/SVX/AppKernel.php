<?php
    namespace SVX;

    use Sebastian\Kernel;
    use SebastianExtra\SebastianExtraComponent;

    class AppKernel extends Kernel {
        public function __construct($environment) {
            parent::__construct($environment);

            $this->registerComponents([
                new Common\CommonComponent($this, "Common"),
                new API\APIComponent($this, "API"),
                new Farmer\FarmerComponent($this, "Farmer"),
                new Admin\AdminComponent($this, "Admin"),
                new SebastianExtraComponent($this, "Sebastian\\Extra")
            ]);

            $this->boot();
            $this->registerExtensions();
        }

        public function registerExtensions() {
            $templating = $this->get('templating');
            $templating->addMacro('progressBar', function($parameters) use ($templating) {
                if (isset($parameters['class'])) {
                    if (is_array($parameters['class'])) {
                        $parameters['class'] = implode(' ', $parameters['class']);
                    }
                } else {
                    $parameters['class'] = '';
                }

                return $templating->render('misc/progress_bar', $parameters);
            });
        }
    }