<?php

namespace EasyFeishu\EventHandlers;

abstract class EventHandler
{
    abstract public function handle($message);
}
