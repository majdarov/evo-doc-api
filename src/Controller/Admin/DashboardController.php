<?php

namespace App\Controller\Admin;

use App\Entity\{Contragent, ContragentType, DocProd, Document};
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        // - return parent::index();
        $routeBuilder = $this->get(AdminUrlGenerator::class);
        $url = $routeBuilder->setController(ContragentCrudController::class)->generateUrl();
        return $this->redirect($url);
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Evo Doc Api');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToRoute('Back to Homepage', 'fas fa-home', 'document');
        yield MenuItem::linkToCrud('ContragentTypes', 'fas fa-tape', ContragentType::class );
        yield MenuItem::linkToCrud('Contragents', 'fas fa-handshake', Contragent::class );
        yield MenuItem::linkToCrud('Documents', 'fas fa-file-invoice', Document::class );
        // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);
    }
}
