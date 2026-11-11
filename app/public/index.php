<?php

require __DIR__ . '/../vendor/autoload.php';

function check(string $name, callable $fn): void {
    try {
        echo "<p>✅ {$name}: " . htmlspecialchars((string) $fn()) . "</p>";
    } catch (Throwable $e) {
        echo "<p>❌ {$name}: " . htmlspecialchars($e->getMessage()) . "</p>";
    }
}

check('Postgres', function () {
    $pdo = new PDO(
        'pgsql:host=' . getenv('DB_HOST') . ';port=5432;dbname=' . getenv('DB_NAME'),
        getenv('DB_USER'),
        getenv('DB_PASSWORD'),
    );
    return $pdo->query('SELECT version()')->fetchColumn();
});

check('Redis', function () {
    $redis = new Redis();
    $redis->connect('redis');
    return 'визитов: ' . $redis->incr('visits');
});

check('Memcached', function () {
    $mc = new Memcached();
    $mc->addServer('memcached', 11211);
    $mc->set('hello', 'привет из memcached');
    $value = $mc->get('hello');
    if ($value === false) {
        throw new RuntimeException($mc->getResultMessage());
    }
    return $value;
});

check('Composer + Carbon', function () {
    return \Carbon\Carbon::now('Asia/Yekaterinburg')->locale('ru')->isoFormat('LLLL');
});

phpinfo();