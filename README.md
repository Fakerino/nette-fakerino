# Fakerino Nette

[![Latest Stable Version](https://poser.pugx.org/fakerino/nette-fakerino/v/stable.svg)](https://packagist.org/packages/fakerino/nette-fakerino)
[![License](https://poser.pugx.org/fakerino/nette-fakerino/license.svg)](https://packagist.org/packages/fakerino/nette-fakerino)

Provides an easy way to include [Fakerino](https://github.com/niklongstone/Fakerino) in [Nette framework](http://nette.org/en/) as a service.

More information in the [official documentation](https://github.com/niklongstone/Fakerino/wiki).

## Installation

Add the following dependencies to your projects composer.json file:

```JSON
    "require": {
        "fakerino/nette-fakerino": "0.0.*",
    }
```

### Install the [Open Data Sample](https://github.com/niklongstone/open-data-sample) in two ways:

 - Add a script to your composer.json:
```JSON
  "scripts": {
        "post-install-cmd": "vendor/fakerino/fakerino/build/ods vendor/fakerino/fakerino/data",
        "post-update-cmd": "vendor/fakerino/fakerino/build/ods vendor/fakerino/fakerino/data"
    }
```
 In this way the data will be always updated automatically via composer.

 - Run maually the command (after the fakerino composer installation):
`$ vendor/fakerino/fakerino/build/ods vendor/fakerino/fakerino/data`


### Configuration

Add in your config.neon the service definition as below:
```
services:
	fakerino:
	    class: Fakerino\Core\FakeDataFactory
	    factory: Fakerino\FakerinoNette\FakerinoServiceFactory::create
```

In order to customise the Fakerino default configuration you could add `fakerino` in your config.neon parameters.
```
parameters:
    fakerino:
        locale: cs-CZ
        fake:
            fakeMale:
              - titlemale
              - nameMale
              - surname
            fakeFemale:
              - titlefemale
              - namefemale
              - surname
        database:
            dbname: mydb
            user: username
            password: password
            host: localhost
            driver: pdo_mysql
```

### Presenter example

```PHP
<?php

namespace App\Presenters;

use Nette,
	App\Model;
use Fakerino\Core\FakeDataFactory;

/**
 * Homepage presenter.
 */
class HomepagePresenter extends Nette\Application\UI\Presenter
{
    /**
     * @var \Fakerino\Core\FakeDataFactory
     */
    private $fakerino;

    public function __construct(FakeDataFactory $fakerino)
    {
        $this->fakerino = $fakerino;
    }

	public function renderDefault()
	{
		$this->template->surname = $this->fakerino->fake('surname');
	}
}
```
