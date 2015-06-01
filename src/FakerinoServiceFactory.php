<?php
/**
 * This file is part of the Fakerino Nette extension.
 *
 * (c) Nicola Pietroluongo <nik.longstone@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Fakerino\FakerinoNette;

use Fakerino\Fakerino;
use Nette\DI\Container;

class FakerinoServiceFactory
{
    const FAKERINO_TAG = 'fakerino';

    static function create(Container $container)
    {
        $fakerinoConf = array();
        $configuration =  $container->getParameters();
        if (array_key_exists(self::FAKERINO_TAG, $configuration)) {
            $fakerinoConf = $configuration[self::FAKERINO_TAG];
        }

        return Fakerino::create($fakerinoConf);
    }
}