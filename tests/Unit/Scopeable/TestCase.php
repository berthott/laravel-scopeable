<?php

namespace berthott\Scopeable\Tests\Unit\Scopeable;

use berthott\Scopeable\ScopeableServiceProvider;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Orchestra\Testbench\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }

    protected function getPackageProviders($app)
    {
        return [
            ScopeableServiceProvider::class
        ];
    }

    protected function getEnvironmentSetUp($app)
    {
        $this->setUpUserTable();
        Config::set('scopeable.namespace', __NAMESPACE__);
    }

    private function setUpUserTable(): void
    {
        Schema::create('scopeable_ones', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('scopeable_manies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->unsignedBigInteger('scopeable_one_id')->nullable();
            $table->timestamps();
        });

        Schema::create('scopeable_many_user', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('scopeable_many_id');
            $table->unsignedBigInteger('user_id');

            $table->foreign('scopeable_many_id')->references('id')->on('scopeable_manies')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

        Schema::create('entity_ones', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->unsignedBigInteger('scopeable_one_id');
            $table->timestamps();
        });

        Schema::create('entity_manies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('entity_many_scopeable_many', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('scopeable_many_id');
            $table->unsignedBigInteger('entity_many_id');

            $table->foreign('scopeable_many_id')->references('id')->on('scopeable_manies')->onDelete('cascade');
            $table->foreign('entity_many_id')->references('id')->on('entity_manies')->onDelete('cascade');
        });
    }
}
