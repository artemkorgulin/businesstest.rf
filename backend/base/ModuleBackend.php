<?php
namespace backend\base;

/**
 * Interface ModuleBackend
 * Фронт-контроллер административной части модуля
 *
 * @package backend\base
 */
interface ModuleBackend
{
    /**
     * Конфигуратор главного меню админ-панели
     * @return array
     */
    public static function backend();
}