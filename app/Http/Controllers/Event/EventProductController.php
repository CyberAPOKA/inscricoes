<?php

namespace App\Http\Controllers\Event;

use App\Http\Controllers\Controller;
use App\Models\EventKit;
use App\Models\KitProduct;
use App\Models\ProductVariation;
use Illuminate\Http\Request;
use App\Core\Constants\ExtraProduct;
use App\Models\EventProduct;

class EventProductController extends Controller
{
    public function create(Request $request, $id)
    {
        // dd($request->all(), $id);

        $extra = ($request->extra === 'yes') ? ExtraProduct::YES : ExtraProduct::NO;

        // dd($extra);

        $product = EventProduct::create([
            'event_id' => $id,
            'name' => $request->name,
            'maximum_amount' => $request->maximum_amount,
            'extra' => $extra
        ]);

        $variations = $request->variations;

        foreach ($variations as $variation) {
            ProductVariation::create([
                'event_product_id' => $product->id,
                'variation' => $variation['variation'],
                'amount' => $variation['amount']
            ]);
        }

        //era usado para relacionar produtos e kits.
        // $kits = $request->selectedKitIds;

        // foreach ($kits as $kit) {
        //     KitProduct::create([
        //         'event_product_id' => $product->id,
        //         'event_kit_id' => $kit,
        //     ]);
        // }
    }

    public function extraProductCreate(Request $request, $id)
    {
        // dd($request->all());

        $product = EventProduct::create([
            'event_id' => $id,
            'name' => $request->name,
            'maximum_amount' => $request->maximum_amount,
            'extra' => ExtraProduct::YES
        ]);

        $variations = $request->variations;

        foreach ($variations as $variation) {
            ProductVariation::create([
                'event_product_id' => $product->id,
                'variation' => $variation['variation'],
                'amount' => $variation['amount']
            ]);
        }
    }

    public function delete($id)
    {
        $product = EventProduct::findOrFail($id);

        $product->delete();
    }

    public function update(Request $request, $id)
    {
        // dd($request->all(), $id);

        $product = EventProduct::findOrFail($id);

        $product->update([
            'name' => $request->name,
            'maximum_amount' => $request->maximum_amount
        ]);

        $has_variations = $request->input('has_variations');

        if ($has_variations === 'no') {
            $product->variations()->delete();
        }
    }



    public function extraProductEdit(Request $request, $id)
    {
        // dd($request->all(), $id);   

        $product = EventProduct::findOrFail($id);

        $product->update([
            'name' => $request->name,
            'maximum_amount' => $request->maximum_amount
        ]);

        // dd($request->haveVariation);
        if ($request->haveVariation === "no") {
            $product->variations()->delete();
        }

        if ($request->haveKit === "no") {
            $product->products()->delete();
        }

        if ($request->haveKit === "yes" && $request->kits) {
            $product->kits()->sync($request->kits);
        }
    }

    public function productWithoutKitDuplicate(Request $request, $id)
    {
        // dd($request->all(), $id);

        $product = EventProduct::create([
            'event_id' => $id,
            'name' => $request->product['name'],
            'maximum_amount' => $request->product['maximum_amount'],
            'extra' => $request->product['extra']
        ]);

        foreach ($request->product['variations'] as $variation) {
            ProductVariation::create([
                'event_product_id' => $product->id,
                'variation' => $variation['variation'],
                'amount' => $variation['amount'],
            ]);
        }
    }

    public function productWithoutKitDelete($id)
    {
        $product = EventProduct::findOrFail($id);

        $product->delete();
    }

    public function productVariationCreate(Request $request, $id)
    {
        $variation = ProductVariation::create([
            'event_product_id' => $id,
            'variation' => $request->variation,
            'amount' => $request->amount
        ]);

        return response()->json($variation);
    }


    public function productVariationUpdate(Request $request, $id)
    {
        $variation = ProductVariation::findOrFail($id);

        $variation->update([
            'variation' => $request->input('variation'),
            'amount' => $request->input('amount')
        ]);
    }

    public function deleteVariation($id)
    {
        $variation = ProductVariation::findOrFail($id);

        $variation->delete();
    }


    public function extraProductVariationCreate(Request $request, $id)
    {
        ProductVariation::create([
            'event_product_id' => $id,
            'variation' => $request->variation,
            'amount' => $request->amount
        ]);

        // $product = EventProduct::findOrFail($id);
        // $product->update([
        //     'maximum_amount' => $product->variations->sum('amount')
        // ]);
    }

    public function extraProductVariationUpdate(Request $request, $id)
    {
        $variation = ProductVariation::findOrFail($id);

        $variation->update([
            'variation' => $request->variation['variation'],
            'amount' => $request->variation['amount']
        ]);

        // $productId = $variation->event_product_id;
        // $product = EventProduct::findOrFail($productId);
        // $product->update([
        //     'maximum_amount' => $product->variations->sum('amount')
        // ]);
    }

    public function extraProductVariationDelete($id)
    {
        $variation = ProductVariation::findOrFail($id);

        $variation->delete();

        // $productId = $variation->event_product_id;
        // $product = EventProduct::findOrFail($productId);
        // $product->update([
        //     'maximum_amount' => $product->variations->sum('amount')
        // ]);
    }

    public function productDuplicate(Request $request, $id)
    {
        // dd($request->all(), $id);

        $product = EventProduct::create([
            'event_id' => $id,
            'name' => $request->product['product']['name'],
            'maximum_amount' => $request->product['product']['maximum_amount'],
            'extra' => $request->product['product']['extra'],
        ]);


        KitProduct::create([
            'event_kit_id' => $request->product['event_kit_id'],
            'event_product_id' => $product->id,
        ]);

        $variations = $request->product['product']['variations'];

        foreach ($variations as $variation) {
            ProductVariation::create([
                'event_product_id' => $product->id,
                'variation' => $variation['variation'],
                'amount' => $variation['amount']
            ]);
        }
    }

    public function productQuantityUpdate(Request $request)
    {
        // dd($request->input('productsRelation'));

        $products = $request->input('productsRelation');

        foreach ($products as $product) {
            $kitProduct = KitProduct::find($product['id']);

            if ($kitProduct) {
                $kitProduct->update(['quantity' => $product['quantity']]);
            }
        }
    }
}
