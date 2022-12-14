<?php

namespace App\Controller\Admin;

use App\Entity\Product;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Context\AdminContext;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;

class ProductCrudController extends AbstractCrudController
{
    public const PRODUCT_PATH = 'images';
    public const PRODUCT_DIR = 'public/images';
    public const DUPLICATE = 'duplicate';

    public static function getEntityFqcn(): string
    {
        return Product::class;
    }
    public function configureActions(Actions $actions): Actions
    {
        $duplicate = Action::new(self::DUPLICATE)
            ->linkToCrudAction('duplicateProduct')
            ->setCssClass('btn btn-primary');


        return $actions
            ->add(Crud::PAGE_EDIT, $duplicate);
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('name', "Nom de l'article"),
            MoneyField::new('price')->setCurrency('EUR'),

            TextareaField::new('description'),

            ImageField::new('image')
                ->setBasePath(self::PRODUCT_PATH)
                ->setUploadDir(self::PRODUCT_DIR)
                ->setSortable(false),

            AssociationField::new('type'),

            DateTimeField::new('createdAt')->hideOnForm(),
            DateTimeField::new('updatedAt')->hideOnForm(),
        ];
    }

    public function persistEntity(EntityManagerInterface $em, $ei): void
    {
        if(!$ei Instanceof Product) return;
        $ei->setCreatedAt( new DateTimeImmutable);

        parent::persistEntity($em, $ei);
    }

    public function duplicate(AdminContext $context, EntityManagerInterface $em, AdminUrlGenerator $admin): Response
    {
        /**
         * @var Product $produit
         */
        $produit = $context->getEntity()->getInstance();
        $duplicate = clone $produit;

        parent::persistEntity($em , $duplicate);
        $url = $admin->setController(self::class)
            ->setAction(Action::DETAIL)
            ->setEntityId($duplicate->getId())
            ->generateUrl();

        return $this->redirect($url);
    }



}
