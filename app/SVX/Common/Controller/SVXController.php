<?php
	namespace SVX\Common\Controller;

	use Sebastian\Core\Controller\Controller;
	use Sebastian\Core\Http\Request;
	use Sebastian\Core\Http\Response\Response;
    use Sebastian\Core\Http\Response\JsonResponse;
    use Sebastian\Core\Http\Response\RedirectResponse;
    use Sebastian\Core\Session\Session;

	class SVXController extends Controller {
		public function indexAction(Request $request) {
			return $this->render('index');
		}

		public function searchAction(Request $request) : Response {
			if ($request->method(Request::METHOD_POST)) {
				$query = $request->get('query', '');
				return $this->render('search/search_results', [
					'query' => $query,
					'results' => []
				]);
			} else {
				return $this->render('search/search', ['query' => '']);
			}
		}

		public function heartbeatAction(Request $request) {
			return new Response(1, Response::HTTP_OK);
		}

		public function testAction(Request $request) {
			$service = $this->get('service.test_service');
			
			die();

			/*return $this->render('test/test', [
				'form' => $form
			]);*/
		}
	}