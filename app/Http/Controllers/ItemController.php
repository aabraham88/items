<?php

namespace App\Http\Controllers;

use App\Http\Requests\ItemRequest;
use App\Http\Requests\ItemSortRequest;
use App\Http\Requests\ItemUpdateRequest;
use App\Http\Resources\ItemResource;
use App\Item;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

/**
 * Class ItemController
 * @package App\Http\Controllers
 */
class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = ItemResource::collection(Item::orderBy('sort_order')->get());

        return $this->success($items);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ItemRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ItemRequest $request)
    {
        $max = Item::max('sort_order');

        try {
            $imagePath = $request->imageFile->store('images');

            $imagePath = 'app/' . $imagePath;

            $item = Item::create([
                'description' => $request->description,
                'image_path' => $imagePath,
                'sort_order' => $max + 1,
            ]);

            return $this->success(new ItemResource($item), 'Item saved correctly.', Response::HTTP_CREATED);
        } catch (\Exception $e) {
            return $this->error('Something bad happend.', Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = new ItemResource(Item::find($id));

        return $this->success($item);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ItemUpdateRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(ItemUpdateRequest $request, $id)
    {
        try {
            $item = Item::find($id);

            if ($request->has('imageFile')) {
                $imagePath = $request->imageFile->store('images');

                $imagePath = 'app/' . $imagePath;

                $item->image_path = $imagePath;
            }

            $item->description = $request->description;
            $item->save();

            return $this->success(new ItemResource($item), 'Item updated correctly.', Response::HTTP_ACCEPTED);
        } catch (\Exception $e) {
            return $this->error('Something bad happend.', Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $item = Item::find($id);
            $imagePath = str_replace('app/', '', $item->image_path);
            Storage::delete($imagePath);

            if ($item->delete()) {
                return $this->success(null, 'Item deleted correctly.');
            }
        } catch (\Exception $e) {
            return $this->error('Something bad happend.', Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     *  Update sort order with the order given
     *
     * @param ItemSortRequest $request
     * @return \Illuminate\Http\JsonResponse
     */

    public function sort(ItemSortRequest $request)
    {
        $items = json_decode($request->items);

        try {
            foreach ($items as $index => $item) {
                $item = Item::find($item);
                $item->sort_order = $index+1;
                $item->save();
            }

            return $this->success(null, 'Items ordered  correctly.');
        } catch (\Exception $e) {
            return $this->error('Something bad happend.', Response::HTTP_BAD_REQUEST);
        }
    }
}
