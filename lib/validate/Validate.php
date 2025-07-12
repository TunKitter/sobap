<?php
var_dump(Validate::from('sdasasdsacom')->email('no bro')->numeric()->regex('/[0-5]/')->alphaNumericSpace()->validate());
class Validate
{
    private $input;
    private $queue = [];
    private function __construct($input)
    {
        $this->input = $input;
    }
    public static function from($input)
    {
        return new self($input);
    }

    private function handleValidate($condition, $key, $message)
    {
        if (!$condition) $this->queue[$key] = $message;
    }
    public function validate()
    {
        return ['is_error' => count($this->queue) > 0, 'data' => $this->queue];
    }
    public function email($message = 'Email is not valid')
    {
        $this->handleValidate(filter_var($this->input, FILTER_VALIDATE_EMAIL), 'email', $message);
        return $this;
    }
    public function alphaNumericSpace($message = 'The string contains invalid characters')
    {
        $this->handleValidate(preg_match('/^[a-zA-Z0-9\s]+$/', $this->input), 'alphaNumericSpace', $message);
        return $this;
    }
    public function regex($regex,$message = 'The string contains does not match regex')
    {
        $this->handleValidate(preg_match($regex, $this->input), 'regex', $message);
        return $this;
    }
    public function numeric($message = 'The string only contains numbers')
    {
        $this->handleValidate(is_numeric($this->input), 'numeric', $message);
        return $this;
    }

    public function alpha($message)
    {
        $this->handleValidate(preg_match('/^[a-zA-Z\s]+$/', $this->input), 'alpha', $message);
        return $this;
    }
    public function noSpecialChar($message)
    {
        $this->handleValidate(!preg_match('/[^a-zA-Z0-9\s]/', $this->input), 'noSpecialChar', $message);
        return $this;
    }
}