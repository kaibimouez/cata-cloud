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
        $catalogCategory = $request->get('catalogCategory');
        $creationDate = $request->get('creationDate');
        $startDate = $request->get('startDate');
        $endDate = $request->get('endDate');
        $start = substr($startDate, 0,10);
        $end = substr($endDate, 0,10);
        /////////////////////////////////////////////
        $filename = $_FILES["file"]["name"];
        $name_extension = explode('.', $filename);  
        $imageName = $catalogName.'.'.$name_extension[1];
        ///////////////////////////////////////////
        $catalog = new Catalog();
        $catalog->setCatalogName($catalogName);
        $catalog->setCatalogCategory($catalogCategory);
        $catalog->setCreationDate($creationDate);
        $catalog->setStartDate($start);
        $catalog->setEndDate($end);
        $catalog->setNbLikes(0);
        $catalog->setNbViews(0);
        $catalog->setCatalogPhoto($imageName);
        $catalog->setUser($this->getUser());
        $em->persist($catalog);
        $em->flush();
        $this->uploadCatalogPicture($catalogName,$imageName);
        return new JsonResponse($catalog,200);
        
	}

	public function uploadCatalogPicture($catalogName,$imageName){
		if ( !empty( $_FILES ) ) {
            $tempPath = $_FILES[ 'file' ][ 'tmp_name' ];
            $filename = $_FILES["file"]["name"];
            $userEmail = $this->getUserEmail();
            mkdir(__DIR__.'../../../../../companies/'.$userEmail. DIRECTORY_SEPARATOR .'catalogs'. DIRECTORY_SEPARATOR .$catalogName,null,true);
            $uploadPath  = (__DIR__.'../../../../../companies/' . DIRECTORY_SEPARATOR . $userEmail . DIRECTORY_SEPARATOR . 'catalogs' . DIRECTORY_SEPARATOR . $catalogName. DIRECTORY_SEPARATOR . $imageName);
            move_uploaded_file( $tempPath, $uploadPath );
        } 
        else return new JsonResponse('Catalog not Created,please try again',500);
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
                                 'creationDate' => $catalogs[$i]->creationDate,
                                 'startDate' => $catalogs[$i]->startDate,
                                 'endDate' => $catalogs[$i]->endDate,
                                 'id' => $catalogs[$i]->id,
                                 'user_id' => $catalogs[$i]->user->id,
                                 'nbLikes' => $catalogs[$i]->nbLikes,
                                 'nbViews' => $catalogs[$i]->nbViews);
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
                                     'creationDate' => $catalogs[$i]->creationDate,
                                     'startDate' => $catalogs[$i]->startDate,
                                     'endDate' => $catalogs[$i]->endDate,
                                     'id' => $catalogs[$i]->id,
                                     'user_id' => $catalogs[$i]->user->id,
                                     'nbLikes' => $catalogs[$i]->nbLikes,
                                     'nbViews' => $catalogs[$i]->nbViews);   
                }
            $array1[$j]= $array;
            $array = array();
        }
        return $array1;
    }
	
	public function getUserEmail(){
        $user =$this->getUser();
        return $user->email;
    }

    public function setNbLikesCatalogAction(){
        $em = $this->getDoctrine()->getEntityManager();
        $request = $this->getRequest();
        $catalogId = $request->get('catalogId');
        $companyId = $request->get('companyId');
        $catalog = $this->getDoctrine()->getRepository('CatalogProjectAppManagementBundle:Catalog')->findOneBy(array('id'=>$catalogId , "user"=>$companyId));
        $catalog->setNbLikes($catalog->getNbLikes()+1);
        $em->persist($catalog);
        $em->flush();
        
    }
    
}