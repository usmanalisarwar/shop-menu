<?php

namespace App\Helpers;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use InvalidArgumentException;

class SlugHelper
{
    
	function slug($table, $field ,$data)
	{
	    $slug = Str::slug($data);
	
	    $slugData = DB::table($table)->where($field,'like', '%'.$slug.'%')->get();
	   
	    if (count($slugData)) {
	        $slug = $slug . '-' . count($slugData);
	    }

	    return $slug;
	}
}
