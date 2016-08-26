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

    use SVX\Common\Entity\Trade;
    use SVX\Common\Entity\TradeItem;

	class TradeController extends Controller {
		public function newAction(Request $request, Session $session) {
			$em = $this->getEntityManager();
			$farmerRepo = $em->getRepository('Farmer');

			if (($currentUser = $session->getUser()) === null) {
				throw HttpException::forbiddenException("Not authorized to create trades, you must sign in...");
			}

			$farmer = $request->body->get('farmer_id', $currentUser->getId());
			$farmer = $farmerRepo->get($farmer);

			if (!$farmer) {
				throw HttpException::notFoundException("Could not create a trade under that user...");
			} else if (!$currentUser->isAdmin() && !$farmer->equals($currentUser)) {
				throw HttpException::forbiddenException("Not authorized to create trades for other users...");
			}

			$trade = new Trade();
			$trade->setTitle($request->body->get('title', null));
			$trade->setAskingPrice($request->body->get('asking_price'));
			$trade->setSeller($farmer);

			$items = [];
			foreach ($request->body->get('items', []) as $item) { 
				$items[] = new TradeItem($trade, $item['id'], $item['amount'], $item['quality']);
			}

			$trade->setItems($items);
			$em->persist($trade);

			return new JsonResponse([
				'trade' => $trade
			]);
		}

		public function overviewAction(Request $request, $trade) {
			$em = $this->getEntityManager();
			$tradeRepo = $em->getRepository("Trade");
			$trade = $tradeRepo->get($trade);
			
			return new JsonResponse([
				'trade' => $trade
			], Response::HTTP_OK);
		}
	}