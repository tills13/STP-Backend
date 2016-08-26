<?php
	namespace SVX\Common\Entity;

	use Sebastian\Core\Model\EntityInterface;
	use \JsonSerializable;
	use \DateTime;

	class ContractFulfillment implements EntityInterface,JsonSerializable {
        protected $id;
        protected $contract;
        protected $farmer;
        protected $date;

        public function __construct(Contract $contract, Farmer $farmer, DateTime $date = null) {
            $this->contract = $contract;
            $this->farmer = $farmer;
            $this->date = $date;
        }

        public function getId() {
            return $this->id;
        }

        public function jsonSerialize() {
			return [];
		}
    }