<?php
    namespace SVX\Farmer\Controller;

    use Sebastian\Core\Controller\Controller;
    use Sebastian\Core\Http\Exception\HttpException;
    use Sebastian\Core\Http\Request;
    use Sebastian\Core\Http\Response\Response;
    use Sebastian\Core\Http\Response\JsonResponse;
    use Sebastian\Core\Http\Response\RedirectResponse;
    use Sebastian\Core\Session\Session;

    use SVX\Common\Model\Trade;

    class TradeController extends Controller {
        public function deleteAction(Request $request, $trade) {
            $em = $this->getEntityManager();
            $repo = $em->getRepository('Trade');
            $trade = $repo->get($trade);

            if (!$trade) {
                throw HttpException::notFoundException();
            }

            if ($request->method('POST')) {
                $trade->setStatus(Trade::STATUS_CLOSED);
                $em->persist($trade);

                $response = $this->render('trades/delete_success', []);
                $response->setHeader("Refresh", "5; URL={$this->generateUrl('trades')}");
                return $response;
            } else {
                return $this->render('trades/confirm_delete', [
                    'trade' => $trade
                ]);
            }
        }

        public function purchaseTradeAction(Request $request, Session $session, $trade) {
            $em = $this->getEntityManager();
            $tradeRepo = $em->getRepository('Trade');
            $trade = $tradeRepo->get($trade);

            $order = [];
            $order['trades'][] = $trade;

            if ($request->method('POST')) {
                $trade->setBuyer($session->getUser());
                $trade->setStatus(Trade::STATUS_PENDING);
                $em->persist($trade);
            } else {
                return $this->render('purchase/summary', [
                    'order' => $order
                ]);
            }
        }
    }