<?php

namespace App\Http\Controllers;

use App\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    // all books
    public function index()
    {
        $books = Book::all()->toArray();
        return array_reverse($books);
    }

    // add book
    public function add(Request $request)
    {
        $book = new Book([
            'name' => $request->input('name'),
            'author' => $request->input('author')
        ]);
        $book->save();
        $token="eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiNDZmZDk1NzhkN2JiMjU5MzdiMjE0NjFmMzAyMTljZmUwZDI4NzMwMTQ4YTNhNmQ4OTkwZDE0YjlhZDY2MjQ2N2U5YmJiN2VmNzM3ZWQwNDYiLCJpYXQiOjE1ODE5MzQ5NzMsIm5iZiI6MTU4MTkzNDk3MywiZXhwIjoxNjEzNTU3MzcyLCJzdWIiOiIzIiwic2NvcGVzIjpbXX0.lKROqUmgTTDdM9-SGFigeuBAiv_T9tSkVgCI2h-xIf8fe1yYQ0wivrMAjwIVn7xbqb2EjlLjlzARNFsXygJt7K5lX6WYk17yNcN6ci3jCvS2GVhd1n4VGXYgHfD72G2C_-dIbNDjbRhbA1HX1yVzWpK2wDuHinavffQb0zwqAsVbfaIctMSzEHgNidStIHOHraEwOsQ5T9zEtZc8j26CVuk54acJG6qtbwZXuqNkYX9JyOP0tOZ28elttAriddegXy9FIr0gHJHo6auuUAzECVvBRtESaE84LnNKbGBWZY08-ukn_j35oPUKpyhoJuregXFxp01aawIRxUayog6a-NrPCJ3ChrDojTuJvouisFh_G6E2ay_90xwwc1mFJTOh6CYqxoAkgbSSWJCjJTljS4mfqPudUjbmRPezX1aZ8v-Hu1GPUer0pi367vm5VbInnwFokrmUWLi3P9q5fdvAtT7VM631iDGTOsPw-g1nvpemhVSTlDIAM6Kepqh90dG2ntw039t5vGetnfc5EYph8OUfutR7usWiNFodQmhiVpi9rVSXIiw6v-Tsh94V5T0J4tygSCrNynY-Nt7MF6A_LE2vGtpNq9GPKJ50Mce6wFASDaiD1_SiP7k2foE3YPHGwskB3Xg81r0kC5sSZoDYuoPqchi7tuJa32GkFmuVDlQ";
        $data = array("name" => $request->input('name'),"author" => $request->input('author'));


        $datapayload = json_encode($data);
        $ch = curl_init('http://localhost/Metropolis/public/api/books');
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $datapayload);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch,CURLOPT_HTTPHEADER, array(
            "accept: application/json",
            'Authorization: Bearer ' . $token,
            "cache-control: no-cache",
            "content-type: application/json",
        ));
        curl_exec($ch);
        curl_close($ch);

        return response()->json('The book successfully added');
    }

    // edit book
    public function edit($id)
    {
        $book = Book::find($id);
        return response()->json($book);
    }

    // update book
    public function update($id, Request $request)
    {
        $book = Book::find($id);
        $book->update($request->all());

        return response()->json('The book successfully updated');
    }

    // delete book
    public function delete($id)
    {
        $book = Book::find($id);
        $book->delete();

        return response()->json('The book successfully deleted');
    }
}
