<?php

namespace App\Helpers;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use InvalidArgumentException;

class SlugHelper
{
    
	function slug($table, $field ,$data, $id = null)
	{
	    $slug = Str::slug($data);
	
	    $query = DB::table($table)->where($field,'like', '%'.$slug.'%');
	    if($id){
	    	$query->where('id','!=',$id);
	    }
	   
	   $slugData = $query->get();
	    if (count($slugData)) {
	        $slug = $slug . '-' . count($slugData);
	    }

	    return $slug;
	}
}
