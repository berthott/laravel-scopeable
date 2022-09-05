<?php

namespace berthott\Scopeable\Tests\Unit\Scopeable;

use berthott\Scopeable\Exceptions\ForbiddenException;
use berthott\Scopeable\Facades\Scopeable;

class ScopeableTest extends TestCase
{
    public function test_scopeable_filter_one_to_many(): void
    {
        $scropableAllowed = ScopeableOne::factory()->create();
        $scropableNotAllowed = ScopeableOne::factory()->create();
        $user = User::factory()->for($scropableAllowed, 'scopeable_one')->create();
        $entityToInclude = EntityOne::factory()->for($scropableAllowed, 'scopeable_one')->create();
        $entityNotToInclude = EntityOne::factory()->for($scropableNotAllowed, 'scopeable_one')->create();

        $this->actingAs($user);

        $this->assertEquals(1, Scopeable::filterScopes(collect([$entityToInclude, $entityNotToInclude]))->count(), 'Scopeable::filterScopes filters scopes');
    }

    public function test_scopeable_filter_many_to_many(): void
    {
        $scropableAllowed = ScopeableMany::factory()->create();
        $scropableNotAllowed = ScopeableMany::factory()->create();
        $user = User::factory()->hasAttached($scropableAllowed, [], 'scopeable_manies')->create();
        $entityToInclude = EntityMany::factory()->hasAttached($scropableAllowed, [], 'scopeable_manies')->create();
        $entityNotToInclude = EntityMany::factory()->hasAttached($scropableNotAllowed, [], 'scopeable_manies')->create();

        $this->actingAs($user);

        $this->assertEquals(1, Scopeable::filterScopes(collect([$entityToInclude, $entityNotToInclude]))->count(), 'Scopeable::filterScopes filters scopes');
    }

    public function test_scopeable_check_one_to_many_success(): void
    {
        $scropableAllowed = ScopeableOne::factory()->create();
        $user = User::factory()->for($scropableAllowed, 'scopeable_one')->create();
        $entityToInclude = EntityOne::factory()->for($scropableAllowed, 'scopeable_one')->create();

        $this->actingAs($user);

        $this->assertEquals($entityToInclude, Scopeable::checkScopes($entityToInclude), 'Scopeable::checkScopes returns the model');
    }

    public function test_scopeable_check_one_to_many_failure(): void
    {
        $scropableAllowed = ScopeableMany::factory()->create();
        $scropableNotAllowed = ScopeableMany::factory()->create();
        $user = User::factory()->hasAttached($scropableAllowed, [], 'scopeable_manies')->create();
        $entityNotToInclude = EntityMany::factory()->hasAttached($scropableNotAllowed, [], 'scopeable_manies')->create();

        $this->actingAs($user);

        $this->expectException(ForbiddenException::class);
        Scopeable::checkScopes($entityNotToInclude);
    }
}
