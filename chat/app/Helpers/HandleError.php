<?php 

namespace App\Helpers;
use Slim\Views\Twig;
use Slim\Handlers\Error;
use App\Helpers\Log;
use Slim\Http\Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Noodlehaus\Config;
use App\Mail\Message;
use App\Mail\Mailer;

class HandleError 
{
    protected $error;
    protected $response;
    protected $view;
    protected $mail;
    protected $log;
    protected $config;
    public function __construct(Twig $view, Log $log, Mailer $mail, Config $config)
    {
        $this->response = new Response;
        $this->error = new Error;
        $this->view = $view;
        $this->log = $log;
        $this->mail = $mail;
        $this->config = $config;
    }

    // final public string Error::getMessage ( void )
    // final public Throwable Error::getPrevious ( void )
    // final public mixed Error::getCode ( void )
    // final public string Error::getFile ( void )
    // final public int Error::getLine ( void )
    // final public array Error::getTrace ( void )
    // final public string Error::getTraceAsString ( void )
    // public string Error::__toString ( void )
    // final private void Error::__clone ( void )
    protected function prepareLog($request, $error = []) {
        $parseRequest[] = $request->getParsedBody();
        if ($error) {
            $parseError[] =  ['file' => $error->getFile(), 'line' => $error->getLine()];
             return array_merge($parseError, $parseError);
        }
        return $parseRequest;
       

    }
    public function phpError($request,$response,$error)
    {   
        $this->log->error()->critical($error->getMessage(), $this->prepareLog($request, $error));
        $this->send($request, "phpError", $error);
        return $this->view->render($response, 'error/custom.twig', ['error' => $error , 'type' => 'phpError' ]);
    }
    public function error($request,$response,$error)
    {   
        $this->send($request, "Error", $error);
        $this->log->error()->critical($error->getMessage(), $this->prepareLog($request, $error));
        return $this->view->render($response, 'error/custom.twig', ['error' => $error , 'type' => 'Error' ]);
    }
    public function notFound($request,$response)
    {   
        $this->send($request, "notFound");
        $this->log->error()->critical("404", $this->prepareLog($request));      
        return $this->view->render($response, 'error/404.twig');
    }
    public function notAllowed($request,$response)
    {   
        $this->send($request, "notAllowed");
        $this->log->error()->critical("405", $this->prepareLog($request));      
        return $this->view->render($response, 'error/405.twig');
    }
    public function csrf($request,$response)
    {   
        $this->send($request, "csrf");
        $this->log->error()->critical("csrf attempt", $this->prepareLog($request));      
        return $this->view->render($response, 'error/csrf.twig');
    }
    public function send($request,$type ,$error = null)
    {
        if (!$request->getParsedBody()) {
            $formdata = "No form data engaged";
        } else {
            $formdata = $request->getParsedBody();
        }
        if ($request)
        {
            $url = $request->getUri()->getPath();
            $method = $request->getMethod();
            $useragent = json_encode($request->getHeader('HTTP_USER_AGENT'));
            $contenttype = json_encode($request->getHeader('CONTENT_TYPE'));
            $ref = json_encode($request->getHeader('HTTP_REFERER')); 

           
        }
        $ip = $_SERVER['REMOTE_ADDR'];
        $time =  date("Y-m-d h:i:sA", time()); 

        $message = "No Message";
        $file ="No file engaged";
        $line = "Not Available";
        if ($error) {
            $message = $error->getMessage();
            $file = $error->getFile();
            $line = $error->getLine();
        }
        
        $array = [
            'message' => $message,
            'type' => $type,
            'file_name' =>  str_replace('\\', '/', $file),
            'line_no' => $line,
            'data' => $formdata,
            'useragent' => $useragent,
            'contenttype' => $contenttype,
            'ip' => $ip,
            'method' => $method,
            'server' => "Main",
            'ref' => $ref,
            'time' => $time,
        ];
        // return $this->mail->send( 'email/error/report.twig', ['array' => $array ], function (Message $message) use ($type)  {
        //             $message->to($this->config->get('app.developer.email'), $this->config->get('app.developer.name'));
        //             $message->subject("{$this->config->get('app.name')} : Error Report - {$type}");              
        //         });
    }

}