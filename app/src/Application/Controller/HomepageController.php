<?php

namespace Application\Controller;

use Domain\Repository\Newsfeeds;
use Domain\Repository\PaginationQuery;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class HomepageController extends AbstractController
{
    public function __construct(
        private readonly Newsfeeds $newsfeedsRepository
    ) {
    }

    public function __invoke(): Response
    {
        $newsfeeds = $this->newsfeedsRepository->findAll(new PaginationQuery(0, 20));

        return $this->render(
            'homepage.html.twig',
            [
                'newsfeeds' => $newsfeeds
            ]
        );
    }
}
