<?php
	namespace SVX\API\Controller;

	use \DateTime;

	use Sebastian\Core\Controller\Controller;
	use Sebastian\Core\Http\Exception\HttpException;
	use Sebastian\Core\Http\Request;
    use Sebastian\Core\Http\Response\JsonResponse;
    use Sebastian\Core\Session\Session;

    use SVX\Common\Entity\Farmer;

    /**
     * The generic catch-all for API related functions
     */
	class APIController extends Controller {
		public function syncAction(Request $request, Session $session) {
			$currentUser = $session->getUser();
			$name = $request->body->get('name') ?? $currentUser->getName();
			$uniqueId = $request->body->get('rawId') ?? $currentUser->getRawId();

			if (!$currentUser->getIsAdmin() && $currentUser->getRawId() != $uniqueId) {
				HttpException::forbiddenException();
			}

			if (!$name || !$uniqueId) {
				return new JsonResponse([
					'message' => "Name and id (rawId) fields must be provided"
				], JsonResponse::HTTP_BAD_REQUEST);
			}

			$em = $this->getEntityManager();
			$farmerRepo = $em->getRepository('Farmer');

			$farmer = $farmerRepo->get("{$uniqueId}_{$name}");

			if (!$farmer) {
				$firstTime = true;
				$farmer = new Farmer();
				$farmer->setName($name);
				$farmer->setId("{$uniqueId}_{$name}");
				$farmer->setRawId($uniqueId);
			} else {
				$firstTime = false;
			}

			$gold = $request->body->get('gold');
			$farmer->setGold($gold);
			$farmer->setLastSync(new DateTime());

			$farmer = $em->persist($farmer);
			$farmer = $farmerRepo->get("{$uniqueId}_{$name}");

			return new JsonResponse($farmer, JsonResponse::HTTP_OK);
		}
	}