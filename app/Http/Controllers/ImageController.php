<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Image;
use Images;

class ImageController extends Controller
{
    // get image from the database

    public function getImage($id)
    {

        $image = Image::findorfail($id);
        $img_file = Images::make($image->image);

        $response = Response::make($img_file->encode('jpeg'));
        $response->header('Content-Type','image/jpeg');

        return $response;

    }
}
