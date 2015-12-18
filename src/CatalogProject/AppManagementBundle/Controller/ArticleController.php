<?php
namespace CatalogProject\AppManagementBundle\Controller;

header("Access-Control-Allow-Origin: *");
use CatalogProject\UserBundle\Entity\User;
use CatalogProject\AppManagementBundle\Entity\Catalog;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\HttpNotFoundException;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Core\Authentication\Token\AnonymousToken;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\Put;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\Controller\Annotations\QueryParam;
use FOS\RestBundle\Request\ParamFetcher;
use FOS\RestBundle\View\View AS FOSView;
use FOS\RestBundle\Controller\FOSRestController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\Security\Core\SecurityContextInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use FOS\UserBundle\Model\UserInterface;
use FOS\RestBundle\Routing\ClassResourceInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Session\Session;
use FOS\UserBundle\Model;


class ArticleController extends Controller 
{
	public function articleUploadAction(){
		$request = $this->getRequest();
        $catalogName = $request->get('catalogName');
        //var_dump($catalogName);die();
	    $tempPath = $_FILES[ 'file' ][ 'tmp_name' ];
	    //$uploadPath = dirname( __FILE__ ) . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . $_FILES[ 'file' ][ 'name' ];
	    $uploadPath = 'C:/xampp/'. $_FILES[ 'file' ][ 'name' ];
	    move_uploaded_file( $tempPath, $uploadPath );
	    $answer = array( 'answer' => 'File transfer completed' );
	    $json = json_encode( $answer );
	    echo $json;    
	}
	

}