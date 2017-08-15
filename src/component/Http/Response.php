<?php

namespace Rudolf\Component\Http;

class Response
{
    /**
     * @var string Response content
     */
    private $content;

    /**
     * @var int Http response code
     */
    private $status;

    /**
     * @var array Headers
     */
    private $headers;

    /**
     * @var array Status codes translation table
     */
    public static $statusTexts = array(
        100 => 'Continue',
        101 => 'Switching Protocols',
        200 => 'OK',

        201 => 'Created',
        202 => 'Accepted',
        203 => 'Non-Authoritative Information',
        204 => 'No Content',
        205 => 'Reset Content',
        206 => 'Partial Content',

        300 => 'Multiple Choices',
        301 => 'Moved Permanently',
        302 => 'Found',
        303 => 'See Other',
        304 => 'Not Modified',
        305 => 'Use Proxy',
        307 => 'Temporary Redirect',

        400 => 'Bad Request',
        401 => 'Unauthorized',
        402 => 'Payment Required',
        403 => 'Forbidden',
        404 => 'Not Found',
        405 => 'Method Not Allowed',
        406 => 'Not Acceptable',
        407 => 'Proxy Authentication Required',
        408 => 'Request Time-out',
        409 => 'Conflict',
        410 => 'Gone',
        411 => 'Length Required',
        412 => 'Precondition Failed',
        413 => 'Request Entity Too Large',
        414 => 'Request-URI Too Large',
        415 => 'Unsupported Media Type',
        416 => 'Requested range not satisfiable',
        417 => 'Expectation Failed',

        500 => 'Internal Server Error',
        501 => 'Not Implemented',
        502 => 'Bad Gateway',
        503 => 'Service Unavailable',
        504 => 'Gateway Timeout',
        505 => 'HTTP Version Not Supported',
    );

    /**
     * Constructor.
     *
     * @param string $content The response content
     * @param int    $status  The response status code
     * @param array  $headers An array of response headers
     *
     * @throws \InvalidArgumentException When the HTTP status code is not valid
     */
    public function __construct($content = '', $status = 200, $headers = [])
    {
        $this->setContent($content);
        $this->setStatusCode($status);
        $this->headers = $this->setManyHeaders($headers);
    }

    /**
     * Set content.
     *
     * @param string $content Content to return in response
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * Set status code.
     *
     * @param int $code Http status code
     *
     * @throws \InvalidArgumentException
     */
    public function setStatusCode($code)
    {
        if (!isset(self::$statusTexts[$code])) {
            throw new \InvalidArgumentException('Invalid HTTP status code', 1);
        }
        $this->statusCode = $code;
    }

    /**
     * Set once header.
     *
     * @param array $header
     */
    public function setHeader($header)
    {
        if (empty($header)) {
            return false;
        }
        $this->headers[$header[0]] = $header[1];
    }

    /**
     * Set many headers.
     *
     * @param array $headers
     */
    public function setManyHeaders($headers)
    {
        if (empty($headers)) {
            return false;
        }
        foreach ($headers as $key => $value) {
            $this->setHeader($value);
        }
    }

    /**
     * Send headers.
     *
     * @return void|false
     */
    public function sendHeaders()
    {
        header('HTTP/1.1 '.$this->statusCode.' '.self::$statusTexts[$this->statusCode]);

        if (empty($this->headers)) {
            return false;
        }

        foreach ($this->headers as $key => $value) {
            header($key.': '.$value);
        }
    }

    /**
     * Send http response
     * It sends headers and content.
     *
     * @return string Response content
     */
    public function send()
    {
        $this->sendHeaders();

        return $this->content;
    }
}
