<?php

declare(strict_types=1);

use App\Middleware\StartSession;

return function (Slim\App $app): void {
    $app->addBodyParsingMiddleware();

    $app->addRoutingMiddleware();

    $app->add(new StartSession());
};
