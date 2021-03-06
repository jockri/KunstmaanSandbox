<?php

namespace Kunstmaan\SandboxDemoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\DependencyInjection\ContainerInterface;

use Kunstmaan\FormBundle\Entity\AbstractFormPage;
use Kunstmaan\SandboxDemoBundle\Form\FormPageAdminType;
use Kunstmaan\SandboxDemoBundle\PagePartAdmin\FormPagePagePartAdminConfigurator;
use Kunstmaan\SandboxDemoBundle\PagePartAdmin\BannerPagePartAdminConfigurator;

/**
 * FormPage
 *
 * @ORM\Entity()
 * @ORM\Table(name="sandbox_form_pages")
 */
class FormPage extends AbstractFormPage
{

    /**
     * Returns the default backend form type for this form
     *
     * @return AbstractType
     */
    public function getDefaultAdminType()
    {
        return new FormPageAdminType();
    }

    /**
     * @return array
     */
    public function getPossibleChildTypes()
    {
        return array(
            array(
                'name' => 'ContentPage',
                'class' => "Kunstmaan\SandboxDemoBundle\Entity\ContentPage"
            ),
            array (
                'name' => 'FormPage',
                'class' => "Kunstmaan\SandboxDemoBundle\Entity\FormPage"
            )
        );
    }

    /**
     * @return array
     */
    public function getPagePartAdminConfigurations()
    {
        return array(
            new FormPagePagePartAdminConfigurator(),
            new BannerPagePartAdminConfigurator()
        );
    }

    /**
     * @return string
     */
    public function getDefaultView()
    {
        return "KunstmaanSandboxDemoBundle:FormPage:view.html.twig";
    }
}
