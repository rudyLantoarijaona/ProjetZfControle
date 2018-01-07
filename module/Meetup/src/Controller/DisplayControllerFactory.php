<?php

declare(strict_types=1);

namespace Meetup\Controller;

use Meetup\Entity\Meetup;
use Meetup\Form\MeetupForm;
use Doctrine\ORM\EntityManager;
use Psr\Container\ContainerInterface;

final class DisplayControllerFactory
{
    public function __invoke(ContainerInterface $container) : DisplayController
    {
        $meetupRepository = $container->get(EntityManager::class)->getRepository(Meetup::class);
        $meetupform = $container->get(Meetupform::class);

        return new DisplayController($meetupRepository, $meetupform);
    }
}