<?php
    namespace SVX\Common\Model;

    use Sebastian\Core\Model\EntityInterface;

    use \JsonSerializable;
    use \DateTime;

    class Contract implements EntityInterface,JsonSerializable {
        const STATUS_OPEN = "open";
        const STATUS_PENDING = "pending";
        const STATUS_RETURNING = "returning";
        const STATUS_RETURNED = "returned";
        const STATUS_CLOSED = "closed";

        protected $id;
        protected $description;
        protected $owner;
        protected $payout;
        protected $items;
        protected $totalOrders;
        protected $remainingOrders;
        protected $status;
        protected $title;
        protected $createdAt;
        protected $modifiedAt;

        public function __construct() {
            $this->status = Contract::STATUS_OPEN;
        }

        public function setCreatedAt(DateTime $createdAt) {
            $this->createdAt = $createdAt;
        }

        public function getCreatedAt() {
            return $this->createdAt;
        }

        public function setDescription($description) {
            $this->description = $description;
        }

        public function getDescription() {
            return $this->description;
        }

        public function getId() {
            return $this->id;
        }

        public function setItems(ContractItem ... $items) {
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

        public function setOwner(Partner $owner) {
            $this->owner = $owner;
        }

        public function getOwner() : Partner {
            return $this->owner;
        }

        public function setPayout($payout) {
            $this->payout = $payout;
        }

        public function getPayout($formatted = false) {
            return $formatted ? number_format($this->payout) : $this->payout;
        }

        public function setRemainingOrders(int $remainingOrders) {
            $this->remainingOrders = $remainingOrders;
        }

        public function getRemainingOrders() : int {
            return $this->remainingOrders;
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

        public function setTotalOrders(int $totalOrders) {
            $this->totalOrders = $totalOrders;
        }

        public function getTotalOrders() : int {
            return $this->totalOrders;
        }

        public function is($status) {
            return $this->getStatus() == $status;
        }

        public function equals(Contract $contract) {
            return $contract ? ($this->getId() == $contract->getId()) : false;
        }

        public function jsonSerialize() {
            return [
                'id' => $this->getId(),
                'title' => $this->getTitle(),
                'description' => $this->getDescription(),
                'status' => $this->getStatus(),
                'payout' => $this->getPayout(),
                'items' => $this->getItems(),
                'total_orders' => $this->getTotalOrders(),
                'remaining_orders' => $this->getRemainingOrders(),
                'owner' => [
                    'id' => $this->getOwner()->getId(),
                    'name' => $this->getOwner()->getName()
                ]
            ];
        }

        public function __toString() {
            return json_encode($this);
        }
    }