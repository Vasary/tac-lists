<?php

declare(strict_types=1);

namespace App\Tests\Behat\Context;

use App\Domain\Repository\ItemImageRepositoryInterface;
use App\Domain\Repository\ItemRepositoryInterface;
use App\Domain\Repository\TemplateImageRepositoryInterface;
use App\Domain\Repository\TemplateRepositoryInterface;
use Behat\Behat\Context\Context;
use Doctrine\ORM\EntityManagerInterface;
use function Symfony\Component\String\u;
use Symfony\Component\Uid\UuidV4;

final class ImageContext implements Context
{
    public function __construct(
        private ItemImageRepositoryInterface $itemImageRepository,
        private TemplateImageRepositoryInterface $templateImageRepository,
        private TemplateRepositoryInterface $templateRepository,
        private ItemRepositoryInterface $itemRepository,
        private EntityManagerInterface $manager
    ) {
    }

    /**
     * @Given /^the image (.*) for item (.*) with id (.*)$/
     */
    public function spawnItemImage(string $link, string $item, string $id): void
    {
        $item = $this->itemRepository->get(UuidV4::fromString($item));

        $this->itemImageRepository->create($item, u($link), UuidV4::fromString($id));
        $this->manager->flush();
    }

    /**
     * @Given /^the image (.*) for template (.*) with id (.*)$/
     */
    public function spawnTemplateImage(string $link, string $template, string $id): void
    {
        $template = $this->templateRepository->get(UuidV4::fromString($template));

        $this->templateImageRepository->create($template, u($link), UuidV4::fromString($id));
        $this->manager->flush();
    }
}
