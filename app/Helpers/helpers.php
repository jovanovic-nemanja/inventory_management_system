<?php

use App\Product;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;


function displayAlert()
{
      if (Session::has('message'))
      {
         list($type, $message) = explode('|', Session::get('message'));
         return  html_entity_decode('<div class="alert alert-'.$type.'"> <button type="button" class="close" data-dismiss="alert" aria-label="Close">
         <span aria-hidden="true">&times;</span></button>'.$message.'</div>');
      }

      return '';
}

// SLUG HELPER ==============================================================================
function createSlug($title, $id = 0)
{
    // Normalize the title
    $slug = str_slug($title);
    // Get any that could possibly be related.
    // This cuts the queries down by doing it once.
    // echo '<pre>';
    // print_r($slug);exit;

    $allSlugs = getRelatedSlugs($slug, $id);

    // If we haven't used it before then we are all good.
    if (!$allSlugs->contains('slug', $slug)) {
        return $slug;
    }

    // Just append numbers like a savage until we find not used.
    for ($i = 1; $i <= 10; $i++) {
        $newSlug = $slug . '-' . $i;
        if (!$allSlugs->contains('slug', $newSlug)) {
            return $newSlug;
        }
    }
    throw new \Exception('Can not create a unique slug');
}

function getRelatedSlugs($slug, $id = 0)
{
    $products = Product::select('slug')->where('slug', 'like', $slug . '%')
        ->where('id', '<>', $id)
        ->get();

    return $products;
}

// ROUTE HELPER ==============================================================================

function isActiveRoute($route)
{
    if (is_array($route)) {
        return in_array(Route::currentRouteName(), $route) ? 'active' : '';
    }

    return Route::currentRouteName() == $route ? 'active' : '';
}



