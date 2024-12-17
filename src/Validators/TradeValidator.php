<?php
namespace App\Validators;

use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Validator\Constraints as Assert;

class TradeValidator
{
    private ValidatorInterface $validator;

    public function __construct(ValidatorInterface $validator)
    {
        $this->validator = $validator;
    }

    public function validate(array $data)
    {
        $constraints = new Assert\Collection([
            'date' => [
                new Assert\NotBlank(),
                new Assert\Date,
            ],
            'note' => [
                new Assert\Length(max: 255,
                    maxMessage: 'The note cannot be longer than 255 characters',)
            ],
        ]);

        return $this->validator->validate($data, $constraints);
    }
}
