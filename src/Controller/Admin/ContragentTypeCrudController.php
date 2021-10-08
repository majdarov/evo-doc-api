<?php

namespace App\Controller\Admin;

use App\Entity\ContragentType;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ContragentTypeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ContragentType::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
