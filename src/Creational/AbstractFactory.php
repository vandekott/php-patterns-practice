<?php

/**
 * Абстрактная фабрика - это порождающий паттерн проектирования,
 * который позволяет создавать семейства связанных объектов,
 * не привязываясь к конкретным классам создаваемых объектов.
 */

/**
 * В этом примере берётся необходимость отображать логи.
 * В зависимости от типа лога, будет использоваться разный формат.
 */
interface AbstractLoggerInterface
{
    /**
     * Записать сообщение в лог
     * @param string $data
     * @return bool
     */
    public function log(mixed $data): bool;
}

/**
 * FileLogger запишет информацию в файл
 */
class FileLogger implements AbstractLoggerInterface
{
    public function log(mixed $data): bool
    {
        return $this->save(
            $this->format($data)
        );
    }

    private function format(mixed $data): string
    {
        return  match (gettype($data)) {
            'string', 'boolean', 'integer', 'double' => $data,
            default => var_export($data, true)
        };
    }

    private function save(string $data): bool
    {
        $this->ensureFileExists();

        return (bool) file_put_contents(
            filename: __DIR__ . '/AbstractFactory/log.txt',
            data: $data,
            flags: FILE_APPEND
        );
    }

    private function ensureFileExists(): void
    {
        if (!file_exists(__DIR__ . '/AbstractFactory/log.txt')) {
            if (!file_exists(__DIR__ . '/AbstractFactory')) {
                mkdir(__DIR__ . '/AbstractFactory');
            }
            touch(__DIR__ . '/AbstractFactory/log.txt');
        }
    }
}

/**
 * ConsoleLogger запишет информацию в консольный вывод
 */
class ConsoleLogger implements AbstractLoggerInterface
{
    public function log(mixed $data): bool
    {
        var_export($data);
        return true;
    }
}

/**
 * Класс приложения, который будет использовать логгеры
 */
class Application
{
    private AbstractLoggerInterface $logger;

    public function __construct(AbstractLoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function run(): void
    {
        $this->logger->log('Hello world!');
    }
}

/**
 * Проверяем полученный результат
 */

// Запустим логгер для файла
echo '[FileLogger]' . PHP_EOL;
if (file_exists(__DIR__ . '/AbstractFactory/log.txt')) {
    unlink(__DIR__ . '/AbstractFactory/log.txt');
}
(new Application(new FileLogger()))->run();
echo 'Записано: ' . file_get_contents(__DIR__ . '/AbstractFactory/log.txt') . PHP_EOL;

echo PHP_EOL;
// Запустим логгер для консоли
echo '[ConsoleLogger]' . PHP_EOL;
(new Application(new ConsoleLogger()))->run();
