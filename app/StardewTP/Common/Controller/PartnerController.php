<?php
    namespace StardewTP\Common\Controller;

    use Sebastian\Core\Controller\Controller;
    use Sebastian\Core\Http\Request;
    use Sebastian\Core\Http\Response\FileResponse;
    use Sebastian\Core\Http\Response\JsonResponse;
    use Sebastian\Utility\Utility\Utils;

    class PartnerController extends Controller {
        public function listAction(Request $request) {
            $em = $this->getEntityManager();
            $repo = $em->getRepository('Partner');
            $partners = $repo->find(null, ['orderBy' => ['id' => 'asc', 'name' => 'desc']]);

            //return new JsonResponse(['partners' => $partners]);
            //$partners = $repo->getAllPartners();

            return $this->render('partners/list', [
                'partners' => $partners
            ]);
        }

        public function overviewAction(Request $request, $partner) {
            $em = $this->getEntityManager();
            $repo = $em->getRepository('Partner');
            $partner = $repo->get($partner);

            return $this->render('partners/overview', [
                'partner' => $partner
            ]);
        }
    }