<?php
    namespace SVX\Admin\Controller;

    use Sebastian\Core\Controller\Controller;
    use Sebastian\Core\Http\Request;
    use Sebastian\Core\Http\Response\RedirectResponse;
    use Sebastian\Utility\Utility\Utils;

    use SVX\Common\Model\Contract;
    use SVX\Common\Model\Partner;

    class PartnerController extends \SVX\Common\Controller\PartnerController {
        public function listAction(Request $request) {
            $em = $this->getEntityManager();
            $repo = $em->getRepository('Partner');
            $partners = $repo->find([], [
                'orderBy' => [
                    'id' => 'asc', 
                    'name' => 'desc'
                ]
            ]);

            return $this->render('partner/list', [
                'partners' => $partners
            ]);
        }

        public function newAction(Request $request) {
            $em = $this->getEntityManager();
            $partner = new Partner();
            $partner->setName("New Partner");

            $formBuilder = $this->getFormBuilder();
            $formBuilder->load('Admin:partner/edit_partner')
                        ->attribute('id', 'new-partner')
                        ->bind(Partner::class, $em);

            $form = $formBuilder->getForm();
            $form->bindModel($partner);
            $form->handleRequest($request);

            $logoDir = implode(DIRECTORY_SEPARATOR, [
                $this->getContext()->getWebDirectory(),
                'assets',
                'logos'
            ]);

            $logos = array_diff(scandir($logoDir), ['.', '..']);

            if ($request->method('POST') && $form->isValid()) {
                $partner = $form->getData();
                $partner = $em->persist($partner);

                return new RedirectResponse($this->generateUrl('partners:overview', [
                    'partner' => $partner->getId()
                ]));
            }

            return $this->render('partner/new', [
                'partner' => $partner,
                'form' => $form,
                'logos' => $logos
            ]);
        }

        public function newContractAction(Request $request, $partner) {
            $em = $this->getEntityManager();
            $repo = $em->getRepository('Partner');
            $partner = $repo->get($partner);

            $formBuilder = $this->getFormBuilder();
            $formBuilder->load('Admin:partner/new_contract')
                        ->bind(Contract::class, $em);

            $form = $formBuilder->getForm();
            $form->bindModel(new Contract());
            $form->handleRequest($request);

            if ($request->method("POST") && $form->isValid()) {
                $contract = $form->getData();
                $contract->setOwner($partner);
                
                $em->persist($contract);

                return new RedirectResponse($this->generateUrl('partners:overview', [
                    'partner' => $partner->getId()
                ]));
            } else {
                return $this->render('partner/contracts/new', [
                    'partner' => $partner,
                    'form' => $form
                ]);
            }
        }

        public function editAction(Request $request, $partner) {
            $em = $this->getEntityManager();
            $repo = $em->getRepository('Partner');
            $partner = $repo->get($partner);

            $formBuilder = $this->getFormBuilder();
            $formBuilder->load('Admin:partner/edit_partner')
                        ->bind(Partner::class, $em);

            $form = $formBuilder->getForm();
            $form->bindModel($partner);
            $form->handleRequest($request);

            if ($request->method('POST') && $form->isValid()) {
                $partner = $form->getData();
                $em->persist($partner);

                return new RedirectResponse($this->generateUrl('partners:overview', [
                    'partner' => $partner->getId()
                ]));
            }

            return $this->render('partner/edit', [
                'partner' => $partner,
                'form' => $form
            ]);
        } 
    }