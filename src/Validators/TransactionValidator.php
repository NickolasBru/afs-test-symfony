<?php
namespace App\Validators;

use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Validator\Constraints as Assert;

class TransactionValidator
{
    private ValidatorInterface $validator;

    public function __construct(ValidatorInterface $validator)
    {
        $this->validator = $validator;
    }

    public function validate(array $data)
    {
        $constraints = new Assert\Collection([
            'trade_id' => [
                new Assert\NotNull(message: 'Trade ID is required.'),
                new Assert\Type(type: 'integer', message: 'Trade ID must be an integer.'),
            ],
            'client_name' => [
                new Assert\NotNull(message: 'Client name is required.'),
                new Assert\Type(type: 'string', message: 'Client name must be a string.'),
                new Assert\Length(
                    max: 255,
                    maxMessage: 'Client name must not exceed {{ limit }} characters.'
                ),
            ],
            'price' => [
                new Assert\NotNull(message: 'Price is required.'),
                new Assert\Type(type: 'numeric', message: 'Price must be a numeric value.'),
                new Assert\GreaterThanOrEqual(value: 0, message: 'Price must be greater than or equal to 0.'),
            ],
            'commodity' => [
                new Assert\NotNull(message: 'Commodity is required.'),
                new Assert\Type(type: 'string', message: 'Commodity must be a string.'),
                new Assert\Length(
                    max: 255,
                    maxMessage: 'Commodity must not exceed {{ limit }} characters.'
                ),
            ],
            'volume' => [
                new Assert\NotNull(message: 'Volume is required.'),
                new Assert\Type(type: 'integer', message: 'Volume must be an integer.'),
                new Assert\GreaterThanOrEqual(value: 0, message: 'Volume must be greater than or equal to 0.'),
            ],
            'type' => [
                new Assert\NotNull(message: 'Type is required.'),
                new Assert\Type(type: 'string', message: 'Type must be a string.'),
                new Assert\Choice(
                    choices: ['Buy', 'Sell'],
                    message: 'Type must be either "buy" or "sell".'
                ),
            ],
        ]);

        return $this->validator->validate($data, $constraints);
    }
}
