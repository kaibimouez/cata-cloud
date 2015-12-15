<?php
namespace CatalogProject\UserBundle\Controller;

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


class SigninController extends Controller 
{
      protected function getUserManager()
    {
        return $this->get('fos_user.user_manager');
    }

    protected function loginUser(User $user)
    {
        $security = $this->get('security.context');
        $providerKey = $this->container->getParameter('fos_user.firewall_name');
        $roles = $user->getRoles();
        $token = new UsernamePasswordToken($user, null, $providerKey, $roles);
        $security->setToken($token);
    }

    protected function logoutUser()
    {
        $security = $this->get('security.context');
        $token = new AnonymousToken(null, new User());
        $security->setToken($token);
        $this->get('session')->invalidate();
    }

    protected function checkUserPassword(User $user, $password)
    {
        $factory = $this->get('security.encoder_factory');
        $encoder = $factory->getEncoder($user);
        if(!$encoder){
            return false;
        }
        return $encoder->isPasswordValid($user->getPassword(), $password, $user->getSalt());
    }

    public function loginAction()
    {
        $view = FOSView::create();
        $request = $this->getRequest();
        //$userType = $request->get('type');
        $email = $request->get('email');
        $username = $email;
        $password = $request->get('password');
        $um = $this->getUserManager();
        $user = $um->findUserByUsername($username);

        if(!$user){
            $user = $um->findUserByEmail($username);
        }

        if(!$user instanceof User){
            $result['isLogged'] = false;
            $result['error'] = "Oups User not found !!!";
            $view->setStatusCode(500)->setData($result);
            return $view;
        }

        if(!$this->checkUserPassword($user, $password)){
            $result['isLogged'] = false;
            $result['error'] = "Oups Wrong password !!!";
            $view->setStatusCode(500)->setData($result);
            return $view;
        }

        $this->loginUser($user);
        if($user->isEnabled() == true){
            $result['isLogged'] = true;
            $result['isActive'] = true;
            $view->setStatusCode(200)->setData($result);
            return $view;
        }
        else {
            if($user->type == "user"){
                $result['isLogged'] = true;
                $result['isActive'] = false;
                $view->setStatusCode(200)->setData($result);
                $result['id'] = $user->id;
                $result['type'] = $user->type;
                return $result;  
            }    
            else if($user->type == "company"){
                $result['isLogged'] = true;
                $result['isActive'] = false;
                $view->setStatusCode(200)->setData($result);
                $result['id'] = $user->id;
                $result['type'] = $user->type;
                return $result;  
            }
        }
    }

    public function logoutAction()
    {
       $view = FOSView::create();
       $this->logoutUser();
       $user1 =$this->get('security.context')->getToken()->getUser();
       $result['isLogout'] = true;
       $view->setStatusCode(200)->setData($result);
       return $view;
    }
    public function isConnectedAction(){
          $user =$this->getUser();
          if($user){
            return new JsonResponse(true,200);
          }
          else {
             return new JsonResponse(false,500);
          }
    }
    
    public function getUserAction(){

        $user =$this->getUser();
       return new JsonResponse($user,200);
    }
    public function getUserEmail(){
        $user =$this->getUser();
        return $user->email;
    }
    public function uploadAction(){
        $em = $this->getDoctrine()->getEntityManager();
        $request = $this->getRequest();
        $catalogName = $request->get('catalogName');
        $catalogCategory = $request->get('catalogCategory');
        $creationDate = $request->get('creationDate');

       

            if ( !empty( $_FILES ) ) {
                $tempPath = $_FILES[ 'file' ][ 'tmp_name' ];
                $userEmail = $this->getUserEmail();
                mkdir('C:\xampp\htdocs\CatalogProject\companies/'.$userEmail.'\catalogs/'.$catalogName,null,true);
                $uploadPath  = ('C:\xampp\htdocs\CatalogProject\companies' . DIRECTORY_SEPARATOR . $userEmail . DIRECTORY_SEPARATOR . 'catalogs' . DIRECTORY_SEPARATOR . $catalogName. DIRECTORY_SEPARATOR . $_FILES[ 'file' ][ 'name' ]);
                move_uploaded_file( $tempPath, $uploadPath );
                $catalog = new Catalog();
                $catalog->setCatalogName($catalogName);
                $catalog->setCatalogCategory($catalogCategory);
                $catalog->setCreationDate($creationDate);
                $catalog->setCatalogPhoto($_FILES[ 'file' ][ 'name' ]);
                $catalog->setUser($this->getUser());
                $em->persist($catalog);
                $em->flush();
                $answer = array( 'answer' => 'File transfer completed' );
                $json = json_encode( $answer );

                echo $json;

            } else {

                echo 'No files';

            }


    }
}