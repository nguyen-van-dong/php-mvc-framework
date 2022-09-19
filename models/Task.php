<?php

namespace app\models;

use app\core\DBModel;

class Task extends DBModel
{
    public string $name = '';
    public string $start_at = '';
    public string $end_at = '';
    public int $status = 0;

    public function register()
    {
        return $this->save();
    }

    public function rules(): array
    {
        return [
            'name' => [self::RULE_REQUIRED],
            'start_at' => [self::RULE_REQUIRED],
            'end_at' => [self::RULE_REQUIRED],
        ];
    }

    public function tableName()
    {
        return 'tasks';
    }

    public function attributes(): array
    {
        return [
            'name',
            'start_at',
            'end_at',
            'status',
        ];
    }
}