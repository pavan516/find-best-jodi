<?php

namespace App\Controllers\Home;

use App\Controllers\Controller;

class HomeController extends Controller
{
    public function index( $request, $response)
    {

		$recipient = 0;
		if (null !==  ($request->getParam('user_name'))){
			$recipient = $this->user->where('user_name',$request->getParam('user_name'))->first()->user_id;
			if (!$recipient) {
				$recipient = 0;
			}
			
		}
		
		
		
		
        $user_email = $_SESSION['user_email'];

	
        $user = $this->user->where('user_email', $user_email)->first();
		if (!$user) {
			return $response->withRedirect("/");
		}
        return $this->view->render($response, 'home/index.twig', ['user' => $user , 'conversation' => new $this->conversationpivot , 'auto_user' => $recipient ]);
    }

}