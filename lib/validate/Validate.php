<?php
class Validate
{
    protected $input;
    private $queue = [];
    protected function __construct($input)
    {
        $this->input = $input;
    }
    public static function with($input)
    {
        $input = preg_replace('/[^a-zA-Z0-9_]/', '', $input);
        if (empty($input)) throw new InvalidArgumentException('Invalid validator name');
        $filePath = getenv('ROOT_DIR') . "/lib/validate/own/$input.php";
        if (!file_exists($filePath)) throw new InvalidArgumentException("Validator class '$input' not found");
        require_once $filePath;
        return $input::from('');
    }
    public static function from($input)
    {
        return new static($input);
    }

    protected function handleValidate($condition, $key, $message)
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
    public function regex($regex, $message = 'The string does not match regex pattern')
    {
        $this->handleValidate(preg_match($regex, $this->input), 'regex', $message);
        return $this;
    }
    public function numeric($message = 'The string must contain only numbers')
    {
        $this->handleValidate(is_numeric($this->input), 'numeric', $message);
        return $this;
    }
}