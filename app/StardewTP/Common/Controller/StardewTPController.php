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

		public function heartbeatAction(Request $request) {
			return new JsonResponse([
				'message' => 'All Good!'
			], Response::HTTP_OK);
		}
	}