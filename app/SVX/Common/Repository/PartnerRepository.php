<?php
    namespace SVX\Common\Repository;

    use SebastianExtra\Repository\Repository;

    class PartnerRepository extends Repository {
        public function getAllPartners() {
            $conn = $this->getConnection();
            $query = "SELECT p.*, count(j.*) AS jobs FROM partners p LEFT JOIN jobs j ON p.id = j.owner GROUP BY p.id;";
            return $conn->execute($query)->fetchAll();
        }
    }