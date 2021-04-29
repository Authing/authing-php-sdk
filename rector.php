<?php

declare(strict_types=1);

use Rector\Set\ValueObject\SetList;
use Rector\Core\Configuration\Option;
use Rector\Core\ValueObject\PhpVersion;
use Rector\Set\ValueObject\DowngradeSetList;
use Rector\DowngradePhp73\Tokenizer\FollowedByCommaAnalyzer;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $containerConfigurator): void {
    // get parameters
    $parameters = $containerConfigurator->parameters();

    // Define what rule sets will be applied
    // $parameters->set(Option::SETS, [
    //     SetList::DEAD_CODE,
    // ]);

    // $parameters->set(Option::SKIP, [
    //     __DIR__ . '/src/Types/CodeGen.v2.php',
    // ]);

    $parameters->set(Option::PATHS, [
        __DIR__ . '/src',
        // __DIR__ . '/tests'
    ]);

    // here we can define, what sets of rules will be applied
    $parameters->set(Option::SETS, [
        DowngradeSetList::PHP_74,
        DowngradeSetList::PHP_73,
        DowngradeSetList::PHP_72,
        DowngradeSetList::PHP_71,
        DowngradeSetList::PHP_70,
    ]);

    // is your PHP version different from the one your refactor to? [default: your PHP version]
    $parameters->set(Option::PHP_VERSION_FEATURES, PhpVersion::PHP_73);

    // get services (needed for register a single rule)
    // $services = $containerConfigurator->services();

    // register a single rule
    // $services->set(TypedPropertyRector::class);
};
