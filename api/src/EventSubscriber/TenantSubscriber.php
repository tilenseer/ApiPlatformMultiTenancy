<?php

namespace App\EventSubscriber;

use Doctrine\DBAL\Exception;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\RequestEvent;

class TenantSubscriber implements EventSubscriberInterface
{
    public function __construct(
        private ContainerInterface $container,
    ) {
    }

    public static function getSubscribedEvents(): array
    {
        return [
            RequestEvent::class => 'onKernelRequest',
        ];
    }

    /**
     * @throws Exception
     */
    public function onKernelRequest(RequestEvent $event): void
    {
        $request = $event->getRequest();

        if ($request->attributes->has('tenant')) {

            $tenant = 'co_' . $request->attributes->get('tenant');

            dd($this->container);


            $this->connection->connectToDB('root', 'secret', $tenant);
        }
    }
}
