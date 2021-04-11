<?php

declare(strict_types=1);

namespace App\UI\Rest\Controller;

use App\Domain\Response\AbstractResponse;
use App\UI\Rest\ResponseBuilder\ResponseBuilderInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController as SymfonyController;
use Symfony\Component\Messenger\HandleTrait;
use Symfony\Component\Messenger\MessageBusInterface;

abstract class AbstractController extends SymfonyController
{
    use HandleTrait;

    public function __construct(protected ResponseBuilderInterface $responseBuilder, MessageBusInterface $messageBus)
    {
        $this->messageBus = $messageBus;
    }

    protected function execute(object $envelop): AbstractResponse
    {
        return $this->handle($envelop);
    }
}
