<?php

declare(strict_types=1);

namespace Exhum4n\Users\Http\Presenters;

use Exhum4n\Components\Http\Presenters\SimplePresenter;
use Exhum4n\Users\Models\User;

class ClientPresenter extends SimplePresenter
{
    /**
     * @var User
     */
    protected $user;

    /**
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * @return array
     */
    protected function getPresentationData(): array
    {
        $user = $this->user;

        $userData = [
            'queue' => [
                'start_at' => $user->queue->start_at,
                'description' => $user->queue->nextAction->description,
                'strategy' => [
                    'id' => $user->queue->strategy_id,
                    'name' => $user->queue->strategy->name,
                ]
            ]
        ];

        if ($user->subscription) {
            $userData['subscription'] = $user->subscription;
        }

        $transactions = $this->getUserTransactions($user);
        if ($transactions->count() > 0) {
            $transactionsData = [];

            foreach ($transactions as $transaction) {
                $transactionsData[] = [
                    'id' => $transaction->id,
                    'payment_id' => $transaction->payment_id,
                    'status' => $transaction->status,
                    'card' => [
                        'type' => $transaction->bankCard->type->name,
                        'mask' => "{$transaction->bankCard->first_chars} **** {$transaction->bankCard->last_chars}"
                    ],
                    'date' => $transaction->created_at,
                    'amount' => $transaction->amount,
                    'currency_symbol' => $transaction->currency->symbol,
                ];
            }

            $userData['transaction'] = $transactionsData;
        }

        return $userData;
    }
}
