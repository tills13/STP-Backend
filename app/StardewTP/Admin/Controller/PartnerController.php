<?php
    namespace StardewTP\Admin\Controller;

    use Sebastian\Core\Controller\Controller;
    use Sebastian\Core\Http\Request;
    use Sebastian\Core\Http\Response\RedirectResponse;
    use Sebastian\Utility\Utility\Utils;

    use StardewTP\Common\Model\Contract;
    use StardewTP\Common\Model\Partner;

    class PartnerController extends \StardewTP\Common\Controller\PartnerController {
        public function newContractAction(Request $request, $partner) {
            $em = $this->getEntityManager();
            $repo = $em->getRepository('Partner');
            $partner = $repo->get($partner);

            $formBuilder = $this->getFormBuilder();
            $formBuilder->create('new_contract_form')
                    ->method("POST")
                    ->attribute('class', '')
                    ->bind(Partner::class, $em)
                    ->add('title', 'text', [
                        'id' => 'title',
                        'class' => 'form-control',
                        'placeholder' => 'Title'
                    ])->add('description', 'textarea', [
                        'id' => 'description',
                        'class' => 'form-control',
                        'rows' => 8,
                        'placeholder' => 'Description'
                    ])->add('payout', 'text', [
                        'id' => 'description',
                        'class' => 'form-control',
                        'placeholder' => 'Payout'
                    ]);

            $form = $formBuilder->getForm();
            $form->handleRequest($request);

            if ($request->method("POST")) {
                $title = $form->get('title')->getValue();
                $description = $form->get('description')->getValue();
                $payout = $form->get('payout')->getValue();

                $contract = new Contract();
                $contract->setTitle($title);
                $contract->setDescription($description);
                $contract->setPayout($payout);
                $contract->setOwner($partner);
                
                $em->persist($contract);

                return new RedirectResponse($this->generateUrl('partners:overview', [
                    'partner' => $partner->getId()
                ]));
            } else {
                return $this->render('partners/contracts/new', [
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
            $formBuilder->load('Admin:partners/edit_partner')
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

            return $this->render('partners/edit', [
                'partner' => $partner,
                'form' => $form
            ]);
        } 
    }