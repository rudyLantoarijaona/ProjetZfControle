<?php

declare(strict_types=1);

namespace Application;

use Psr\Container\ContainerInterface;

final class DateTimeImmutableFactory
{
    public function __invoke(ContainerInterface $container) : \DateTimeImmutable
    {
              return new \DateTimeImmutable();
    }
}
