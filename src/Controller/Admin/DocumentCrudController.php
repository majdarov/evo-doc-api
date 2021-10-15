<?php

namespace App\Controller\Admin;

use App\Entity\Document;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Filter\EntityFilter;

class DocumentCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Document::class;
    }

    public function configureFields(string $pageName): iterable
    {
        // return [
        //     IdField::new('id'),
        //     TextField::new('title'),
        //     TextEditorField::new('description'),
        // ];
        yield TextField::new('doc_num', 'Document Number')
            ->setColumns(5);
        $docDate = DateTimeField::new('doc_date', 'Document Date')
            ->setColumns(3)
            ->setFormTypeOptions([
                'html5' => true,
                'years' => range(date('Y') - 2, date('Y') + 5),
                'widget' => 'single_text',
            ]);
        if (Crud::PAGE_EDIT === $pageName) {
            yield $docDate->setFormTypeOption('disabled', true);
        } else {
            yield $docDate;
        }
        FormField::addRow();
        yield AssociationField::new('cnt_seller', 'Seller')->setColumns(5);
        yield AssociationField::new('cnt_receiver', 'Receiver')->setColumns(5);
    }
}
