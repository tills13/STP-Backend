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

        protected $contractor;
        protected $description;
        protected $id;
        protected $owner;
        protected $payout;
        protected $status;
        protected $title;
        protected $createdAt;
        protected $modifiedAt;

        public function __construct() {
            $this->status = Contract::STATUS_OPEN;
        }

        public function setContractor(Farmer $contractor) {
            $this->contractor = $contractor;
        }

        public function getContractor() {
            return $this->contractor;
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

        public function setModifiedAt(DateTime $modifiedAt) {
            $this->modifiedAt = $modifiedAt;
        }

        public function getModifiedAt() {
            return $this->modifiedAt;
        }

        public function setOwner(Partner $owner) {
            $this->owner = $owner;
        }

        public function getOwner() {
            return $this->owner;
        }

        public function setPayout($payout) {
            $this->payout = $payout;
        }

        public function getPayout($formatted = false) {
            return $formatted ? number_format($this->payout) : $this->payout;
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
                'owner' => [
                    'id' => $this->getOwner()->getId(),
                    'name' => $this->getOwner()->getName()
                ],
                'contractor' => $this->getContractor() ? [
                    'id' => $this->getContractor()->getId(),
                    'username' => $this->getContractor()->getUsername()
                ] : null
            ];
        }

        public function __toString() {
            return json_encode($this);
        }
    }