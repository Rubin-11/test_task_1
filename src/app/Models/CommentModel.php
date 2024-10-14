<?php

namespace App\Models;

use CodeIgniter\Model;

class CommentModel extends Model
{
    protected $table = 'comments';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'name',
        'text',
        'date',
    ];

    public function getComments($perPage, $offset, $field = 'id', $direction = 'asc')
    {
        $allowedDirections = ['asc', 'desc'];

        if (!in_array($field, $this->allowedFields)) {
            $field = 'id'; // Значение по умолчанию
        }

        if (!in_array(strtolower($direction), $allowedDirections)) {
            $direction = 'asc'; // Значение по умолчанию
        }

        return $this->orderBy($field, $direction)
            ->findAll($perPage, $offset);
    }
}