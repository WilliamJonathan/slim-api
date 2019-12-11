<?php
if (PHP_SAPI != 'cli') {
    exit('Rodar via CLI');
}

require __DIR__ . '/vendor/autoload.php';

// Instantiate the app
$settings = require __DIR__ . '/src/settings.php';
$app = new \Slim\App($settings);

require __DIR__ . '/src/dependencies.php';

$db = $container->get('db');

$schema = $db->schema();
$tabela = 'produtos';

$schema->dropIfExists($tabela);

//cria a tabela produtos
$schema->create($tabela, function($table) {

	$table->increments('id');
	$table->string('titulo', 100);
	$table->text('descricao',);
	$table->decimal('preco', 11, 2);
	$table->string('fabricante', 60);
	$table->timestamps();

});

//preenche tabela
$db->table($tabela)->insert([
	'titulo' => 'Motorola G5',
	'descricao' => 'Android X',
	'preco' => 999.99,
	'fabricante' => 'Motorola',
	'created_at' => '2019-10-22',
	'updated_at' => '2019-10-22'
]);

$db->table($tabela)->insert([
	'titulo' => 'iPhone X',
	'descricao' => 'Mac Os X',
	'preco' => 4999.99,
	'fabricante' => 'Aple',
	'created_at' => '2019-10-22',
	'updated_at' => '2019-10-22'
]);


/*$query = "insert into produtos(descricao) values ('teste')";
$stmt->bindValue(':nome', $this->__get('nome'));
$stmt = $db->prepare($query);
$stmt->execute();

return $this;*/