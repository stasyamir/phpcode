<?php
/**
 * Created by PhpStorm.
 * User: Станислав Мирошник
 * Date: 11/29/2018
 * Time: 11:15 AM
 */

namespace application\core;

class Singleton
{
    private static $instance = null; //Переменная для хранения экземпляра класса
    private function __construct(){} //private конструктор для невозможности вызова оператором new
    private function __clone(){} //private для клонирования для невозможности клонирования объекта

    public static function getInstance(){ //метод для создания экзампляра класса
        if (self::$instance == null) { //создать экземпляр если еще не создан
            self::$instance = new self();
        }

        return self::$instance; //вернуть значение экземпляра класса
    }
}