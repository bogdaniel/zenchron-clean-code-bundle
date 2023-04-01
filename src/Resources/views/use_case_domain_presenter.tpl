<?php
namespace App\{{boundedContext}}\Domain\UseCases\{{useCaseName}}\Contract;

use App\User\Domain\UseCases\{{useCaseName}}\{{useCaseName}}{{boundedContext}}Response;

interface {{useCaseName}}{{boundedContext}}PresenterContract
{
    public function present({{useCaseName}}{{boundedContext}}Response $response);
}
