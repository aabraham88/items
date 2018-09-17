<?php

namespace App\Http\Controllers;

use App\Item;

class ImageController extends Controller
{
    public function itemImage($itemId)
    {
        $headers = ['Content-Type' => 'image/jpeg'];
        $item = Item::findOrFail($itemId);

        $storagePath = storage_path($item->image_path);
        return response()->file($storagePath, $headers);
    }
}
