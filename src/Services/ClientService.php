<?php

declare(strict_types=1);

namespace Exhum4n\Users\Services;

use Exhum4n\Users\Events\ClientRegistered;
use Exhum4n\Users\Models\Role;
use Exhum4n\Users\Models\Status;
use Exhum4n\Users\Repositories\UserRepository;
use Exhum4n\Users\Models\User;
use Exhum4n\Components\Services\AbstractService;

class ClientService extends AbstractService
{
    /**
     * @var UserRepository
     */
    protected $repository;

    /**
     * @param string $email
     * @param string $ip
     * @param string|null $code
     *
     * @return User
     */
    public function create(string $email, string $ip, ?string $code = null): User
    {
//        $countryData = $this->getCountryData($ip);
//
//        $country = $this->getCountryByCode($countryData->countryCode);
//
//        $transaction = function () use ($email, $country, $countryData) {
//            return $this->repository->create([
//                'email' => $email,
//                'status_id' => Status::ID_ACTIVE,
//                'role_id' => Role::ID_CLIENT,
//                'country_id' => $country->id,
//                'timezone' => $countryData->timezone,
//            ]);
//        };
//
//        $client = $this->repository->transactionWrapper($transaction);
//
//        event(new ClientRegistered($client, $ip, $code));
//
//        return $client;
    }

    /**
     * @return string
     */
    protected function getRepository(): string
    {
        return UserRepository::class;
    }
}
