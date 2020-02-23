<p align="center">
    <a href="https://github.com/yiisoft" target="_blank">
        <img src="https://avatars0.githubusercontent.com/u/993323" height="100px">
    </a>
    <h1 align="center">Yii2 Test Data Migrate Extension</h1>
    <br>
</p>

Yii2-Data-Migrate provides a test data control.

[![Latest Stable Version](https://poser.pugx.org/darkfriend/yii2-data-migrate/v/stable)](https://packagist.org/packages/darkfriend/yii2-data-migrate) [![Total Downloads](https://poser.pugx.org/darkfriend/yii2-data-migrate/downloads)](https://packagist.org/packages/darkfriend/yii2-data-migrate) [![License](https://poser.pugx.org/darkfriend/yii2-data-migrate/license)](https://packagist.org/packages/darkfriend/yii2-data-migrate)

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist darkfriend/yii2-data-migrate "*"
```

or add

```
"darkfriend/yii2-data-migrate": "*"
```

to the require section of your composer.json.

Usage
------------
Once the extension is installed, simply modify your application configuration as follows:

```php
return [
    'bootstrap' => ['data'],
    'modules' => [
        'data' => [
            'class' => 'darkfriend\yii2migrate\ConsoleModule',
        ],
    ],
];
```
After you downloaded and configured Yii2-data-migrate, the last thing you need to do is updating your database schema by 
applying the migration:
 
```bash
$ php yii data/migrate/up
```

## Migrations

You can create the console migrations for creating/updating RBAC items.

### Module setup

To be able create the migrations, you need to add the following code to your console application configuration:

```php
// console.php
'modules' => [
    'data' => [
        'class' => 'darkfriend\yii2migrate\ConsoleModule'
    ]
]
```


### Creating Migrations

To create a new migration, run the following command:
```bash
$ php yii data/migrate/create <name>
```

The required `name` argument gives a brief description about the new migration. For example, if the migration is about creating a new migrate, you may use the name `create_migrate_name` and run the following command:

```bash
$ php yii data/migrate/create create_migrate_name
```

### Applying Migrations

To upgrade a database to its latest structure, you should apply all available new migrations using the following command:

```bash
$ php yii data/migrate
```

### Reverting Migrations

To revert (undo) one or multiple migrations that have been applied before, you can run the following command:

```bash
$ php yii data/migrate/down     # revert the most recently applied migration
$ php yii data/migrate/down 3   # revert the most 3 recently applied migrations
```

### Redoing Migrations

Redoing migrations means first reverting the specified migrations and then applying again. This can be done as follows:
```bash
$ php yii data/migrate/redo     # redo the last applied migration
$ php yii data/migrate/redo 3   # redo the last 3 applied migrations
```

### History Migrations

```bash
$ php yii data/migrate/history     # show all applied migration
```