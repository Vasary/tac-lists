<?php

namespace App\Domain\Repository;

use App\Domain\Entity\Template;
use App\Domain\Entity\TemplateImage;
use Symfony\Component\String\UnicodeString;
use Symfony\Component\Uid\UuidV4;

interface TemplateImageRepositoryInterface
{
    public function create(Template $template, UnicodeString $url): TemplateImage;

    public function delete(TemplateImage $image): void;

    public function get(UuidV4 $id): TemplateImage | null;
}
