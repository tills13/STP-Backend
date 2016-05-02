<?php
	namespace StardewTP\API\Controller;

	use Sebastian\Core\Controller\Controller;
	use Sebastian\Core\Http\Request;
	use Sebastian\Core\Http\Response\Response;
    use Sebastian\Core\Http\Response\JsonResponse;
    use Sebastian\Core\Http\Response\RedirectResponse;
    use Sebastian\Core\Session\Session;

    use StardewTP\Common\Entity\Trade;
    use StardewTP\Common\Entity\TradeItem;

	class TradeController extends Controller {
		public function newAction(Request $request, Session $session) {
			$em = $this->getEntityManager();
			$farmerRepo = $em->getRepository('Farmer');
			$farmer = $farmerRepo->get($request->body->get('farmer_id'));

			if (!$farmer) {
				throw new \Exception("Error Processing Request", 1);
			}

			$trade = new Trade();
			$trade->setAskingPrice($request->body->get('asking_price'));
			$trade->setSeller($farmer);

			$items = [];
			foreach ($request->body->get('items', []) as $item) { 
				$items[] = new TradeItem($trade, rand(0, 150), $item['amount'], $item['quality']);
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