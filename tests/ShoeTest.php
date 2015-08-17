<?php

    /**
    *@backupGlobals disabled
    *@backupStaticAttributes disabled
    */

    require_once "src/Shoe.php";

    $server = 'mysql:host=localhost;dbname=shoes_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class ShoeTest extends PHPUnit_Framework_TestCase
    {
            protected function tearDown()

            {
                Shoe::deleteAll();
            }

            function test_save()
            {
                //Arrange
                $brand = "Nike";
                $test_shoe = new Shoe($brand);

                //Act
                $test_shoe->save();

                //Assert
                $result = Shoe::getAll();
                $this->assertEquals($test_shoe, $result[0]);
            }

            function test_getAll()
            {
                    //Arrange
                    $brand = "Nike";
                    $brand2 = "Adidas";
                    $test_Shoe = new Shoe ($brand);
                    $test_Shoe->save();
                    $test_Shoe2 = new Shoe ($brand2);
                    $test_Shoe2->save();

                    //Act
                    $result = Shoe::getAll();

                    //Assert
                    $this->assertEquals([$test_Shoe, $test_Shoe2], $result);
            }
    }
?>
