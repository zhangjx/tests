<?php

class RestClient {

    public $uri         = ''; // Request base uri
    public $format      = ''; // Request data format
    public $cookie      = ''; // Request cookie
    public $user_agent  = ''; // User agent

    public function __construct($uri = '', $format = '', $cookie = '', $user_agent = '') {
        $this->uri          = $this->setOption($uri);
        $this->format       = $this->setFormat($format);
        $this->cookie       = $this->setOption($cookie);
        $this->user_agent   = $this->setOption($user_agent);
    }

    // note Get request
    public function get($url) {
       return $this->send($url, "GET");
    }

    // note Post request
    public function post($url, $data = '') {
       return $this->send($url, "POST", $data);
    }

    // note Put request
    public function put($url, $data = '') {
       return $this->send($url, "PUT", $data);
    }

    // note Delete request
    public function delete($url) {
       return $this->send($url, "DELETE");
    }

    /**
     * Set option
     *
     * @param   $val    [String]    option value
     * @return          [String]    value or ''
     */
    private function setOption($val) {
        return $val ? $val : '';
    }

    /**
     * Set request data format
     *
     * @param   $val    [String]    format type include [json, html, xml]
     * @return          [String]    return format true value
     */
    private function setFormat($val) {
        $values = array(
            'json' => 'application/json',
            'html' => 'text/html',
            'xml'  => 'text/xml',
        );
        return isset($values[$val]) ? $values[$val] : $values['json'];
    }

    /**
     * Send request
     *
     * @param   $url    [String]    request url
     * @param   $method [String]    request method include [GET, POST, PUT, DELETE]
     * @param   $data   [String]    request data by [POST, PUT]
     * @return          [Array]     request response
     */
    private function send($url, $method, $data = '') {
        $methods = array('GET', 'POST', 'PUT', 'DELETE');

        if(!$url) {
            throw new Exception('Resquest url can not be empty');
        }

        if(!$method || !in_array($method, $methods)) {
            throw new Exception('Resquest method can not be empty');
        }

        // note exec request
        $url = $this->uri . $url;
        $result = $this->request($url, $method, $this->format, $data, $this->cookie, $this->user_agent);

        return $this->getResponseBody($result);
    }

    /**
     * Get request response info (handle request errors)
     *
     * @param   $result     [array]     response body include error
     * @return              [String]    response data (unlink error)
     */
    private function getResponseBody($result) {
        if($result['error']) {
            throw new Exception("Resquest Error, Error number: {$result['error']}");
        }
        return $result['data'];
    }

    /**
     * Use curl exec http request
     *
     * @param   $url      [String] request url
     * @param   $method   [String] request method inlude [GET, POST, PUT, DELETE]
     * @param   $format   [String] request data format inlude [json, html, xml]
     * @param   $post     [String] request post data . Default ''
     * @param   $cookie   [String] request cookie . Default ''
     * @param   $agent    [String] request user-agent . Default ''
     * @param   $referer  [String] request referer . Default ''
     * @param   $timeout  [Int]    request timeout . Default 100
     * @param   $output   [Boolean] if true then transfer by file stream
     * @return  $return   [Array] response ex: array('error' => 0, 'data' => 'test')
     */
    private function request($url, $method, $format = '', $post = '', $cookie = '', $agent = '', $referer = '', $timeout = 100, $output = false) {
        // note 变量初始化
        $ch = null;
        $errno = 0;
        $return = array();

        // note 初始化curl
        $ch = curl_init();

        // note 不缓存DNS
        curl_setopt($ch, CURLOPT_DNS_CACHE_TIMEOUT, 0);

        // note 设置要请求的URL
        curl_setopt($ch, CURLOPT_URL, $url);

        // note 设置要请求的方式
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);

        // note 设置超时时间
        //curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, ceil($timeout / 2));
        //curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);

        // note 设置连接端口
        //curl_setopt($ch, CURLOPT_PORT, 80);

        // note 设置请求数据的格式
        if($format) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: {$format}"));
        }

        // note 设置post data
        if($post) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        }

        // note 是否是https请求
        if(strpos($url, 'https:') === 0) {
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        }

        // note 不直接输出,以文件流的形式返回
        if(!$output) {
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        }

        // note 设置cookie
        if($cookie) {
            curl_setopt($ch, CURLOPT_COOKIE, $cookie);
        }

        // note 设置user_agent
        if($agent) {
            curl_setopt($ch, CURLOPT_USERAGENT, $agent);
        }

        // note 设置referer
        if($referer) {
            curl_setopt($ch, CURLOPT_REFERER, $referer);
        }

        // note 执行请求
        $return['data'] = curl_exec($ch);

        // note 处理请求错误
        $errno = curl_errno($ch);
        $return['error'] = $errno;

        // note 关闭请求
        curl_close($ch);

        return $return;
    }

}

?>
