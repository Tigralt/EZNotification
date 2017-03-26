# EZNotification

A light bundle for implementing user notification in a Symfony application.

## Install

In the console use the command

```shell
composer require tigralt/eznotificationbundle
```

Or in your `composer.json` add the requirement

```json
"require": {
    "tigralt/eznotificationbundle": "dev-master"
}
```

Then register the bundle in your `AppKernel`
```php
public function registerBundles()
{
    ...
    $bundles = array(
        ...
        new Tigralt\EZNotificationBundle\EZNotificationBundle(),
    );
    ...
    return $bundles;
}
```
