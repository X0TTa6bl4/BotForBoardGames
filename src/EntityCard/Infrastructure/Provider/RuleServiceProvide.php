<?php

namespace src\EntityCard\Infrastructure\Provider;

use Illuminate\Support\ServiceProvider;
use src\EntityCard\Application\Rule\IsItPossibleToCreateAnEntityRule;
use src\EntityCard\Application\Rule\MakeDamageEntityAbsoluteRule;
use src\EntityCard\Application\Rule\MakeRestoreHealthRule;
use src\EntityCard\Application\Rule\TakeDamageEntityAbsoluteRule;
use src\EntityCard\Application\Rule\TakeRestoreHealthRule;
use src\EntityCard\Domain\Rule\IsItPossibleToCreateAnEntityRuleContract;
use src\EntityCard\Domain\Rule\MakeDamageEntityRuleContract;
use src\EntityCard\Domain\Rule\MakeRestoreHealthRuleContract;
use src\EntityCard\Domain\Rule\TakeDamageEntityRuleContract;
use src\EntityCard\Domain\Rule\TakeRestoreHealthRuleContract;

class RuleServiceProvide extends ServiceProvider
{
    public array $bindings = [
        MakeDamageEntityRuleContract::class => MakeDamageEntityAbsoluteRule::class,
        TakeDamageEntityRuleContract::class => TakeDamageEntityAbsoluteRule::class,
        IsItPossibleToCreateAnEntityRuleContract::class => IsItPossibleToCreateAnEntityRule::class,

        MakeRestoreHealthRuleContract::class => MakeRestoreHealthRule::class,
        TakeRestoreHealthRuleContract::class => TakeRestoreHealthRule::class,
    ];
}
