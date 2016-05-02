<?php
	namespace StardewTP\Common\Repository;

	use SebastianExtra\Repository\Repository;

	class FarmerRepository extends Repository {
		public function login($identification, $password) {
			$conn = $this->getConnection();

			$query = "SELECT password = crypt(:password, password) AS success 
					 	FROM farmers 
					  	WHERE (
							username = :identification OR 
							unique_id_fixed = :identification OR 
							email = :identification
						);";

			$result = $conn->execute($query, [
				'identification' => $identification,
				'password' => $password
			])->fetch();

			return $result['success'];
		}

		public function register($uniqueId, $username, $email, $password) {
			$conn = $this->getConnection();

			$result = $conn->execute("UPDATE public.farmers SET username = :username, email = :email, password = crypt(:password, gen_salt('bf', 8)) WHERE unique_id_fixed = :unique_id RETURNING unique_id_fixed;", [
				'username' => $username, 
				'password' => $password,
				'email' => $email,
				'unique_id' => $uniqueId
			])->fetch();

			return $result['unique_id_fixed'];
		}
	}