<?php
    namespace SVX\Common\Entity;

    use Sebastian\Core\Model\UserInterface;
    use Sebastian\Core\Model\EntityInterface;
    use \JsonSerializable;
    use \DateTime;

    class Partner implements EntityInterface,JsonSerializable {
        protected $contracts;
        protected $createdAt;
        protected $description;
        protected $id;
        protected $isApproved;
        protected $isEnabled;
        protected $logo;
        protected $modifiedAt;
        protected $name;

        public function __construct() {}

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

        public function setIsEnabled($isEnabled) {
            $this->isEnabled = $isEnabled;
        }

        public function getIsEnabled() {
            return $this->isEnabled;
        }

        public function setId($id) {
            $this->id = $id;
        }

        public function getId() {
            return $this->id;
        }

        public function setIsApproved($isApproved) {
            $this->isApproved = $isApproved;
        }

        public function getIsApproved() {
            return $this->isApproved;
        }

        public function setContracts(array $contracts) {
            $this->contracts = $contracts;
        }

        public function getContracts() {
            return $this->contracts;
        }

        public function setLogo($logo) {
            $this->logo = $logo;
        }

        public function getLogo() {
            return $this->logo;
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

        public function equals(Partner $partner = null) {
            return $partner ? ($this->getId() == $partner->getId()) : false;
        }

        public function jsonSerialize() {
            return [
                'id' => $this->getId(),
                'name' => $this->getName(),
                'description' => $this->getDescription(),
                'logo' => $this->getLogo(),
                'contracts' => $this->getContracts(),
                'created_at' => $this->getCreatedAt(),
                'modified_at' => $this->getModifiedAt()
            ];
        }
        
        public function __toString() {
            return json_encode($this);
        }
    }