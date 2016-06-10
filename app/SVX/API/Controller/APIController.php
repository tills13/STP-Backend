<?php
	namespace SVX\API\Controller;

	use Sebastian\Core\Controller\Controller;
	use Sebastian\Core\Http\Request;
	use Sebastian\Core\Http\Response\Response;
    use Sebastian\Core\Http\Response\JsonResponse;
    use Sebastian\Core\Http\Response\RedirectResponse;
    use Sebastian\Core\Session\Session;

    use SVX\Common\Model\Farmer;
	use \DateTime;

    /**
     * The generic catch-all for API related functions
     */
	class APIController extends Controller {
		public function syncAction(Request $request) {
			$name = $request->body->get('name', false);
			$uniqueId = $request->body->get('rawId', false);

			if (!$name || !$uniqueId) {
				return new JsonResponse([
					'message' => "name and id fields must be provided"
				], Response::HTTP_BAD_REQUEST);
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

			return new JsonResponse($farmer, Response::HTTP_OK);
		}
	}