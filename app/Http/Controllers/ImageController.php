<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
<<<<<<< HEAD
use App\Image;
use Illuminate\Support\Facades\Response;
use Image;

class ImageController extends Controller
{
    
    public storeImage(Request $requests)
    {
        $request->validate([
            'image' => 'required|image|max:2048';
        ]);

        $image_file = $request->image;

        $image = Image::make($image_file);

        Response::make($image->encode('jpeg'));

        $form_data = array(
            'name' => $request->name,
            'description' => $request->description,
            'image' => $image
        );

        Image::create($form_data);
    }

    public getImage($id)
    {
        $img = App\Image::findorfail($id);

        $image_file = Image::make($img->image);
        $response = Response::make($img->encode('jpeg'));
        $response->header('content-type','image/jpeg');

        return $response;
=======
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

>>>>>>> 783631021fb7e6a2cb56489824e7ab0f4f5142b3
    }
}
