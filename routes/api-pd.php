<?php


use App\Models\Item;
use App\Models\Store;
use Illuminate\Http\Request;


Route::get('stores', function (){
    return Store::all();
});

Route::get('stores/{store}', function (string $store){
    return Store::with('items')->where('slug',$store)->first();
});

Route::get('stores/{store}/items', function (string $store) {
    return Item::where('store_id', Store::where('slug', $store)->first()->id)->get();
});

Route::post('stores', function (Request $request){
    return Store::create(['name' => $request->input('name')]);
});

Route::post('stores/{store}/items', function (string $store, Request $request){
    return Store::where('slug',$store)->first()
        ->items()
        ->create([
            'name' => $request->input('name'),
            'price' => $request->input('price')
        ]);
});

Route::put('stores/{store}/update', function (string $store, Request $request){

    $store = Store::where('slug', $store)->first();
    $store->update([
        'name' => $request->input('name')
    ]);

   return $store;

});
