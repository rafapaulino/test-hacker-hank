<?php 

class Result
{
    protected $totalPages;
    protected $items;

    public function __construct()
    {
        $this->setTotalPages(0);
        $this->setItems(array());
    }

    public function getJson($status = "RUNNING", $parent = 7, $page = 1)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://jsonmock.hackerrank.com/api/iot_devices/search?status=' . $status . '&page=' . $page,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'GET',
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        $json = json_decode($response, true);
        
        //pegando o total de páginas
        $this->setTotalPages($json["total_pages"]);

        //pegando o itens com o parentId informado
        $this->getSpeed($json,$parent);
        
    }

    private function getSpeed($json, $parent)
    {
        $speed = array();

        if (isset($json["data"])) 
        {
            foreach ($json["data"] as $data)
            {
                if ( isset($data["parent"]) && $data["parent"]["id"] == $parent ) {
                    $speed[] = $data["operatingParams"]["rotorSpeed"];
                }
            }
        }
        $this->setItems($speed);
    }

    /**
     * Get the value of totalPages
     */ 
    public function getTotalPages()
    {
        return $this->totalPages;
    }

    /**
     * Set the value of totalPages
     *
     * @return  self
     */ 
    public function setTotalPages($totalPages)
    {
        $this->totalPages = intval($totalPages);

        return $this;
    }


    /**
     * Get the value of items
     */ 
    public function getItems()
    {
        return $this->items;
    }

    /**
     * Set the value of items
     *
     * @return  self
     */ 
    public function setItems($items)
    {
        $this->items = $items;

        return $this;
    }
}
