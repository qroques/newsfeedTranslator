<?php

declare(strict_types=1);

namespace Application\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mercure\HubInterface;
use Symfony\Component\Mercure\Update;

class PublishController extends AbstractController
{
    public function __invoke(HubInterface $hub): Response
    {
        $update = new Update(
            'https://date',
            json_encode(['date' => (new \DateTimeImmutable())->format(\DateTime::ATOM)])
        );

        $hub->publish($update);

        return new Response('published!');
    }
}
