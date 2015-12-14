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


class CompanyController extends Controller 
{
	public function createCatalogAction(){
        
           
		$em = $this->getDoctrine()->getEntityManager();
		$request = $this->getRequest();
        $catalogName = $request->get('catalogName');
        /////////////////////////////////////////////
        $filename = $_FILES["file"]["name"];
        $name_extension = explode('.', $filename);  
        $imageName = $catalogName.'.'.$name_extension[1];
        ///////////////////////////////////////////
        $catalogCategory = $request->get('catalogCategory');
        $creationDate = $request->get('creationDate');
        $catalog = new Catalog();
        $catalog->setCatalogName($catalogName);
        $catalog->setCatalogCategory($catalogCategory);
        $catalog->setCreationDate($creationDate);
        $catalog->setCatalogPhoto($imageName);
        $catalog->setUser($this->getUser());
        $em->persist($catalog);
        $em->flush();
        $this->uploadCatalogPicture($catalogName,$imageName);
	}

	public function uploadCatalogPicture($catalogName,$imageName){
		if ( !empty( $_FILES ) ) {
            $tempPath = $_FILES[ 'file' ][ 'tmp_name' ];
            $filename = $_FILES["file"]["name"];
            $userEmail = $this->getUserEmail();
            mkdir('C:\xampp\htdocs\CatalogProject\companies/'.$userEmail.'\catalogs/'.$catalogName,null,true);
            $uploadPath  = ('C:\xampp\htdocs\CatalogProject\companies' . DIRECTORY_SEPARATOR . $userEmail . DIRECTORY_SEPARATOR . 'catalogs' . DIRECTORY_SEPARATOR . $catalogName. DIRECTORY_SEPARATOR . $imageName);
            move_uploaded_file( $tempPath, $uploadPath );
            $answer = array( 'answer' => 'File transfer completed' );
            $json = json_encode( $answer );
            echo $json;
        } 
        else echo 'No files';
	}
    public function getCatalogsAction(){
        
        $user = $this->getUser();
        $userId = $user->getId();
        $usermail = $user->getEmail();
        $catalogs = $this->getDoctrine()->getRepository('CatalogProjectAppManagementBundle:Catalog')->findByUser($user);
        for($i=0 ; $i<count($catalogs) ; $i++){
            $logoPath = 'companies' .'/'. $usermail .'/'. 'catalogs' .'/' . $catalogs[$i]->catalogName .'/'. $catalogs[$i]->catalogPhoto ;
             $array[$i] = array( 'logoPath' => $logoPath , 
                                 'catalogName' =>$catalogs[$i]->catalogName,
                                 'catalogCategory'=>$catalogs[$i]->catalogCategory,
                                 'creationDate' => $catalogs[$i]->creationDate);
        }

        return $array;


    }
    public function getAllCatalogsAction(){
        $companies = $this->getDoctrine()->getRepository('CatalogProjectUserBundle:User')->findBy(array('type'=>'company')); 
      for ($j=0; $j < count($companies) ; $j++) { 
        $companyEmail = $companies[$j]->getEmail();
        
        $catalogs = $this->getDoctrine()->getRepository('CatalogProjectAppManagementBundle:Catalog')->findByUser($companies[$j]);
      
        for ($i=0; $i < count($catalogs) ; $i++) { 
            $logoPath = 'companies/'.$companyEmail.'/catalogs/'.$catalogs[$i]->catalogName.'/'.$catalogs[$i]->catalogPhoto; 
                $array[$i] = array( 'logoPath' => $logoPath , 
                                 'catalogName' =>$catalogs[$i]->catalogName,
                                 'catalogCategory'=>$catalogs[$i]->catalogCategory,
                                 'creationDate' => $catalogs[$i]->creationDate);
        }
       

            $array1[$j] = $array;
        

     }
      return $array1;
    }
	
	public function getUserEmail(){
        $user =$this->getUser();
        return $user->email;
    }
     
}