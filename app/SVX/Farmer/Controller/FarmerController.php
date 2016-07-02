<?php
	namespace SVX\Farmer\Controller;

    use \PDOException;

	use Sebastian\Core\Controller\Controller;
    use Sebastian\Core\Database\Exception\DatabaseException;
	use Sebastian\Core\Http\Request;
	use Sebastian\Core\Http\Response\Response;
    use Sebastian\Core\Http\Response\JsonResponse;
    use Sebastian\Core\Http\Response\RedirectResponse;
    use Sebastian\Core\Session\Session;

    use SVX\Common\Model\Farmer;

	class FarmerController extends Controller {
        public function overviewAction(Request $request, Session $session) {
            $em = $this->getEntityManager();
	        $tradeRepo = $em->getRepository('Trade');    

            $expression = $em->expr()->orExpr(
                $em->expr()->eq('seller', "'{$session->getUser()->getId()}'"),
                $em->expr()->eq('buyer', "'{$session->getUser()->getId()}'")
            );

            $trades = $tradeRepo->find([$expression]);

            return $this->render('farmer/overview', [
                'farmer' => $session->getUser(),
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