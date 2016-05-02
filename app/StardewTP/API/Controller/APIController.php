<?php
	namespace StardewTP\API\Controller;

	use Sebastian\Core\Controller\Controller;
	use Sebastian\Core\Http\Request;
	use Sebastian\Core\Http\Response\Response;
    use Sebastian\Core\Http\Response\JsonResponse;
    use Sebastian\Core\Http\Response\RedirectResponse;
    use Sebastian\Core\Session\Session;

    use StardewTP\Common\Entity\Farmer;

	class APIController extends Controller {
		public function initializeAction(Request $request) {
			$name = $request->body->get('Name', false);
			$uniqueId = $request->body->get('UniqueId', false);

			if (!$name || !$uniqueId) {
				return new JsonResponse([
					'message' => "name and unique id fields must be provided"
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

				$farmer = $em->persist($farmer);
				$farmer = $farmerRepo->get("{$uniqueId}_{$name}");
				//$farmer = $em->reload($farmer);
			} else {
				$firstTime = false;
			}

			return new JsonResponse([
				'farmer' => $farmer,
				'first_time' => $firstTime
			], Response::HTTP_OK);
		}
	}