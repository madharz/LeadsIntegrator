<?php

namespace App\Validators;

class LeadValidator
{
    public function validate(array $data): void
    {
        if (empty($data['firstName']) || !preg_match('/^[a-zA-Zа-яА-ЯёЁіІїЇґҐ\s-]{2,50}$/u', $data['firstName'])) {
            throw new \Exception('First name is required and must contain only letters, spaces or hyphens (2-50 characters).');
        }

        if (empty($data['lastName']) || !preg_match('/^[a-zA-Zа-яА-ЯёЁіІїЇґҐ\s-]{2,50}$/u', $data['lastName'])) {
            throw new \Exception('Last name is required and must contain only letters, spaces or hyphens (2-50 characters).');
        }

        if (empty($data['phone']) || !preg_match('/^\+[1-9][0-9]{9,14}$/', $data['phone'])) {
            throw new \Exception('Phone is required and must be in international format starting with + and contain 10-15 digits.');
        }

        if (empty($data['email']) || !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            throw new \Exception('Valid email is required.');
        }
    }
}
