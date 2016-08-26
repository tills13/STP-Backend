<?php
	namespace SVX\Common\Entity;

	use Sebastian\Core\Model\EntityInterface;
	use \JsonSerializable;
	use \DateTime;

	class Trade implements EntityInterface,JsonSerializable {
		const STATUS_OPEN = "open";
		const STATUS_PENDING = "pending";
		const STATUS_RETURNING = "returning";
		const STATUS_RETURNED = "returned";
		const STATUS_CLOSED = "closed";

		protected $id;
		protected $status;
		protected $seller;
		protected $items;
		protected $title;
		protected $buyer;
		protected $askingPrice;
		protected $createdAt;
		protected $modifiedAt;

		public function __construct() {
			$this->status = Trade::STATUS_OPEN;
		}

		public function setAskingPrice($askingPrice) {
			$this->askingPrice = $askingPrice;
		}

		public function getAskingPrice($formatted = false) {
			return $formatted ? number_format($this->askingPrice) : $this->askingPrice;
		}

		public function setBuyer(Farmer $buyer) {
			$this->buyer = $buyer;
		}

		public function getBuyer() {
			return $this->buyer;
		}

		public function setCreatedAt(DateTime $createdAt) {
			$this->createdAt = $createdAt;
		}

		public function getCreatedAt() {
			return $this->createdAt;
		}

		public function getId() {
			return $this->id;
		}

		public function setItems($items) {
			$this->items = $items;
		}

		public function getItems() {
			return $this->items;
		}

		public function setModifiedAt(DateTime $modifiedAt) {
			$this->modifiedAt = $modifiedAt;
		}

		public function getModifiedAt() {
			return $this->modifiedAt;
		}

		public function setSeller(Farmer $seller) {
			$this->seller = $seller;
		}

		public function getSeller() {
			return $this->seller;
		}

		public function setStatus($status) {
			$this->status = $status;
		}

		public function getStatus() {
			return $this->status;
		}

		public function setTitle($title) {
			$this->title = $title;
		}

		public function getTitle() {
			return $this->title;
		}

		public function is($status) {
			return $this->getStatus() == $status;
		}

		public function equals(Trade $trade) {
			return $trade ? ($this->getId() == $trade->getId()) : false;
		}

		public function jsonSerialize() {
			return [
				'id' => $this->getId(),
				'title' => $this->getTitle(),
				'status' => $this->getStatus(),
				'askingPrice' => $this->getAskingPrice(),
				'seller' => [
					'id' => $this->getSeller()->getId(),
					'username' => $this->getSeller()->getUsername()
				],
				'buyer' => $this->getBuyer() ? [
					'id' => $this->getBuyer()->getId(),
					'username' => $this->getBuyer()->getUsername()
				] : null,
				'items' => $this->getItems()
			];
		}

		public function __toString() {
			return json_encode($this);
		}
	}