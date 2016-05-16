<?php
    namespace StardewTP;

    use Sebastian\Kernel;
    use Sebastian\Internal\InternalComponent;
    use SebastianExtra\SebastianExtraComponent;

    class AppKernel extends Kernel {
        public function __construct($environment) {
            parent::__construct($environment);

            $this->registerComponents([
                new Common\CommonComponent($this, "Common"),
                new API\APIComponent($this, "API"),
                new Farmer\FarmerComponent($this, "Farmer"),
                new Admin\AdminComponent($this, "Admin"),
                new SebastianExtraComponent($this, "Extra"),
                new InternalComponent($this, "Internal")
            ]);

            $this->boot();
        }
    }