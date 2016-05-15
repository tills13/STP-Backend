<?php
    namespace StardewTP\Admin\Controller;

    use Sebastian\Core\Controller\Controller;
    use Sebastian\Core\Http\Request;
    use Sebastian\Core\Http\Response\RedirectResponse;
    use Sebastian\Utility\Utility\Utils;

    use StardewTP\Common\Entity\Contract;

    class PartnerController extends \StardewTP\Common\Controller\PartnerController {
        public function newContractAction(Request $request, $partner) {
            $em = $this->getEntityManager();
            $repo = $em->getRepository('Partner');
            $partner = $repo->get($partner);

            $formBuilder = $this->getFormBuilder();
            $formBuilder->create('new_contract_form')
                    ->method("POST")
                    ->attribute('class', '')
                    ->add('title', 'text', [
                        'id' => 'title',
                        'class' => 'form-control',
                        'placeholder' => 'Title'
                    ])->add('description', 'text', [
                        'id' => 'description',
                        'class' => 'form-control',
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

                return new RedirectResponse($this->generateUrl('partners:overview', ['partner' => $partner->getId()]));
            } else {
                return $this->render('partners/contracts/new', [
                    'partner' => $partner,
                    'form' => $form
                ]);
            }
        }
    }