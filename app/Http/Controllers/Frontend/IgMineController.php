<?php namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;


/**
 * Class DashboardController
 * @package App\Http\Controllers\Frontend
 */
class IgMineController extends Controller {
	public function __construct(){
		$debug = false;

		if($debug) {
			DB::enableQueryLog();
			DB::listen(
				function ($sql, $bindings, $time) {
					echo "<pre>";
					echo $sql;
					echo "</pre>";
				}
			);
		}
	}
	/**
	 * @return mixed
	 */
	public function london(Request $request)
	{
		$images = DB::table('london')
			->leftJoin('selfie','selfie.id', '=', 'london.id')
			->select('london.*', 'selfie.id as is_selfie')
			->orderBy('created_time', 'desc');
		$append = array();
		if($request->has('tag')){
			$images->join('tags_images', 'london.id', '=', 'tags_images.image_id')
				   ->join('tags', 'tags_images.tag_id', '=', 'tags.id')
				   ->where('tags.tag', '=', $request->input('tag'));
			$append['tag'] = $request->input('tag');
		}
		if($request->has('type')){
			$images->where('london.type', '=', $request->input('type'));
			$append['type'] = $request->input('type');
		}
		if($request->has('filter')){
			$images->where('london.filter', '=', $request->input('filter'));
			$append['filter'] = $request->input('filter');
		}
		$images = $images->paginate(102);

		return view('frontend.igmine.london',[
			'images' => $images,
			'append' => $append

		]);
	}

	public function selfie(Request $request)
	{
		$images = DB::table('selfie')
			->leftJoin('london', 'selfie.id', '=', 'london.id')
			->select('london.*', 'selfie.id as is_selfie');

		if($request->has('tag')){
			$images->where('tags.tag', '=', $request->input('tag'))
				->join('tags_images', 'london.id', '=', 'tags_images.image_id')
				->join('tags', 'tags_images.tag_id', '=', 'tags.id')
				->groupBy('id');
		}

		$images = $images->get();

		return view('frontend.igmine.selfie',[
			'images' => $images
		]);
	}

	public function tagSelfie(Request $request)
	{
		DB::table('selfie')->insert(
			['id'=>$request->input('id')]
		);

		return response()->json(['message' => 'success insert']);
	}

	public function removeTagSelfie(Request $request)
	{
		DB::table('selfie')->where('id', '=', $request->input('id'))->delete();

		return response()->json(['message' => 'success delete']);
	}
}