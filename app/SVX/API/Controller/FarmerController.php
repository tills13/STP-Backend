<?php
	namespace SVX\API\Controller;

	use Sebastian\Core\Controller\Controller;
	use Sebastian\Core\Exception\SebastianException;
	use Sebastian\Core\Http\Request;
	use Sebastian\Core\Http\Response\Response;
    use Sebastian\Core\Http\Response\JsonResponse;
    use Sebastian\Core\Http\Response\RedirectResponse;
    use Sebastian\Core\Session\Session;

    use SVX\Common\Entity\Farmer;

	class FarmerController extends Controller {
		public function overviewAction(Request $request, $farmer) {
			$em = $this->getEntityManager();
			$farmerRepo = $em->getRepository("Farmer");
			$farmer = $farmerRepo->get($farmer);

			if (!$farmer) {
				//throw HttpException::entityNotFoundException();
				throw new SebastianException("No farmer with that id exists.");
			}

			return new JsonResponse([
				'farmer' => $farmer
			], Response::HTTP_OK);
		}

		public function listAction(Request $reqest) {
			$em = $this->getEntityManager();
			$farmerRepo = $em->getRepository("Farmer");
			$farmers = $farmerRepo->find();

			return new JsonResponse([
				'farmers' => $farmers
			], Response::HTTP_OK);
		}
	}