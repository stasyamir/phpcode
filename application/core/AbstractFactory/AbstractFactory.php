<?php
/**
 * Created by PhpStorm.
 * User: Станислав Мирошник
 * Date: 11/29/2018
 * Time: 11:47 AM
 */

namespace application\core\AbstractFactory;


interface MyObject {
    public function getTitle(); //интерфейс для объекта с объявленным заголовком метода getTitle
}

abstract class AbstractFactory
{
    public static function getFactory() // метод возврата нового объекта
    {
        switch (Config::$factory) { //берем значение статической переменной из класса Config
            case 1:
                return new FirstFactory(); //если значение = 1 создаем фабрику1
                break;
            case 2:
                return new SecondFactory(); //если значение = 2 создаем фабрику2
                break;
        }
        throw new Exception('Not good config'); // при ошибке выводим соответствующее сообщение
    }
        abstract public function getObject(); //создаем абстрактныый метод getObject для получения данных об объекте
}