<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
    }
}
