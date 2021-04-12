<?php

namespace App\Domain\Template\Repository;

use App\Domain\Template\Model\Template;
use App\Domain\Template\Model\TemplateImage;
use Symfony\Component\String\UnicodeString;
use Symfony\Component\Uid\UuidV4;

interface TemplateImageRepositoryInterface
{
    public function create(Template $template, UnicodeString $url, UuidV4 $id): TemplateImage;
    public function delete(TemplateImage $image): void;
    public function get(UuidV4 $id): TemplateImage | null;
}
