<?php
    namespace StardewTP\Common\Repository;

    use SebastianExtra\Repository\Repository;
    use \PDO;

    class PartnerRepository extends Repository {
        public function getAllPartners() {
            $conn = $this->getConnection();
            $query = "SELECT p.*, count(j.*) AS jobs FROM partners p LEFT JOIN jobs j ON p.id = j.owner GROUP BY p.id;";
            return $conn->execute($query)->fetchAll();
        }
    }