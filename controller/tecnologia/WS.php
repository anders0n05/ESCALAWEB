<?php

class WebService
{
    static private $curl;
    static private $header;
    static private $body;
    static private $url = 'http://LOCALHOST:9999/escalasoft/';

    static function setupCURL($url = null, $data = null)
    {
        self::$curl = curl_init();

        if ($url) {
            self::setUrl($url);
        }

        if ($data) {
            self::setPostData($data);
        }

        curl_setopt(self::$curl, CURLOPT_POST, true);
        curl_setopt(self::$curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt(self::$curl, CURLOPT_VERBOSE, true);
        curl_setopt(self::$curl, CURLOPT_HEADER, true);
    }

    // Irá setar a URL do CURL
    static function setUrl($url)
    {
        curl_setopt(self::$curl, CURLOPT_URL, self::$url . $url);
    }

    // Irá setar os dados e o tipo dos dados que será enviado vir CURL
    static function setPostData($data, $type = null)
    {
        $data = json_encode($data);

        if (isset($type)) {
            $type = "application/json";
        }

        curl_setopt(self::$curl, CURLOPT_POSTFIELDS, $data);

        curl_setopt(
            self::$curl,
            CURLOPT_HTTPHEADER,
            array(
                "Content-Type: $type",
                'Content-Length: ' . strlen($data)
            )
        );
    }

    static function execute()
    {
        $result = curl_exec(self::$curl);

        if (curl_errno(self::$curl)) {
            self::$body = " Erro ao conectar-se ao WebService.";
        } else {
            $header_size = curl_getinfo(self::$curl, CURLINFO_HEADER_SIZE);
            self::$header = substr($result, 0, $header_size);
            self::$body = substr($result, $header_size);
        }

        curl_close(self::$curl);
    }

    static function getHeader()
    {
        return self::$header;
    }

    static function getBody()
    {
        return self::$body;
    }
}
