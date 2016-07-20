<?php
	namespace SVX\API\Controller;

    use \Exception;

	use Sebastian\Core\Controller\Controller;
    use Sebastian\Core\Http\Exception\HttpException;
	use Sebastian\Core\Http\Request;
	use Sebastian\Core\Http\Response\Response;
    use Sebastian\Core\Http\Response\JsonResponse;
    use Sebastian\Core\Http\Response\RedirectResponse;
    use Sebastian\Core\Session\Session;

    use SVX\Common\Model\Contract;
    use SVX\Common\Model\ContractFulfillment;
    use SVX\Common\Model\ContractItem;

	class ContractController extends Controller {
        public function listAction(Request $request) {
            $em = $this->getEntityManager();
            $contractRepo = $em->getRepository("Contract");

            $contracts = $contractRepo->find();
             return new JsonResponse([
                 'contracts' => $contracts
             ], JsonResponse::HTTP_OK);
        }

        public function overviewAction(Request $request, $contract) {
            $em = $this->getEntityManager();
            $contractRepo = $em->getRepository("Contract");
            $contract = $contractRepo->get($contract);

            if (!$contract) {
                throw HttpException::notFoundException("Contract not found");
            }

            return new JsonResponse([
                'contract' => $contract
            ], JsonResponse::HTTP_OK);
        }

        public function fulfillAction(Request $request, Session $session, $contract) {
            $em = $this->getEntityManager();
            $contractRepo = $em->getRepository("Contract");
            $contract = $contractRepo->get($contract);

            if (!$contract) {
                throw HttpException::notFoundException("Contract not found");
            }

            if ($contract->getRemainingOrders() == 0) {
                return new JsonResponse([
                    'success' => false,
                    'contract' => $contract,
                    'message' => "Contract has already been fulfilled the maximum number of times." 
                ], JsonResponse::HTTP_OK);
            }

            $items = array_map(function($item) use ($contract) {
                return new ContractItem($contract, $item['id'], $item['quantity'], $item['quality']);
            }, $request->body->get('items', []));

            try {
                $this->validateFulfillment($contract, $items);
            } catch (ContractValidationException $e) {
                return new JsonResponse([
                    'success' => false,
                    'contract' => $contract,
                    'message' => $e->getMessage() 
                ], JsonResponse::HTTP_OK);
            }

            $fulfillment = new ContractFulfillment($contract, $session->getUser());
            $contract->decrementRemainingOrders();
            //$contract->setRemainingOrders($contract->getRemainingOrders() - 1);

            if ($contract->getRemainingOrders() === 0) {
                $contract->setStatus(Contract::STATUS_CLOSED);
            }

            //$em->persist($contract, $fulfillment); // todo
            $em->persist($contract);
            $em->persist($fulfillment);

            return new JsonResponse([
                'success' => true,
                'contract' => $contract,
                'payout' => $contract->getPayout()
            ], JsonResponse::HTTP_OK);
        }

        private function validateFulfillment(Contract $contract, array $items) {
            foreach ($contract->getItems() as $contractItem) {
                $continue = false;
                $mContractItem = $contractItem->getItem();

                foreach ($items as $requestItem) {
                    if ($requestItem->equals($contractItem)) {
                        $continue = true;
                        break;
                    }
                }

                if ($continue) continue;

                $name = $mContractItem['name'];
                $id = $mContractItem['id']; 

                throw new ContractValidationException("Missing item or invalid quantity/quality for item {$name} ({$id})");
            }
        }
    }

    class ContractValidationException extends Exception {}