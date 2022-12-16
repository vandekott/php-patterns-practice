<?php

/**
 * Одиночка - это порождающий паттерн проектирования,
 * который гарантирует, что у класса есть только один экземпляр,
 * и предоставляет к нему глобальную точку доступа.
 */

/** Для примера, мы объявим класс с приватным свойством */
class Singleton
{
    private static ?Singleton $instance = null;
    private string $name;

    public static function getInstance(): self
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }
}

/** Теперь мы можем получить доступ к экземпляру класса */
$singleton = Singleton::getInstance();
$singleton->setName('Singleton');

echo "Точка доступа в глобальном scope: \$singleton->name = " . $singleton->getName() . "\n";

function someFunction() {
    $singleton2 = Singleton::getInstance();
    echo "Точка доступа внутри функции: \$singleton->name = " . $singleton2->getName() . "\n";

    (new class {
        public function method()
        {
            $singleton3 = Singleton::getInstance();
            echo "Точка доступа внутри метода анонимного класса: \$singleton->name = " . $singleton3->getName() . "\n";
        }
    })->method();

    $fn = function () {
        $singleton4 = Singleton::getInstance();
        echo "Точка доступа внутри замыкания: \$singleton->name = " . $singleton4->getName() . "\n";
    };

    $fn();
}

someFunction();
