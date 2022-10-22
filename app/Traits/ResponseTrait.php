<?php

namespace App\Traits;

/**
 *
 */
trait ResponseTrait
{
    protected function return_success($status, object $data)
    {
        return response()
            ->json([
                "status" => $status,
                "data" => $data
            ], $status);
    }
}
