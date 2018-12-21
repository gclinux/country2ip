<?php
namespace gclinux;
class Country2Ip{
   private $db = NULL;

    function loadDb(string $path=NULL){
        $path or $path = dirname(__FILE__) .'/../db/ipdb';
        $data = file_get_contents($path);
        $this->db = json_decode($data,true);
        //return $this;
    }
/**
 * [getIps description]
 * @param  string $country_code          [两位国家代码]
 * @param  int    $need_return_ip_number [需要返回IP数量]
 * @return [array]                        [IP数组]
 */
    function getIps(string $country_code,int $need_return_ip_number=1){
        if(2 != strlen($country_code)){
            throw new Exception("Wrong Country Code:".$country_code, 1);
        }
        if($this->db === NULL){
            $this->loadDb();
        }
        $country_code = strtolower($country_code);
        $iplist = &$this->db[$country_code];
       // print_r($this->db);
        if(!$iplist){
            throw new Exception("Wrong Country Code:".$country_code, 1);
        }
        $return_data = [];
        for($i=0;$i<$need_return_ip_number;$i++){
            $k = array_rand($iplist,1);
            $range = &$iplist[$k];
            $return_data[] = long2ip(rand(inval($range[0]),intval($range[1])));
        }
        return $return_data;
    }


}