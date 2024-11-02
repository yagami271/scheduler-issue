<?php

declare(strict_types=1);

namespace App\Symfony;

use Override;
use Symfony\Component\Scheduler\Attribute\AsSchedule;
use Symfony\Component\Scheduler\Schedule;
use Symfony\Component\Scheduler\ScheduleProviderInterface;

#[AsSchedule('default')]
final class Scheduler implements ScheduleProviderInterface
{

    #[Override]
    public function getSchedule(): Schedule
    {
        return new Schedule();
    }
}
