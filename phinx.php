<?php

$mootiIniFile = '/etc/mooti/mooti.ini';

if (!file_exists($mootiIniFile)) {
	throw new \Exception($mootiIniFile .' does not exixt');	
}

$iniValues = parse_ini_file($mootiIniFile, true);
$dbName = 'account';

$pdo = new PDO('mysql:host='.$iniValues['database']['host'], $iniValues['database']['user'], $iniValues['database']['password']);
$statement = $pdo->prepare('show databases like "'.$dbName.'"');
$statement->execute();
$row = $statement->fetch();
if ($row == false) {
	$pdo->exec('CREATE DATABASE IF NOT EXISTS '.$dbName);
}

return [
    'paths' => [
        'migrations' => '%%PHINX_CONFIG_DIR%%/db/migrations',
        'seeds'      => '%%PHINX_CONFIG_DIR%%/db/seeds'
    ],
    'environments' => [
        'default_migration_table' => 'phinxlog',
        'default_database' => 'production',
        'production' => [
            'adapter' => 'mysql',
            'host' => $iniValues['database']['host'],
            'name' => $dbName,
            'user' => $iniValues['database']['user'],
            'pass' => $iniValues['database']['password'],
            'port' => 3306,
            'charset' => 'utf8'
        ]
    ]
];
