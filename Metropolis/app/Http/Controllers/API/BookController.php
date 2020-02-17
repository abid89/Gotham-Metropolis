<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Book;
use Validator;

class BookController extends Controller
{
    public function store(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'name' => 'required',
            'author' => 'required'
        ]);

        if ($validator->fails()) {
            $response = [
                'success' => false,
                'data' => 'Validation Error.',
                'message' => $validator->errors()
            ];
            return response()->json($response, 404);
        }

        $book = Book::create($input);
        $data = $book->toArray();

        $response = [
            'success' => true,
            'data' => $data,
            'message' => 'Book stored successfully.'
        ];

        return response()->json($response, 200);
    }
}
