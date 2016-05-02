<?php
    namespace StardewTP\Farmer\Controller;

    use Sebastian\Core\Controller\Controller;
    use Sebastian\Core\Http\Exception\HttpException;
    use Sebastian\Core\Http\Request;
    use Sebastian\Core\Http\Response\Response;
    use Sebastian\Core\Http\Response\JsonResponse;
    use Sebastian\Core\Http\Response\RedirectResponse;
    use Sebastian\Core\Session\Session;

    class TradeController extends Controller {
        public function deleteAction(Request $request, $trade) {
            $em = $this->getEntityManager();
            $repo = $em->getRepository('Trade');
            $trade = $repo->get($trade);

            if (!$trade) {
                throw HttpException::notFoundException();
            }

            if ($request->method('POST')) {
                $response = $this->render('trades/delete_success', []);
                //$response->setHeader("Refresh", "5; URL={$this->generateUrl('trades')}");
                return $response;
            } else {
                return $this->render('trades/confirm_delete', [
                    'trade' => $trade
                ]);
            }
        }
    }