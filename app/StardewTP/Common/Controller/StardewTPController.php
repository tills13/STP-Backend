<?php
	namespace StardewTP\Common\Controller;

	use Sebastian\Core\Controller\Controller;
	use Sebastian\Core\Http\Request;
	use Sebastian\Core\Http\Response\Response;
    use Sebastian\Core\Http\Response\JsonResponse;
    use Sebastian\Core\Http\Response\RedirectResponse;
    use Sebastian\Core\Session\Session;

	class StardewTPController extends Controller {
		public function indexAction(Request $request) {
			return $this->render('index');
		}

		public function searchAction(Request $request) {
			if ($request->method(Request::METHOD_POST)) {
				// do the search
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
			return new JsonResponse([
				'message' => 'All Good!'
			], Response::HTTP_OK);
		}

		public function testAction(Request $request) {
			$formBuilder = $this->getFormBuilder();
			$formBuilder->create('login');

			$formBuilder->add('test1', 'text');
			$formBuilder->add('test2', 'text');

			$form = $formBuilder->getForm();
			$form->handleRequest($request);

			if ($request->method("POST")) {

			}

			return $this->render('test/test', [
				'form' => $form
			]);
		}
	}