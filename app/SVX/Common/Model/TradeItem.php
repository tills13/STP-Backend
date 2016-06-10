<?php
	namespace SVX\Common\Model;

	use Sebastian\Core\Model\EntityInterface;
	use \JsonSerializable;
	use \DateTime;

	class TradeItem implements EntityInterface,JsonSerializable {
		protected $id;
		protected $trade;
		protected $item;
		protected $amount;
		protected $quality;

		public function __construct(Trade $trade = null, $item = null, $amount = null, $quality = null) {
			$this->trade = $trade;
			$this->item = $item;
			$this->amount = $amount;
			$this->quality = $quality;
		}

		public function setAmount($amount) {
			$this->amount = $amount;
		}

		public function getAmount() {
			return $this->amount;
		}

		public function setId($id) {
			$this->id = $id;
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

		public function setTrade(Trade $trade) {
			$this->trade = $trade;
		}

		public function getTrade() {
			return $this->trade;
		}

		public function equals(TradeItem $tradeItem = null) {
			return $tradeItem ? ($this->getId() == $tradeItem->getId()) : false;
		}

		public function jsonSerialize() {
			return [
				'trade' => $this->getTrade()->getId(),
				'item' => $this->getItem(),
				'amount' => $this->getAmount(),
				'quality' => $this->getQuality()
			];
		}
		
		public function __toString() {
			return json_encode($this);
		}
	}