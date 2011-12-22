<?php

namespace Kunstmaan\AdminBundle\Controller;

use \Kunstmaan\AdminBundle\Form\PageAdminType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Kunstmaan\AdminBundle\Entity\PageIFace;
use Kunstmaan\DemoBundle\AdminList\PageAdminListConfigurator;
use Kunstmaan\DemoBundle\PagePartAdmin\PagePartAdminConfigurator;
use Kunstmaan\PagePartBundle\Form\TextPagePartAdminType;
use Kunstmaan\AdminBundle\Form\NodeInfoAdminType;

class PagesController extends Controller
{
    
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $topnodes = $em->getRepository('KunstmaanAdminNodeBundle:Node')->getTopNodes();

        $request    = $this->getRequest();
        $adminlist  = $this->get("adminlist.factory")->createList(new PageAdminListConfigurator(), $em);
        $adminlist->bindRequest($request);

        return $this->render('KunstmaanAdminBundle:Pages:index.html.twig', array(
            'topnodes'          => $topnodes,
            'pageadminlist'     => $adminlist,
        ));
    }

    public function editAction($id, $entityname)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $request = $this->getRequest();

        $page = $em->getRepository($entityname)->find($id);  //'KunstmaanAdminBundle:Page'
        $locale = $request->getSession()->getLocale();
        $page->setTranslatableLocale($locale);
        $em->refresh($page);
        $repo = $em->getRepository('StofDoctrineExtensionsBundle:LogEntry');
        $logs = $repo->getLogEntries($page);
        if(!is_null($this->getRequest()->get('version'))){
        	$repo->revert($page, $this->getRequest()->get('version'));
        }

        $topnodes   = $em->getRepository('KunstmaanAdminNodeBundle:Node')->getTopNodes();
        $node       = $em->getRepository('KunstmaanAdminNodeBundle:Node')->getNodeFor($page);

        $formfactory = $this->container->get('form.factory');
        $formbuilder = $this->createFormBuilder();

        //add the specific data from the custom page
        $formbuilder->add('main', $page->getDefaultAdminType());
        $formbuilder->add('node', $node->getDefaultAdminType($this->container));

        $formbuilder->setData(array('node' => $node, 'main' => $page));


        //handle the pagepart functions (fetching, change form to reflect all fields, assigning data, etc...)
        $pagepartadmin = $this->get("pagepartadmin.factory")->createList(new PagePartAdminConfigurator(), $em, $page);
        $pagepartadmin->preBindRequest($request);
        $pagepartadmin->adaptForm($formbuilder, $formfactory);

        $form = $formbuilder->getForm();

        if ($request->getMethod() == 'POST') {
            $form->bindRequest($request);
            $pagepartadmin->bindRequest($request);

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getEntityManager();

                $formValues = $request->request->get('form');
                $formValues = array_keys($formValues['node']['roles']);

                //var_dump(array_keys($formValues['node']['roles']));die;
                $node->setRoles($formValues);

                $em->persist($node);
                $em->persist($page);
                $em->flush();

                return $this->redirect($this->generateUrl('KunstmaanAdminBundle_pages_edit', array(
                    'id' => $page->getId(),
                    'entityname' => get_class($page)
                )));
            } else {
                var_dump($form->getErrors());die('error.');
            }
        }

        return $this->render('KunstmaanAdminBundle:Pages:edit.html.twig', array(
            'topnodes'      => $topnodes,
            'page'          => $page,
            'entityname'    => get_class($page),
            'form'          => $form->createView(),
            'pagepartadmin' => $pagepartadmin,
        	'logs'          => $logs,
        ));
    }
	
}
