<?php

namespace app\core;

abstract class Model
{
    const RULE_REQUIRED = 'required';
    const RULE_EMAIL = 'email';
    const RULE_MIN = 'min';
    const RULE_MAX = 'max';
    const RULE_MATCH = 'match';

    public array $errors = [];

    /**
     * @param $data
     */
    public function loadData($data)
    {
        foreach ($data as $key => $value) {
            if (property_exists($this, $key)) {
                $this->{$key} = $value;
            }
        }
    }

    /**
     * @return bool
     */
    public function validate(): bool
    {
        foreach ($this->rules() as $attribute => $rules) {
            $value = $this->{$attribute};
            foreach ($rules as $key => $rule) {
                $ruleName = $rule;
                if (!is_string($ruleName)) {
                    $ruleName = $rule[0];
                }
                if (!$value && self::RULE_REQUIRED === $ruleName) {
                    $this->addError($attribute, self::RULE_REQUIRED);
                }
                if (self::RULE_EMAIL == $ruleName && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
                    $this->addError($attribute, self::RULE_EMAIL);
                }
                if ($ruleName === self::RULE_MIN && strlen($value) < $rule['min']) {
                    $this->addError($attribute, self::RULE_MIN, $rule);
                }
                if ($ruleName === self::RULE_MAX && strlen($value) > $rule['max']) {
                    $this->addError($attribute, self::RULE_MAX, $rule);
                }
                if ($ruleName === self::RULE_MATCH && !$value !== $this->{$rule['match']}) {
                    $this->addError($attribute, self::RULE_MATCH, $rule);
                }
            }
        }
        return empty($this->errors);
    }

    /**
     * @param  string  $attribute
     * @param  string  $rule
     * @param  array  $params
     */
    public function addError(string $attribute, string $rule, $params = [])
    {
        $message = $this->errorMessage()[$rule] ?? '';
        foreach ($params as $key => $value) {
            $message = str_replace("{${key}}", $value, $message);
        }
        $this->errors[$attribute][] = $message;
    }

    /**
     * @return string[]
     */
    public function errorMessage(): array
    {
        return [
            self::RULE_REQUIRED => 'This field is required',
            self::RULE_EMAIL => 'This field must be valid email address',
            self::RULE_MIN => 'This field is min {min}',
            self::RULE_MAX => 'This field is max {max}',
            self::RULE_MATCH => 'This field is must be the same as {match}',
        ];
    }

    abstract public function rules(): array;

    /**
     * @param $attribute
     * @return false|mixed
     */
    public function hasError($attribute): bool
    {
        return $this->errors[$attribute] ?? false;
    }

    /**
     * @param $attribute
     * @return bool
     */
    public function getFirstError($attribute): bool
    {
        return $this->errors[$attribute][0] ?? false;
    }
}