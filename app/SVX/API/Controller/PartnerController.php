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

	class PartnerController extends Controller {
		public function overviewAction(Request $request, $partner) {
			$em = $this->getEntityManager();
			$partnerRepo = $em->getRepository("Partner");
			$partner = $partnerRepo->get($partner);

			if (!$partner) {
				//throw HttpException::entityNotFoundException();
				throw new SebastianException("No partner with that id exists.");
			}

			return new JsonResponse([
				'partner' => $partner
			], Response::HTTP_OK);
		}
    }