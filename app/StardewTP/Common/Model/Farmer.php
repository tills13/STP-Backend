<?php
	namespace StardewTP\Common\Model;

	use Sebastian\Core\Model\UserInterface;
	use Sebastian\Core\Model\EntityInterface;
	use \JsonSerializable;
	use \DateTime;

	class Farmer implements UserInterface,JsonSerializable {
		protected $id;
		protected $name;
		protected $username;
		protected $isAdmin;
		protected $gold;
		protected $rawId;
		protected $createdAt;
		protected $modifiedAt;
		protected $lastSync;
		protected $trades;

		public function __construct() {}

		public function setCreatedAt(DateTime $createdAt) {
			$this->createdAt = $createdAt;
		}

		public function getCreatedAt() {
			return $this->createdAt;
		}

		public function setGold($gold) {
			$this->gold = $gold;
		}

		public function getGold($formatted = false) {
			return $formatted ? number_format($this->gold) : $this->gold;
		}

		public function setId($id) {
			$this->id = $id;
		}

		public function getId() {
			return $this->id;
		}

		public function setIsAdmin($isAdmin) {
			$this->isAdmin = $isAdmin;
		}

		public function getIsAdmin() {
			return $this->isAdmin;
		}

		public function getLastSync() {
			return $this->lastSync;
		}

		public function setModifiedAt(DateTime $modifiedAt) {
			$this->modifiedAt = $modifiedAt;
		}

		public function getModifiedAt() {
			return $this->modifiedAt;
		}

		public function setName($name) {
			$this->name = $name;
		}

		public function getName() {
			return $this->name;
		}

		public function setRawId($rawId) {
			$this->rawId = $rawId;
		}

		public function getRawId() {
			return $this->rawId;
		}

		public function setTrades(array $trades = []) {
			$this->trades = $trades;
		}

		public function getTrades() {
			return $this->trades;
		}

		public function setUsername($username) {
			$this->username = $username;
		}

		public function getUsername() {
			return $this->username;
		}

		public function isAdmin() {
			return $this->isAdmin;
		}

		public function equals(Farmer $farmer = null) {
			return $farmer ? ($this->getId() == $farmer->getId()) : false;
		}

		public function jsonSerialize() {
			return [
				'id' => $this->getId(),
				'name' => $this->getName(),
				'username' => $this->getUsername(),
				'raw_id' => $this->getRawId(),
				'trades' => array_map(function($trade) {
					return [
						'id' => $trade->getId(),
						'buyer' => $trade->getBuyer() ? $trade->getBuyer()->getUsername() : null,
						'items' => $trade->getItems(),
						'status' => $trade->getStatus()
					];
				}, $this->getTrades()),
				'created_at' => $this->getCreatedAt(),
				'modified_at' => $this->getModifiedAt()
			];
		}
		
		public function __toString() {
			return json_encode($this);
		}
	}