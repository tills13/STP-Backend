<?php
    namespace SVX\Admin\Controller;

    use Sebastian\Core\Controller\Controller;
    use Sebastian\Core\Http\Request;
    use Sebastian\Core\Http\Response\RedirectResponse;
    use Sebastian\Utility\Utility\Utils;

    use SVX\Common\Entity\Contract;
    use SVX\Common\Entity\ContractItem;
    use SVX\Common\Entity\Partner;

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

            $items = $this->getConnection()->execute('SELECT id,name FROM items i ORDER BY i.name ASC');

            $formBuilder = $this->getFormBuilder();
            $formBuilder->load('Admin:partner/new_contract', [ 'items' => $items ])
                        ->bind(Contract::class, $em);

            $form = $formBuilder->getForm();
            $form->bindModel(new Contract());
            $form->handleRequest($request);

            if ($request->method("POST") && $form->isValid()) {
                $contract = $form->getData();
                $contract->setOwner($partner);

                $items = $request->get("{$form->getName()}.items.item");
                $qualities = $request->get("{$form->getName()}.items.quality");
                $quantities = $request->get("{$form->getName()}.items.quantity");

                for ($i = 0; $i < count($items); $i++) {
                    $mItem = new ContractItem($contract, $items[$i], $quantities[$i], $qualities[$i]);
                    $contract->addItem($mItem);
                }

                $em->persist($contract);

                return new RedirectResponse($this->generateUrl('partners:overview', [
                    'partner' => $partner->getId()
                ]));
            } else {
                return $this->render('partner/contract/new', [
                    'partner' => $partner,
                    'items' => $this->getConnection()->execute('SELECT id,name FROM items i ORDER BY i.name ASC'),
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