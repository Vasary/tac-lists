<?php

namespace App\Infrastructure\Persistence\Doctrine;

use App\Domain\Entity\Template;
use App\Domain\Entity\TemplateImage;
use App\Domain\Repository\TemplateImageRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\String\UnicodeString;
use Symfony\Component\Uid\UuidV4;

final class TemplateImageRepository extends ServiceEntityRepository implements TemplateImageRepositoryInterface
{
    private ManagerRegistry $manager;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TemplateImage::class);

        $this->manager = $registry;
    }

    public function create(Template $template, UnicodeString $url): TemplateImage
    {
        $image = new TemplateImage($url, $template);

        $this->manager->getManager()->persist($image);
        $this->manager->getManager()->flush();

        return $image;
    }

    public function delete(TemplateImage $image): void
    {
        $this->manager->getManager()->remove($image);
        $this->manager->getManager()->flush();
    }

    public function get(UuidV4 $id): TemplateImage | null
    {
        return $this->findOneBy(['id' => $id]);
    }
}
