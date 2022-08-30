<?php

declare(strict_types=1);

use DI\ContainerBuilder;
use Psr\Container\ContainerInterface;
use Symfony\Component\Translation\Loader\JsonFileLoader;
use Symfony\Component\Translation\Translator;

$definitions = [
    'settings' => function () {
        return require 'settings.php';
    },

    Translator::class => function (ContainerInterface $container) {
        $locale = $_SESSION['locale'] ?? $container->get('settings')['app']['locale'];
        $translator = new Translator($locale);
        $translator->addLoader('json', new JsonFileLoader());

        if (file_exists($file = __DIR__ . '/../lang/' . $locale . '.json')) {
            $translator->addResource('json', $file, $locale);
        }

        return $translator;
    },
];

return (new ContainerBuilder())->addDefinitions($definitions)->build();
