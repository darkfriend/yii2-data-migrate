<?php

namespace darkfriend\yii2migrate\commands;

use yii\base\BaseObject;
use yii\db\Connection;
use yii\db\MigrationInterface;
use yii\di\Instance;

/**
 * Class MigrateController
 *
 * Below are some common usages of this command:
 *
 * ```
 * # creates a new migration
 * yii data/migrate/create migrate_name
 *
 * # applies ALL new migrations
 * yii data/migrate
 *
 * # reverts the last applied migration
 * yii data/migrate/down
 * ```
 */
class MigrateController extends \yii\console\controllers\MigrateController
{
    /**
     * @var Connection The database connection
     */
    public $db = 'db';

    /**
     * @inheritdoc
     */
    public $migrationTable = '{{%data_migration}}';

    /**
     * @inheritdoc
     */
    public $migrationPath = '@app/data-migrations';

    /**
     * @var int user
     */
    public $userId;

    /**
     * @inheritdoc
     */
    public $templateFile = '@vendor/darkfriend/yii2-data-migrate/views/migration.php';

    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->db = Instance::ensure($this->db, Connection::class);

        parent::init();
    }

    /**
     * @return Connection
     */
    public function getDb(): Connection
    {
        return $this->db;
    }

    /**
     * @param string $actionID
     * @return array|string[]
     */
    public function options($actionID)
    {
        $options = parent::options($actionID);
        $options[] = 'userId';
        return $options;
    }

    /**
     * @param string $class
     * @return \yii\db\Migration|MigrationInterface
     * @throws \yii\base\InvalidConfigException
     */
    protected function createMigration($class)
    {
        $this->includeMigrationFile($class);

        /** @var MigrationInterface $migration */
        $migration = \Yii::createObject($class);
        $migration->userId = $this->userId;

        if ($migration instanceof BaseObject && $migration->canSetProperty('compact')) {
            $migration->compact = $this->compact;
        }

        return $migration;
    }
}
