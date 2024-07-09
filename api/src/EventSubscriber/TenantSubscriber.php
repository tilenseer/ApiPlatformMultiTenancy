<?php

namespace App\EventSubscriber;

use Doctrine\DBAL\Exception;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\RequestEvent;

class TenantSubscriber implements EventSubscriberInterface
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager,
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

            $credentials = $this->getUserCredentials();

            $this->entityManager
                ->getConnection()
                ->connectToTenant($credentials['user'], $credentials['password'], $tenant);
        }
    }

    private function getUserCredentials(): array
    {
        // Call S3 to get the user credentials

        return [
            'user' => 'root',
            'password' => 'secret',
        ];
    }
}
