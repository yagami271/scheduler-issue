<?php

namespace App\Event;

final readonly class MyMessageHandled
{

    public function __construct(public string $message)
    {
    }
}