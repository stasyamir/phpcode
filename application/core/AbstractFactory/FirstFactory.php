<?php
/**
 * Created by PhpStorm.
 * User: Станислав Мирошник
 * Date: 11/29/2018
 * Time: 12:02 PM
 */

namespace application\core\AbstractFactory;

class FirstFactory extends AbstractFactory
{
    public function getObject()
    {
        return new Person(); // создаем экземпляр класса Person
    }
}