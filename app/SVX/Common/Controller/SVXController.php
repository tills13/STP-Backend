<?php
	namespace SVX\Common\Controller;

	use Sebastian\Core\Controller\Controller;
	use Sebastian\Core\DependencyInjection\Injector;
	use Sebastian\Core\Http\Request;
	use Sebastian\Core\Http\Response\Response;
    use Sebastian\Core\Http\Response\JsonResponse;
    use Sebastian\Core\Http\Response\RedirectResponse;
    use Sebastian\Core\Session\Session;

	use Sebastian\Core\Service\ServiceInterface;
	use SVX\Common\Service\TestService;

	class SVXController extends Controller {
		public function indexAction(Request $request) {
			return $this->render('index');
		}

		public function searchAction(Request $request, $query) {
			if ($request->method(Request::METHOD_POST)) {
				return $this->render('search/search_results', [
					'query' => $query,
					'results' => []
				]);
			} else {
				//$query = $request->get('query');
				return $this->render('search/search', [
					'query' => $query
				]);
			}
		}

		public function testAction(Request $request, TestService $service) {
			//$component = $this->getComponent();
			//print ($component->getComponentDirectory());
			die('test');
		}
	}