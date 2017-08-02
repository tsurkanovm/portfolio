<?php

namespace AppBundle\Menu;

use Knp\Menu\FactoryInterface;
use Knp\Menu\ItemInterface;
use Symfony\Component\HttpFoundation\RequestStack;

class Builder
{
    /**
     * @var FactoryInterface
     */
    private $factory;

    /**
     * @var RequestStack
     */
    private $request;

    /**
     * Builder constructor.
     * @param FactoryInterface $factory
     * @param RequestStack $request
     */
    public function __construct(FactoryInterface $factory, RequestStack $request)
    {
        $this->factory = $factory;
        $this->request = $request;
    }

    /**
     * @return ItemInterface
     */
    public function createAdminMenu(): ItemInterface
    {
        $menu = $this->factory->createItem('Dashboard', ['route' => 'dashboard']);

        $this->createProjectMenu($menu);
        $this->createSolutionMenu($menu);
        $this->createFilesMenu($menu);

        return $menu;
    }

    /**
     * @param ItemInterface $root
     */
    protected function createProjectMenu(ItemInterface $root): void
    {
        $list = $root->addChild('Project', ['route' => 'admin_project_list']);
        $list->addChild('Create', ['route' => 'admin_project_add', 'display' => false]);
        if ($id = $this->request->getCurrentRequest()->get("id")) {
            $list->addChild('Edit', [
                'route' => 'admin_project_edit',
                'routeParameters' => ['id' => $id],
                'display' => false
            ]);
        }
    }

    /**
     * @param ItemInterface $root
     */
    protected function createSolutionMenu(ItemInterface $root): void
    {
        $list = $root->addChild('Solution', ['route' => 'admin_solution_list']);
        $list->addChild('Create', ['route' => 'admin_solution_add', 'display' => false]);
        if ($id = $this->request->getCurrentRequest()->get("id")) {
            $list->addChild('Edit', [
                'route' => 'admin_solution_edit',
                'routeParameters' => ['id' => $id],
                'display' => false
            ]);
        }
    }

    /**
     * @param ItemInterface $root
     */
    protected function createFilesMenu(ItemInterface $root): void
    {
        $list = $root->addChild('Files', ['route' => 'admin_files_list']);
        $list->addChild('Create', ['route' => 'admin_files_add', 'display' => false]);
        if ($id = $this->request->getCurrentRequest()->get("id")) {
            $list->addChild('Edit', [
                'route' => 'admin_files_edit',
                'routeParameters' => ['id' => $id],
                'display' => false
            ]);
            $list->addChild('Show', [
                'route' => 'admin_files_show',
                'routeParameters' => ['id' => $id],
                'display' => false
            ]);
        }
    }
}
