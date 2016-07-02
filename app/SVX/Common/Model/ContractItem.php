<?php
	namespace SVX\Common\Model;

	use Sebastian\Core\Model\EntityInterface;
	use \JsonSerializable;
	use \DateTime;

	class ContractItem implements EntityInterface,JsonSerializable {
		protected $id;
		protected $contract;
		protected $item;
		protected $quantity;
		protected $quality;

		public function __construct(Contract $contract = null, $item = null, $quantity = null, $quality = null) {
			$this->contract = $contract;
			$this->item = $item;
			$this->quantity = $quantity;
			$this->quality = $quality;
			$this->totalOrders = 0;
			$this->remainingOrders = 0;
		}

		public function setContract(Contract $contract) {
			$this->contract = $contract;
		}

		public function getContract() {
			return $this->contract;
		}

		public function getId() {
			return $this->id;
		}

		public function setItem($item) {
			$this->item = $item;
		}

		public function getItem() {
			return $this->item;
		}

		public function setQuality($quality) {
			$this->quality = $quality;
		}

		public function getQuality() {
			return $this->quality;
		}

		public function setQuantity($quantity) {
			$this->quantity = $quantity;
		}

		public function getQuantity() {
			return $this->quantity;
		}

		public function equals(ContractItem $contractItem = null) {
			if (!$contractItem) return false;

			$mItemId = is_array($this->getItem()) ? $this->getItem()['id'] : $this->getItem();
			$mContractItemId = is_array($contractItem->getItem()) ? $contractItem->getItem()['id'] : $contractItem->getItem();

			return $mItemId === $mContractItemId && 
				   $this->getQuantity() == $contractItem->getQuantity() &&
				   $this->getQuality() == $contractItem->getQuality();
		}

		public function jsonSerialize() {
			return [
				'contract' => $this->getContract()->getId(),
				'item' => $this->getItem(),
				'quantity' => $this->getQuantity(),
				'quality' => $this->getQuality()
			];
		}
		
		public function __toString() {
			return json_encode($this);
		}
	}