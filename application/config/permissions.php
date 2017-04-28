<?php
$config = array(
	'admin' => array('index', 'add', 'edit', 'delete'),
	'user' => array('index','search','add', 'edit', 'delete'),
	'market' => array('index', 'add', 'edit', 'delete'),
	'product' => array('index','search','del', 'del_all', '__delete'),
	'province' => array('index', 'add', 'edit', 'delete'),
	'seller' => array('index', 'add', 'edit', 'delete'),
	'catalog' => array('index', 'add', 'edit', 'delete', 'delete all'),
	'feedback' => array('index'),
);
