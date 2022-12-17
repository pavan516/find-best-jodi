<?php

namespace App\Controllers\Query;

use App\Controllers\Controller;

use App\Validation\Forms\Query;


/**
* Controlling Queries
*/
class QueryController extends Controller
{
    public function getContact($request, $response)
    {
        return $this->view->render($response, 'contact/index.twig');
    }
    public function getReport($request, $response)
    {
        return $this->view->render($response, 'report/index.twig');
    }
    public function contact($request, $response)
    {
        // Validation
        $validation = $this->validator->validate($request, Query::rules());
        if ($validation->failed()) {
            return $response->withRedirect($this->router->pathFor('contact'));
        }
        // Mail
        $mail = $this->mail->send( 'email/query/contact/contact.twig', ['name' =>$request->getParam('fullname') ,'email' => $request->getParam('email'), 'query' => $request->getParam('query')], function (\App\Mail\Message $message) {
                $message->to($this->config->get('app.admin-email'), $this->config->get('app.admin'));
                $message->subject("{$this->config->get('app.name')} : Contact Request");
               
         });
        if ($mail) {
            $this->flash->addMessage('success', "Your request has been successfully submitted. We will get back to on this soon.");
        } else
        {
            $this->flash->addMessage('error', "There is a problem occured while submitting your request. Please try again");      
        }
        return $response->withRedirect($this->router->pathFor('contact'));            


    }
    public function report($request, $response)
    {
        // Validation
        $validation = $this->validator->validate($request, Query::rules());
        if ($validation->failed()) {
            return $response->withRedirect($this->router->pathFor('report'));
        }
        // Mail
        $mail = $this->mail->send( 'email/query/report/report.twig', ['name' =>$request->getParam('fullname') ,'email' => $request->getParam('email'), 'query' => $request->getParam('query')], function (\App\Mail\Message $message)  {
                $message->to($this->config->get('app.admin-email'), $this->config->get('app.admin'));
                $message->subject("{$this->config->get('app.name')} : Bug Reported");
               
         });
           if ($mail) {
            $this->flash->addMessage('success', "Thanks for reporting. Your report has been successfully submitted. We will get back to on this soon.");
        } else
        {
            $this->flash->addMessage('error', "There is a problem occured while submitting your request. Please try again");      
        }
        return $response->withRedirect($this->router->pathFor('report')); 
    }
}
