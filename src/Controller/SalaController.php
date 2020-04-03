<?php

namespace App\Controller;

use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;


class SalaController extends AbstractController
{
    /**
     * @Route("/saude/sala", name="sala")
     */
    public function index(Request $request)
    { 
        $data = json_decode($request->getContent(), true);

        if( $this->validarRequisicao($request) ){
            return $this->json([ 
                "result"=>true,
                "message"=>"Voce será redirecionado para sala virtual de atendimento. Se você não for redirecionado, ",
                "redirect"=>"https://meet.jit.si/ddtqssi",
                "token válido"=>$data['token'] 
            ]);
        }else{
            return $e =  new Exception("Error Processing Request", 1);
        }
  
        // return $this->render('sala/index.html.twig', [
        //     'controller_name' => 'SalaController',
        // ]);
    }
 

    protected function validarRequisicao(Request $request)
    {
        if (0 !== strpos($request->headers->get('Content-Type'), 'application/json')) {
            throw new \InvalidArgumentException("A requisição precisa conter cabeçalho application/json");
        }

        $data = json_decode($request->getContent(), true);
  
        if( !isset($data['token']) ) {
            throw new \InvalidArgumentException("A requisição não contém todas as informações.");
        }else{
            return true;
        }
 
    }//validarRequisicao

}
