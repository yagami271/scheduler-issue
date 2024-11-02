<?php

namespace App\Message;

final readonly class MyMessage
{

    public function __construct(public string $message)
    {
    }
}