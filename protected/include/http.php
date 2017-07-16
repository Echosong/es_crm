<?php

//数据采集，doGET,doPOST
class Http
{
    
    /**
     * 发送HTTP请求方法，目前只支持CURL发送请求
     * @param  string $url    请求URL
     * @param  array  $params 请求参数
     * @param  string $method 请求方法GET/POST
     * @return array  $data   响应数据
     */
    static function send($url, $params=array(), $method = 'GET', $header = array(), $multi = false) {
        $opts = array(CURLOPT_TIMEOUT => 30, CURLOPT_RETURNTRANSFER => 1, CURLOPT_SSL_VERIFYPEER => false, CURLOPT_SSL_VERIFYHOST => false, CURLOPT_HTTPHEADER => $header);

        /* 根据请求类型设置特定参数 */
        switch(strtoupper($method)) {
            case 'GET' :
                $opts[CURLOPT_URL] = $url . '&' . http_build_query($params);
                dump($opts[CURLOPT_URL]);
                break;
            case 'POST' :
                //判断是否传输文件
                $params = $multi ? $params : http_build_query($params);
                $opts[CURLOPT_URL] = $url;
                
                dump($opts[CURLOPT_URL]);
                $opts[CURLOPT_POST] = 1;
                $opts[CURLOPT_POSTFIELDS] = $params;
                break;
            default :
                throw new Exception('不支持的请求方式！');
        }

        /* 初始化并执行curl请求 */
        $ch = curl_init();
        curl_setopt_array($ch, $opts);
        $data = curl_exec($ch);
        $error = curl_error($ch);
        curl_close($ch);
        if ($error)
            throw new Exception('请求发生错误：' . $error);
        return $data;
    }

    /**
     * 提交json 数据
     */
    static function postjson($url, $data_string) {  
      
            $ch = curl_init();  
            curl_setopt($ch, CURLOPT_POST, 1);  
            curl_setopt($ch, CURLOPT_URL, $url);  
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string); 
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);   
			$header = self::formatHeader($url, $data);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $header);  
            ob_start();  
            curl_exec($ch);  
            $return_content = ob_get_contents();  
            ob_end_clean();  
      		
            $return_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);  
            return  $return_content;  
        }  
	
	static function  sendJson($url, $data){	
		$ch=curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_HEADER,1);
        curl_setopt($ch, CURLOPT_TIMEOUT,5);
        curl_setopt($ch,CURLOPT_POST, true);
        $header = self::formatHeader($url, $data);
        curl_setopt($ch, CURLOPT_HTTPHEADER,$header);
        curl_setopt($ch, CURLOPT_POSTFIELDS,$data);
        $rs=curl_exec($ch);
		return $rs;
	}
	
	
	static function formatHeader($url,$data){ 
            $temp = parse_url($url); 
            $query = isset($temp['query']) ? $temp['query'] : ''; 
            $path = isset($temp['path']) ? $temp['path'] : '/'; 
            $header = array ( 
            "POST {$path}?{$query} HTTP/1.1", 
            "Host: {$temp['host']}", 
            "Content-Type: application/json",  
            "Content-length: ".strlen($data), 
            "Connection: Close" 
            );
            return $header; 
        } 
	
}

?>

