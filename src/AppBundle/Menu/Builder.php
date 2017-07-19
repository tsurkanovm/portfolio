<?php

namespace AppBundle\Menu;

use Knp\Menu\FactoryInterface;
use Knp\Menu\ItemInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;
use Symfony\Component\HttpFoundation\Request;

class Builder implements ContainerAwareInterface
{
    use ContainerAwareTrait;

    /**
     * @param FactoryInterface $factory
     * @return ItemInterface
     */
    public function createBreadcrumbsMenu(FactoryInterface $factory): ItemInterface
    {
        $menu = $this->createMenu($factory);

        return $menu;
    }

    /**
     * @param FactoryInterface $factory
     * @return ItemInterface
     */
    protected function createMenu(FactoryInterface $factory): ItemInterface
    {
        $menu = $factory->createItem('Home', ['route' => 'dashboard']);

        $this->createProjectMenu($menu);
        $this->createSolutionMenu($menu);

        return $menu;
    }

    /**
     * @param ItemInterface $root
     */
    protected function createProjectMenu(ItemInterface $root): void
    {
        $list = $root->addChild('Project List', ['route' => 'admin_project_list', 'display' => false]);
        $list->addChild('Create', ['route' => 'admin_project_add', 'display' => false]);
        if ($id = $this->getRequest()->get("id")) {
            $list->addChild('Edit', [
                'route' => 'admin_project_edit',
                'routeParameters' => ['id' => $this->getRequest()->get("id")],
                'display' => false
            ]);
        }
    }

    /**
     * @return Request
     */
    protected function getRequest(): Request
    {
        return $this->container->get('request_stack')->getCurrentRequest();
    }

    /**
     * @param ItemInterface $root
     */
    protected function createSolutionMenu(ItemInterface $root): void
    {
        $list = $root->addChild('Solution List', ['route' => 'admin_solution_list', 'display' => false]);
        $list->addChild('Create', ['route' => 'admin_solution_add', 'display' => false]);
        if ($id = $this->getRequest()->get("id")) {
            $list->addChild('Edit', [
                'route' => 'admin_solution_edit',
                'routeParameters' => ['id' => $this->getRequest()->get("id")],
                'display' => false
            ]);
        }
    }
}
