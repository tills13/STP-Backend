<?php
	namespace StardewTP\Farmer\Controller;

	use Sebastian\Core\Controller\Controller;
	use Sebastian\Core\Http\Request;
	use Sebastian\Core\Http\Response\Response;
    use Sebastian\Core\Http\Response\JsonResponse;
    use Sebastian\Core\Http\Response\RedirectResponse;
    use Sebastian\Core\Session\Session;

	class FarmerController extends Controller {
		public function editAction(Request $request, Session $session) {
            $session->reload();
            $farmer = $session->getUser();
			return new Response("Last Sync: " . $farmer->getLastSync()->format('Y-m-d G:i:s'));
		}
	}