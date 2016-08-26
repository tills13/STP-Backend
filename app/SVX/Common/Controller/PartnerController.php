<?php
    namespace SVX\Common\Controller;

    use Sebastian\Core\Controller\Controller;
    use Sebastian\Core\Http\Exception\HttpException;
    use Sebastian\Core\Http\Request;
    use Sebastian\Core\Http\Response\FileResponse;
    use Sebastian\Core\Http\Response\JsonResponse;
    use Sebastian\Utility\Utility\Utils;

    class PartnerController extends Controller {
        public function listAction(Request $request) {
            $em = $this->getEntityManager();
            $repo = $em->getRepository('Partner');
            $partners = $repo->find([
                'isEnabled' => true,
                'isApproved' => true
            ], ['orderBy' => ['id' => 'asc', 'name' => 'desc']]);

            return $this->render('partner/list', [
                'partners' => $partners
            ]);
        }

        public function overviewAction(Request $request, $partner) {
            $em = $this->getEntityManager();
            $repo = $em->getRepository('Partner');
            $partner = $repo->get($partner);

            if (!$partner) {
                throw HttpException::notFoundException("Could not find a partner with that ID.");
            }

            return $this->render('partner/overview', [
                'partner' => $partner
            ]);
        }
    }