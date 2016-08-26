<?php
	namespace SVX\Common\Controller;

    use \PDOException;

	use Sebastian\Core\Controller\Controller;
    use Sebastian\Core\Database\Exception\DatabaseException;
    use Sebastian\Core\Http\Exception\HttpException;
	use Sebastian\Core\Http\Request;
	use Sebastian\Core\Http\Response\Response;
    use Sebastian\Core\Http\Response\JsonResponse;
    use Sebastian\Core\Http\Response\RedirectResponse;
    use Sebastian\Core\Session\Session;

    use SVX\Common\Entity\Farmer;

	class FarmerController extends Controller {
        public function overviewAction(Request $request, Session $session, $farmer) {
            $em = $this->getEntityManager();
	        $tradeRepo = $em->getRepository('Trade');
            $farmerRepo = $em->getRepository('Farmer');

            $farmer = $farmerRepo->findOne([ 'username' => $farmer ]);

            if (!$farmer) {
                throw HttpException::notFoundException("Farmer with requested username not found...");
            }

            $expression = $em->expr()->orExpr(
                $em->expr()->eq('seller', "'{$farmer->getId()}'"),
                $em->expr()->eq('buyer', "'{$farmer->getId()}'")
            );

            $trades = $tradeRepo->find([$expression]);

            return $this->render('farmer/overview', [
                'farmer' => $farmer,
                'trades' => $trades
            ]);
        }

		public function editAction(Request $request, Session $session) {
            $em = $this->getEntityManager();
            $farmer = $session->getUser();

            $formBuilder = $this->getFormBuilder();
            $formBuilder->load('Farmer:farmer/edit_farmer')
                        ->bind(Farmer::class, $em);

            $form = $formBuilder->getForm();
            $form->bindModel($session->getUser());
            $form->handleRequest($request);

            if ($request->method('POST') && $form->isValid()) {
                $farmer = $form->getData();
                
                try {
                    $em->persist($farmer);
                    //$session->setUser($farmer);

                    return $this->render('farmer/edit', [
                        'farmer' => $farmer,
                        'form' => $form
                    ]);
                } catch (DatabaseException $e) {
                    $form->addErrorFromException($e);
                }
            }

            return $this->render('farmer/edit', [
                'farmer' => $farmer,
                'form' => $form
            ]);
		}
	}