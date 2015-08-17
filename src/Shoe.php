<?php

    class Shoe
    {

        private $brand;
        private $color;
        private $id;

        function __construct($brand, $color, $id = null)
        {
                $this->brand = $brand;
                $this->color = $color;
                $this->id = $id;
        }

        function getId()
        {
            return $this->id;
        }

        function setBrand($new_brand)
        {
            $this->brand = (string) $new_brand;
        }

        function getBrand()
        {
            return $this->brand;
        }

        function setColor($new_color)
        {
            $this->color = (string) $new_color;
        }

        function getColor()
        {
            return $this->color;
        }

        function save()
        {
                $GLOBALS['DB']->exec("INSERT INTO shoes (brand) VALUES ('{$this->getBrand()}');");
                $GLOBALS['DB']->exec("INSERT INTO shoes (color) VALUES ('{$this->getColor()}');");
                $this->id = $GLOBALS['DB']->lastInsertId();

        }

        static function getAll()
        {
            $returned_shoes = $GLOBALS['DB']->query("SELECT * FROM shoes;");
            $shoes = array();
            foreach($returned_shoes as $shoe) {
                $brand = $shoe['brand'];
                $color = $shoe['color'];
                $id = $shoe['id'];
                $new_shoe = new Shoe($brand, $color, $id);
                array_push($shoes, $new_shoe);
            }
            return $shoes;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM shoes;");
        }

        static function find($search_id)
        {
                $found_shoe = null;
                $shoes = Shoe::getAll();
                foreach($shoes as $shoe) {
                    $shoe_id = $shoe->getId();
                    if ($shoe_id == $search_id) {
                        $found_shoe = $shoe;
                    }
                }

                return $found_shoe;
        }
    }
?>
