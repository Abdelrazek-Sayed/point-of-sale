<?php
return [
	/**
	 * Control if the seeder should create a user per role while seeding the data.
	 */
	'create_users'    => FALSE,
	/**
	 * Control if all the laratrust tables should be truncated before running the seeder.
	 */
	'truncate_tables' => TRUE,
	'roles_structure' => [
		'super_admin' => [
			'users'      => 'c,r,u,d',
			'categories' => 'c,r,u,d',
			'products'   => 'c,r,u,d',
			'clients'    => 'c,r,u,d',
			'orders'   => 'c,r,u,d',
		],
		'admin' => [],
	],
	'permissions_map' => [
		'c' => 'create',
		'r' => 'read',
		'u' => 'update',
		'd' => 'delete',
	],
];
