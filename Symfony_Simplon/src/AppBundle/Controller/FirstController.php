<?php
/**
 * Created by PhpStorm.
 * User: dev
 * Date: 29/05/17
 * Time: 10:11
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Article;
use AppBundle\Entity\CommuneFrance;
use AppBundle\Entity\formulaire;
use AppBundle\Form\ArticleType;
use Doctrine\DBAL\Types\BooleanType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\RadioType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Translation\Loader\ArrayLoader;
use Symfony\Component\Translation\MessageSelector;
use Symfony\Component\Translation\Translator;
use AppBundle\Repository\ArticleRepository;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\CsvEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

class FirstController extends Controller
{
    public $francais, $anglais;
   function __construct()
   {
        $this->francais = new Translator('fr_Fr', new MessageSelector());
        $this->anglais = new Translator('en_En', new MessageSelector());
   }

    /**
 * Class FirstController
 * @package AppBundle\Controller
 * @Route("/number/{max}", name="home", defaults={"max"=20})
 */
        public function firstAction($max) {
            $number = rand(0, $max);

            return $this->render('index.html.twig', array(
                'number' => $number
            ));
        }


/**
 * @Route("blog/{title}/{years}",
 *     defaults={"local"= "fr"},
 *     requirements={
 *     "local": "en|fr",
 *          "years": "\d+"
 *     })
 * @Route("/blog/{local}/{title}/{years}",
 *     defaults={"local"= "fr"},
 *     requirements={
            "local": "en|fr",
 *          "years": "\d+"
 *     })
 */
        public function blogAction($local=null, $years, $title){

            if ($local == "en") {
                $this->anglais->addLoader('array', new ArrayLoader());
                $this->anglais->addResource('array', array(
                    "bonjour" => "hello"
                ), 'en_En');
                $translate = $this->anglais->trans($title);

                return $this->render('blog.html.twig', array(
                    "local" => $local,
                    "years" => $years,
                    "title" => $translate
                ));
            } else {
                return $this->render('blog.html.twig', array(
                    "local" => $local,
                    "years" => $years,
                    "title" => $title
                ));
            }
        }
        /**
         * @Route("/action", name="viewAll")
         */
        public function viewAllAction(){
            $database = $this->getDoctrine()
                ->getRepository('AppBundle:Article')
                ->findAll();
            return $this->render('viewAll.html.twig', array(
                'database' => $database
                ));
        }

    /**
     * @Route("/test/{min}", name="orderDate", defaults={"min"=200})
     */
        public function orderAction($min) {
            $database = $this->getDoctrine()
                ->getRepository('AppBundle:Article')
                ->findAllOrderByDate($min);
            return $this->render('viewAll.html.twig', array(
                'database' => $database
            ));
        }
    /**
     * @Route("/viewOne/{id}", name="viewOne")
     */
    public function viewOneAction($id, Request $request){
        $data = $this->getDoctrine()
            ->getRepository('AppBundle:Article')
            ->find($id);
        return $this->render('viewOne.html.twig', array(
            'data' => $data,
            "form" => $this->delete($id,$request)
        ));
    }

    /**
     * @Route("/add", name="addShit")
     */
        public function addShitAction($articles=null) {
            $article = new Article();
            $article->setTitle($articles.getTitle() || 'Article lambda bisbisbis');
            $article->setContent($articles.getContent() ||'azdsqqqqs<,klsqdpokqsdlsqslm qd pksd lqsdlmala mld mam lazdamslasl ');
            $article->setCreatedAt($articles.getCreatedAt() || new \DateTime());
            $article->setIsEnabled($articles.getIsEnabled ||false);
            $article->setVote($articles.getVote ||600);
            $em= $this->getDoctrine()
                ->getManager();
            $em->persist($article);
            $em->flush();

            return $this->render('addShit.html.twig');
        }
    /**
     * @Route("/new", name="firstForm")
     */
    public function formAction( Request $request){

        $article = new Article();

        $form = $this->createForm('AppBundle\Form\ArticleType', $article)
        ->add('submit', SubmitType::class);

        $form->handleRequest($request);

        if($form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($article);
            $em->flush();

            return $this->redirect($this->generateUrl('viewAll'));
        }


        return $this->render('formView.html.twig', array(
            'form' => $form->createView()
        ));

    }

    /**
     * @param Request $request
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/updateForm/{id}", name="updateForm")
     */
    public function formUpdateAction(Request $request, $id){
        $article = $this->getDoctrine()
            ->getRepository('AppBundle:Article')
            ->find($id);

        $form = $this->createForm('AppBundle\Form\ArticleType', $article)
            ->add('submit', SubmitType::class);

        $form->handleRequest($request);

        if($form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($article);
            $em->flush();
        }

        return $this->render('formView.html.twig', array(
            'form' => $form->createView()
        ));

    }
    /**
     * @Route("/DELETE/{id}", name="article_delete")
     */
    public function delete($id, Request $request){
        $article = $this->getDoctrine()
            ->getRepository('AppBundle:Article')
            ->find($id);
       $form =  $this->createDeleteForm($article);
        $form->handleRequest($request);
        if ($form->isValid() || $form->isSubmitted()){

            $em = $this->getDoctrine()->getManager();
            $em->remove($article);
            $em->flush();

            return $this->redirect($this->generateUrl('viewAll'));
        }
           return  $form->createView();
    }
    private function createDeleteForm(Article $article)
    {
        //on cree un formulaire
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('article_delete', array('id' => $article->getId())))
            ->setMethod('DELETE')
            ->add('delete', SubmitType::class)
            ->getForm()
            ;
    }

    /**
     * @Route("/jsonStyle", name="apijson")
     */
    public function jsonAction(){

        $content = $this->getDoctrine()
            ->getRepository('AppBundle:Article')
            ->findAll();
        return new JsonResponse($content);
    }
    /**
     * @Route("/affichageDesCoummunes", name="onSAmuse")
     */
    public function viewCommuneAction(Request $request)
    {
        $data= $this->getDoctrine()->getRepository('AppBundle:CommuneFrance')->findAll();

        return $this->render('commune.html.twig', array(
            'response' => $data
        ));
    }

}