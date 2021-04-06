<?php 

require 'Result.php';

class Api 
{
    public function avgRotorSpeed($status, $parentId)
    {
        
        $result = new Result;
        $result->getJson("RUNNING",7,1);

        $total_itens = 0;
        $elementos = array();
        $total = $result->getTotalPages();


        for ($x = 0; $x <= $total; $x++) {
            $result->getJson("RUNNING",7,$x);
            $total = $result->getTotalPages();
            $temp = $result->getItems();

            if (count($temp) > 0) {
                foreach ($temp as $t) {
                    $elementos[] = $t;
                }
            }
            
        }
        $total_items = count($elementos);

        $soma = array_sum($elementos);
        return floor($soma / $total_items); 

    }
}