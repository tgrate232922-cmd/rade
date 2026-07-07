<?php

namespace App\Services;

use App\Enums\InvestStatus;
use App\Models\Invest;
use App\Models\Schema;
use App\Models\User;
use App\Models\UserSchemaLimit;

class UserSchemaLimitService
{
    public function subscriptionCount(User $user, Schema $schema): int
    {
        return Invest::query()
            ->where('user_id', $user->id)
            ->where('schema_id', $schema->id)
            ->whereIn('status', [
                InvestStatus::Ongoing,
                InvestStatus::Completed,
                InvestStatus::Pending,
            ])
            ->count();
    }

    public function maxSubscriptions(User $user, Schema $schema): ?int
    {
        $limit = UserSchemaLimit::query()
            ->where('user_id', $user->id)
            ->where('schema_id', $schema->id)
            ->value('max_subscriptions');

        return $limit === null ? null : (int) $limit;
    }

    public function canSubscribe(User $user, Schema $schema): bool
    {
        $max = $this->maxSubscriptions($user, $schema);

        if ($max === null) {
            return true;
        }

        return $this->subscriptionCount($user, $schema) < $max;
    }

    public function remainingSubscriptions(User $user, Schema $schema): ?int
    {
        $max = $this->maxSubscriptions($user, $schema);

        if ($max === null) {
            return null;
        }

        return max(0, $max - $this->subscriptionCount($user, $schema));
    }
}
