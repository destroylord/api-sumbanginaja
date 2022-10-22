<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Province;
use Illuminate\Http\Request;

class ProvinceController extends Controller
{
    public function getAll()
    {
        $provinces = Province::all();

        return response()
            ->json([
                "status" => true,
                "messages" => "show all data province",
                'data' => $provinces
            ]);
    }

    public function getProvinceId($id)
    {
        $provincesById = Province::where('id', $id)->get();

        return response()
            ->json([
                "status" => true,
                "messages" => "show data province by Id",
                'data' => $provincesById
            ]);
    }
}
