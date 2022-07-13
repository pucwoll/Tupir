<?php return array (
  'providers' => 
  array (
    0 => 'Illuminate\\Broadcasting\\BroadcastServiceProvider',
    1 => 'Illuminate\\Bus\\BusServiceProvider',
    2 => 'Illuminate\\Cache\\CacheServiceProvider',
    3 => 'Illuminate\\Cookie\\CookieServiceProvider',
    4 => 'Illuminate\\Encryption\\EncryptionServiceProvider',
    5 => 'Illuminate\\Foundation\\Providers\\FoundationServiceProvider',
    6 => 'Illuminate\\Hashing\\HashServiceProvider',
    7 => 'Illuminate\\Pagination\\PaginationServiceProvider',
    8 => 'Illuminate\\Pipeline\\PipelineServiceProvider',
    9 => 'Illuminate\\Queue\\QueueServiceProvider',
    10 => 'Illuminate\\Session\\SessionServiceProvider',
    11 => 'Illuminate\\View\\ViewServiceProvider',
    12 => 'Laravel\\Tinker\\TinkerServiceProvider',
    13 => 'October\\Rain\\Foundation\\Providers\\ConsoleSupportServiceProvider',
    14 => 'October\\Rain\\Database\\DatabaseServiceProvider',
    15 => 'October\\Rain\\Halcyon\\HalcyonServiceProvider',
    16 => 'October\\Rain\\Filesystem\\FilesystemServiceProvider',
    17 => 'October\\Rain\\Parse\\ParseServiceProvider',
    18 => 'October\\Rain\\Html\\HtmlServiceProvider',
    19 => 'October\\Rain\\Html\\UrlServiceProvider',
    20 => 'October\\Rain\\Network\\NetworkServiceProvider',
    21 => 'October\\Rain\\Scaffold\\ScaffoldServiceProvider',
    22 => 'October\\Rain\\Flash\\FlashServiceProvider',
    23 => 'October\\Rain\\Mail\\MailServiceProvider',
    24 => 'October\\Rain\\Argon\\ArgonServiceProvider',
    25 => 'October\\Rain\\Redis\\RedisServiceProvider',
    26 => 'October\\Rain\\Validation\\ValidationServiceProvider',
    27 => 'System\\ServiceProvider',
  ),
  'eager' => 
  array (
    0 => 'Illuminate\\Cookie\\CookieServiceProvider',
    1 => 'Illuminate\\Encryption\\EncryptionServiceProvider',
    2 => 'Illuminate\\Foundation\\Providers\\FoundationServiceProvider',
    3 => 'Illuminate\\Pagination\\PaginationServiceProvider',
    4 => 'Illuminate\\Session\\SessionServiceProvider',
    5 => 'Illuminate\\View\\ViewServiceProvider',
    6 => 'October\\Rain\\Database\\DatabaseServiceProvider',
    7 => 'October\\Rain\\Halcyon\\HalcyonServiceProvider',
    8 => 'October\\Rain\\Filesystem\\FilesystemServiceProvider',
    9 => 'October\\Rain\\Html\\UrlServiceProvider',
    10 => 'October\\Rain\\Argon\\ArgonServiceProvider',
    11 => 'System\\ServiceProvider',
  ),
  'deferred' => 
  array (
    'Illuminate\\Broadcasting\\BroadcastManager' => 'Illuminate\\Broadcasting\\BroadcastServiceProvider',
    'Illuminate\\Contracts\\Broadcasting\\Factory' => 'Illuminate\\Broadcasting\\BroadcastServiceProvider',
    'Illuminate\\Contracts\\Broadcasting\\Broadcaster' => 'Illuminate\\Broadcasting\\BroadcastServiceProvider',
    'Illuminate\\Bus\\Dispatcher' => 'Illuminate\\Bus\\BusServiceProvider',
    'Illuminate\\Contracts\\Bus\\Dispatcher' => 'Illuminate\\Bus\\BusServiceProvider',
    'Illuminate\\Contracts\\Bus\\QueueingDispatcher' => 'Illuminate\\Bus\\BusServiceProvider',
    'cache' => 'Illuminate\\Cache\\CacheServiceProvider',
    'cache.store' => 'Illuminate\\Cache\\CacheServiceProvider',
    'cache.psr6' => 'Illuminate\\Cache\\CacheServiceProvider',
    'memcached.connector' => 'Illuminate\\Cache\\CacheServiceProvider',
    'hash' => 'Illuminate\\Hashing\\HashServiceProvider',
    'hash.driver' => 'Illuminate\\Hashing\\HashServiceProvider',
    'Illuminate\\Contracts\\Pipeline\\Hub' => 'Illuminate\\Pipeline\\PipelineServiceProvider',
    'queue' => 'Illuminate\\Queue\\QueueServiceProvider',
    'queue.worker' => 'Illuminate\\Queue\\QueueServiceProvider',
    'queue.listener' => 'Illuminate\\Queue\\QueueServiceProvider',
    'queue.failer' => 'Illuminate\\Queue\\QueueServiceProvider',
    'queue.connection' => 'Illuminate\\Queue\\QueueServiceProvider',
    'command.tinker' => 'Laravel\\Tinker\\TinkerServiceProvider',
    'command.cache.clear' => 'October\\Rain\\Foundation\\Providers\\ConsoleSupportServiceProvider',
    'command.cache.forget' => 'October\\Rain\\Foundation\\Providers\\ConsoleSupportServiceProvider',
    'command.clear-compiled' => 'October\\Rain\\Foundation\\Providers\\ConsoleSupportServiceProvider',
    'command.config.cache' => 'October\\Rain\\Foundation\\Providers\\ConsoleSupportServiceProvider',
    'command.config.clear' => 'October\\Rain\\Foundation\\Providers\\ConsoleSupportServiceProvider',
    'command.down' => 'October\\Rain\\Foundation\\Providers\\ConsoleSupportServiceProvider',
    'command.environment' => 'October\\Rain\\Foundation\\Providers\\ConsoleSupportServiceProvider',
    'command.key.generate' => 'October\\Rain\\Foundation\\Providers\\ConsoleSupportServiceProvider',
    'command.optimize' => 'October\\Rain\\Foundation\\Providers\\ConsoleSupportServiceProvider',
    'command.package.discover' => 'October\\Rain\\Foundation\\Providers\\ConsoleSupportServiceProvider',
    'command.queue.failed' => 'October\\Rain\\Foundation\\Providers\\ConsoleSupportServiceProvider',
    'command.queue.flush' => 'October\\Rain\\Foundation\\Providers\\ConsoleSupportServiceProvider',
    'command.queue.forget' => 'October\\Rain\\Foundation\\Providers\\ConsoleSupportServiceProvider',
    'command.queue.listen' => 'October\\Rain\\Foundation\\Providers\\ConsoleSupportServiceProvider',
    'command.queue.restart' => 'October\\Rain\\Foundation\\Providers\\ConsoleSupportServiceProvider',
    'command.queue.retry' => 'October\\Rain\\Foundation\\Providers\\ConsoleSupportServiceProvider',
    'command.queue.work' => 'October\\Rain\\Foundation\\Providers\\ConsoleSupportServiceProvider',
    'command.route.cache' => 'October\\Rain\\Foundation\\Providers\\ConsoleSupportServiceProvider',
    'command.route.clear' => 'October\\Rain\\Foundation\\Providers\\ConsoleSupportServiceProvider',
    'command.route.list' => 'October\\Rain\\Foundation\\Providers\\ConsoleSupportServiceProvider',
    'Illuminate\\Console\\Scheduling\\ScheduleFinishCommand' => 'October\\Rain\\Foundation\\Providers\\ConsoleSupportServiceProvider',
    'Illuminate\\Console\\Scheduling\\ScheduleRunCommand' => 'October\\Rain\\Foundation\\Providers\\ConsoleSupportServiceProvider',
    'command.seed' => 'October\\Rain\\Foundation\\Providers\\ConsoleSupportServiceProvider',
    'command.storage.link' => 'October\\Rain\\Foundation\\Providers\\ConsoleSupportServiceProvider',
    'command.up' => 'October\\Rain\\Foundation\\Providers\\ConsoleSupportServiceProvider',
    'command.view.clear' => 'October\\Rain\\Foundation\\Providers\\ConsoleSupportServiceProvider',
    'command.serve' => 'October\\Rain\\Foundation\\Providers\\ConsoleSupportServiceProvider',
    'command.vendor.publish' => 'October\\Rain\\Foundation\\Providers\\ConsoleSupportServiceProvider',
    'migrator' => 'October\\Rain\\Foundation\\Providers\\ConsoleSupportServiceProvider',
    'migration.repository' => 'October\\Rain\\Foundation\\Providers\\ConsoleSupportServiceProvider',
    'migration.creator' => 'October\\Rain\\Foundation\\Providers\\ConsoleSupportServiceProvider',
    'command.migrate' => 'October\\Rain\\Foundation\\Providers\\ConsoleSupportServiceProvider',
    'command.migrate.fresh' => 'October\\Rain\\Foundation\\Providers\\ConsoleSupportServiceProvider',
    'command.migrate.install' => 'October\\Rain\\Foundation\\Providers\\ConsoleSupportServiceProvider',
    'command.migrate.refresh' => 'October\\Rain\\Foundation\\Providers\\ConsoleSupportServiceProvider',
    'command.migrate.reset' => 'October\\Rain\\Foundation\\Providers\\ConsoleSupportServiceProvider',
    'command.migrate.rollback' => 'October\\Rain\\Foundation\\Providers\\ConsoleSupportServiceProvider',
    'command.migrate.status' => 'October\\Rain\\Foundation\\Providers\\ConsoleSupportServiceProvider',
    'command.migrate.make' => 'October\\Rain\\Foundation\\Providers\\ConsoleSupportServiceProvider',
    'composer' => 'October\\Rain\\Foundation\\Providers\\ConsoleSupportServiceProvider',
    'parse.markdown' => 'October\\Rain\\Parse\\ParseServiceProvider',
    'parse.yaml' => 'October\\Rain\\Parse\\ParseServiceProvider',
    'parse.twig' => 'October\\Rain\\Parse\\ParseServiceProvider',
    'parse.ini' => 'October\\Rain\\Parse\\ParseServiceProvider',
    'html' => 'October\\Rain\\Html\\HtmlServiceProvider',
    'form' => 'October\\Rain\\Html\\HtmlServiceProvider',
    'block' => 'October\\Rain\\Html\\HtmlServiceProvider',
    'network.http' => 'October\\Rain\\Network\\NetworkServiceProvider',
    'command.create.theme' => 'October\\Rain\\Scaffold\\ScaffoldServiceProvider',
    'command.create.plugin' => 'October\\Rain\\Scaffold\\ScaffoldServiceProvider',
    'command.create.model' => 'October\\Rain\\Scaffold\\ScaffoldServiceProvider',
    'command.create.controller' => 'October\\Rain\\Scaffold\\ScaffoldServiceProvider',
    'command.create.component' => 'October\\Rain\\Scaffold\\ScaffoldServiceProvider',
    'command.create.formwidget' => 'October\\Rain\\Scaffold\\ScaffoldServiceProvider',
    'command.create.reportwidget' => 'October\\Rain\\Scaffold\\ScaffoldServiceProvider',
    'command.create.command' => 'October\\Rain\\Scaffold\\ScaffoldServiceProvider',
    'flash' => 'October\\Rain\\Flash\\FlashServiceProvider',
    'mailer' => 'October\\Rain\\Mail\\MailServiceProvider',
    'swift.mailer' => 'October\\Rain\\Mail\\MailServiceProvider',
    'swift.transport' => 'October\\Rain\\Mail\\MailServiceProvider',
    'Illuminate\\Mail\\Markdown' => 'October\\Rain\\Mail\\MailServiceProvider',
    'redis' => 'October\\Rain\\Redis\\RedisServiceProvider',
    'redis.connection' => 'October\\Rain\\Redis\\RedisServiceProvider',
    'validator' => 'October\\Rain\\Validation\\ValidationServiceProvider',
    'validation.presence' => 'October\\Rain\\Validation\\ValidationServiceProvider',
  ),
  'when' => 
  array (
    'Illuminate\\Broadcasting\\BroadcastServiceProvider' => 
    array (
    ),
    'Illuminate\\Bus\\BusServiceProvider' => 
    array (
    ),
    'Illuminate\\Cache\\CacheServiceProvider' => 
    array (
    ),
    'Illuminate\\Hashing\\HashServiceProvider' => 
    array (
    ),
    'Illuminate\\Pipeline\\PipelineServiceProvider' => 
    array (
    ),
    'Illuminate\\Queue\\QueueServiceProvider' => 
    array (
    ),
    'Laravel\\Tinker\\TinkerServiceProvider' => 
    array (
    ),
    'October\\Rain\\Foundation\\Providers\\ConsoleSupportServiceProvider' => 
    array (
    ),
    'October\\Rain\\Parse\\ParseServiceProvider' => 
    array (
    ),
    'October\\Rain\\Html\\HtmlServiceProvider' => 
    array (
    ),
    'October\\Rain\\Network\\NetworkServiceProvider' => 
    array (
    ),
    'October\\Rain\\Scaffold\\ScaffoldServiceProvider' => 
    array (
    ),
    'October\\Rain\\Flash\\FlashServiceProvider' => 
    array (
    ),
    'October\\Rain\\Mail\\MailServiceProvider' => 
    array (
    ),
    'October\\Rain\\Redis\\RedisServiceProvider' => 
    array (
    ),
    'October\\Rain\\Validation\\ValidationServiceProvider' => 
    array (
    ),
  ),
);