<?php
	namespace StardewTP\Common\Controller;

	use Sebastian\Core\Controller\Controller;
	use Sebastian\Core\Http\Request;
	use Sebastian\Core\Http\Response\Response;
    use Sebastian\Core\Http\Response\JsonResponse;
    use Sebastian\Core\Http\Response\RedirectResponse;
    use Sebastian\Core\Session\Session;

	class SecurityController extends Controller {
		public function loginAction(Request $request, Session $session) {
			$formBuilder = $this->getFormBuilder();
            $formBuilder->create('login_form')
                    ->method("POST")
                    ->attribute('class', 'login-form form-horizontal')
                    ->add('username', 'text', [
                    	'id' => 'login-username',
                        'class' => 'form-control',
                        'placeholder' => 'Username'
                    ])->add('password', 'password', [
                    	'id' => 'login-password',
                        'class' => 'form-control',
                        'placeholder' => 'Password'
                    ]);

            $form = $formBuilder->getForm();
            $form->handleRequest($request);

			if ($request->method('POST')) {
				$em = $this->getEntityManager();
        		$repo = $em->getRepository('Farmer');

        		$username = $form->get('username')->getValue();
                $password = $form->get('password')->getValue();

                if ($repo->login($username, $password)) {
            		$result = $repo->find(['username' => $username]);
                    if (!empty($result)) {
                        $session->setUser($result[0]);
                        return new RedirectResponse("/");
                    } else {
                        throw new \Exception("Incorrect login...");
                    }
            	} else {
                    //$form->addError();
                }
			}

            $form->get('password')->setValue(null);
            return $this->render('auth/login', [
				'form' => $form
			]);
		}

        public function registerAction(Request $request, Session $session) {
            $formBuilder = $this->getFormBuilder();
            $formBuilder->create('register_form')
                    ->method("POST")
                    ->attribute('class', 'login-form form-horizontal')
                    ->add('username', 'text', [
                        'id' => 'login-username',
                        'class' => 'form-control',
                        'placeholder' => 'Username'
                    ])->add('email', 'text', [
                        'id' => 'login-email',
                        'class' => 'form-control',
                        'placeholder' => 'Email'
                    ])->add('unique_id', 'text', [
                        'id' => 'login-unique_id',
                        'class' => 'form-control',
                        'placeholder' => 'Unique Id'
                    ])->add('password', 'password', [
                        'id' => 'login-password',
                        'class' => 'form-control',
                        'placeholder' => 'Password'
                    ])->add('confirm_password', 'password', [
                        'id' => 'login-confirm-password',
                        'class' => 'form-control',
                        'placeholder' => 'Confirm Password'
                    ]);

            $form = $formBuilder->getForm();
            $form->handleRequest($request);

            if ($request->method('POST')) {
                $em = $this->getEntityManager();
                $repo = $em->getRepository('Farmer');

                $username = $form->get('username')->getValue();
                $email = $form->get('email')->getValue();
                $password = $form->get('password')->getValue();
                $uniqueId = $form->get('unique_id')->getValue();
                $confirmPassword = $form->get('confirm_password')->getValue();

                if ($password != $confirmPassword) {

                } else {
                    try {
                        $id = $repo->register($uniqueId, $username, $email, $password);
                        $farmer = $repo->get($id);
                        $session->setUser($farmer);

                        return new RedirectResponse("/");
                    } catch (\PDOException $e) {

                    }
                }
            }

            return $this->render('auth/register', [
                'form' => $form
            ]);
        }

        public function logoutAction(Session $session) {
            $session->destroy();
            return new RedirectResponse($this->generateUrl('index'));
        }
	}