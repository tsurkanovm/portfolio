<?php

namespace AppBundle\Twig;

class AdminSideBarMenuExtension extends \Twig_Extension
{
    /**
     * @var array
     */
    private $items = [];

    /**
     * @param array $items
     */
    public function setItems(array $items)
    {
        $this->items = $items;
    }

    /**
     * @return array
     */
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('admin_sidebar_menu', [$this, 'buildMenu'], [
                'is_safe' => ['html'],
                'needs_environment' => true
            ]),
        ];
    }

    /**
     * @param \Twig_Environment $env
     * @return mixed|string
     */
    public function buildMenu(\Twig_Environment $env)
    {
        return $env->render("admin/menu/sidebar.html.twig", ['items' => $this->items]);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'admin_sidebar_menu_extension';
    }
}
