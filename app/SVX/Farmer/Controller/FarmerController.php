<?php
	namespace SVX\Farmer\Controller;

	use Sebastian\Core\Controller\Controller;
	use Sebastian\Core\Http\Request;
	use Sebastian\Core\Http\Response\Response;
    use Sebastian\Core\Http\Response\JsonResponse;
    use Sebastian\Core\Http\Response\RedirectResponse;
    use Sebastian\Core\Session\Session;

    use SVX\Common\Model\Farmer;

	class FarmerController extends Controller {
		public function editAction(Request $request, Session $session) {
            //$session->reload();
            $em = $this->getEntityManager();
            $farmer = $session->getUser();

            $formBuilder = $this->getFormBuilder();
            $formBuilder->load('Farmer:farmer/edit_farmer')
                        ->bind(Farmer::class, $em);

            $form = $formBuilder->getForm();
            $form->bindModel($farmer);
            $form->handleRequest($request);

            if ($request->method('POST') && $form->isValid()) {
                $farmer = $form->getData();
                $em->persist($farmer);
                $session->setUser($farmer);

                return;
            }

            return $this->render('farmer/edit', [
                'farmer' => $farmer,
                'form' => $form
            ]);
		}
	}