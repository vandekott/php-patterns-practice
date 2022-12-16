<?php

include_once __DIR__ . '/helpers.php';

// Абстрактная фабрика
introduct("Абстрактная фабрика", "Абстрактная фабрика - это порождающий паттерн
проектирования, который позволяет создавать семейства
связанных объектов, не привязываясь к конкретным
классам создаваемых объектов.\n");
include_once __DIR__ . '/Creational/AbstractFactory.php';

// Одиночка
introduct("Одиночка (Синглтон)", "Одиночка - это порождающий паттерн проектирования,
который гарантирует, что у класса есть только один экземпляр,
и предоставляет к нему глобальную точку доступа.\n");
include_once __DIR__ . '/Creational/Singleton.php';