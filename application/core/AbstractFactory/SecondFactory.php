<?php
/**
 * Created by PhpStorm.
 * User: Станислав Мирошник
 * Date: 11/29/2018
 * Time: 12:09 PM
 */

namespace application\core\AbstractFactory;




class SecondFactory extends AbstractFactory
{
    public function getObject()
    {
        return new Home(); // создаем экземпляр класса Home
    }
}