<?php

namespace App\Providers;

use App\Interfaces\Dashboard\LinkInterface;
use App\Interfaces\Dashboard\ThemeInterface;
use App\Interfaces\Dashboard\UserInterface;
use App\Interfaces\User\ProfileInterface;
use App\Interfaces\User\StatisticInterface;
use App\Repository\Dashboard\LinkRepository;
use App\Repository\Dashboard\ThemeRepository;
use App\Repository\Dashboard\UserRepository;
use App\Repository\User\ProfileRepository;
use App\Repository\User\StatisticRepository;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        JsonResource::withoutWrapping();

        $this->app->bind(ThemeInterface::class, function () {
            return new ThemeRepository();
        });
        $this->app->bind(UserInterface::class, function () {
            return new UserRepository();
        });
        $this->app->bind(LinkInterface::class, function () {
            return new LinkRepository();
        });
        $this->app->bind(\App\Interfaces\User\LinkInterface::class, function () {
            return new \App\Repository\User\LinkRepository();
        });
        $this->app->bind(ProfileInterface::class, function () {
            return new ProfileRepository();
        });
        $this->app->bind(StatisticInterface::class, function () {
            return new StatisticRepository();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
