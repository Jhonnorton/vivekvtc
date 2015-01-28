<?php
return array(
    'doctrine' => array(
        'connection' => array(
            //default connection (configured by default for DoctrineORMModule)
            'orm_default' => array(
                'driverClass' => 'Doctrine\DBAL\Driver\PDOMySql\Driver',
                'params' => array(
                    'host' => 'localhost',
                    'port' => '3306',
                    'user' => 'vacationdb',
                    'password' => 'sg@D*$db876',
                    'dbname' => 'vacationparties_new',
                ),
            	'doctrineTypeMappings' => array('enum'=>'string'),
            ),
            //connection used for shop module
            'orm_avp' => array(
                'driverClass' => 'Doctrine\DBAL\Driver\PDOMySql\Driver',
                'params' => array(
                    'host' => 'localhost',
                    'port' => '3306',
                    'user' => 'vacationdb',
                    'password' => 'sg@D*$db876',
                    'dbname' => 'vacationparties_new',
                ),
            	'doctrineTypeMappings' => array('enum'=>'string'),
            )
        )
    )
);

