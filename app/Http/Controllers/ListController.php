<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;
class ListController extends Controller
{
	public function index(){
		$items = Item::all();

		return view('list', compact('items'));
	}

    public function create(request $request){
    	$item = new Item;
    	$item->item = $request->text;
    	$item->save();
    	return 'Done';
    }

    public function delete(request $request){

    	Item::where('id', $request->id)->delete();

    	//return $request->all();
    }

    public function update(request $request){

    	$item = Item::find($request->id);
    	$item->item = $request->value;
    	$item->save();

    	// return $request->all();
    }

    // auto complete
    // http://ajxlaravel/search?term=t
 	public function search(request $request){


    	// $item = Item::find($request->id);
    	// $item->item = $request->value;
    	// $item->save();
 		$term = $request->term;
 		$items =Item::where('item','LIKE', '%'.$term.'%')->get();
 		if (count($items) == 0) {
 			$searchResult[] = "No item found"; 			
 		}else{
 			foreach ($items as $key => $value) {
 				$searchResult[]= $value->item;
 			}
 		}

 		return $searchResult;
    }
}
