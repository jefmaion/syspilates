<?php

declare(strict_types = 1);
// arquivo: configure-env.php

// Função para colorir texto
function color($text, $colorCode)
{
    return "\033[" . $colorCode . "m" . $text . "\033[0m";
}

// Se não existir .env, copia do exemplo
if (! file_exists('.env')) {
    copy('.env.example', '.env');
}

// Mensagem de boas-vindas
echo color("\n====================================\n", "36"); // azul claro
echo color(" Bem-vindo ao setup inicial!\n", "32"); // verde
echo color("====================================\n\n", "36");

// Nome padrão da aplicação
$appDefault = 'Laravel';
$appName    = readline("Informe o nome da aplicação (default: $appDefault): ");

if (trim($appName) === '') {
    $appName = $appDefault;
}
echo color("Nome da aplicação configurada!\n\n", "32"); // verde

// Nome padrão do banco de dados baseado na pasta
$dir       = strtolower(basename(getcwd()));
$dbDefault = 'laravel_' . $dir;
$dbName    = readline("Informe o nome do banco de dados (default: $dbDefault): ");

if (trim($dbName) === '') {
    $dbName = $dbDefault;
}

echo color("Nome do banco de dados configurado!\n\n", "32"); // verde
// Carrega .env
$env = file_get_contents('.env');

// Atualiza APP_NAME
$env = preg_replace('/^APP_NAME=.*/m', 'APP_NAME="' . $appName . '"', $env);

// Atualiza DB_DATABASE
$env = preg_replace('/^DB_DATABASE=.*/m', 'DB_DATABASE=' . $dbName, $env);

// Salva de volta
file_put_contents('.env', $env);

// Mensagem final
echo color("Configuração concluída! Prosseguindo com a instalação...\n\n", "32"); // verde

unlink(__FILE__);
