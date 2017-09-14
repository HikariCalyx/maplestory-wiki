<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/item', function (Request $request) {
    $query = [];
    $oldData = [];

    $position = $request->query('position');
    if (isset($position)) {
        $query[] = 'startPosition=' . urlencode($position);
        $oldData['position'] = $position;
    }
    $count = $request->query('count') ?? '50';
    if (isset($count)) {
        $query[] = 'count=' . urlencode($count);
        $oldData['count'] = $count;
    }
    $overallCategory = $request->query('overallCategory');
    if (isset($overallCategory)) {
        $query[] = 'overallCategoryFilter=' . urlencode($overallCategory);
        $oldData['overallCategory'] = $overallCategory;
    }
    $category = $request->query('category');
    if (isset($category)) {
        $query[] = 'categoryFilter=' . urlencode($category);
        $oldData['category'] = $category;
    }
    $subCategory = $request->query('subCategory');
    if (isset($subCategory)) {
        $query[] = 'subCategoryFilter=' . urlencode($subCategory);
        $oldData['subCategory'] = $subCategory;
    }
    $job = $request->query('job');
    if (isset($job)) {
        $query[] = 'jobFilter=' . urlencode(strval(is_array($job) ? array_reduce($job, function ($carry, $item) {
            if (!isset($carry)) $carry = intval($item);
            else $carry |= intval($item);
            return $carry;
        }) : intval($job)));
        $oldData['job'] = is_array($job) ? $job : [$job];
    }
    $cash = $request->query('cash') == 'on';
    if (isset($cash)) {
        $query[] = 'cashFilter=' . urlencode($cash);
        $oldData['cash'] = $cash;
    }
    $minLevel = $request->query('minLevel');
    if (isset($minLevel)) {
        $query[] = 'minLevelFilter=' . urlencode($minLevel);
        $oldData['minLevel'] = $minLevel;
    }
    $maxLevel = $request->query('maxLevel');
    if (isset($maxLevel)) {
        $query[] = 'maxLevelFilter=' . urlencode($maxLevel);
        $oldData['maxLevel'] = $maxLevel;
    }
    $gender = $request->query('gender');
    if (isset($gender)) {
        $query[] = 'genderFilter=' . urlencode($gender);
        $oldData['gender'] = $gender;
    }
    $search = $request->query('search');
    if (isset($search)) {
        $query[] = 'searchFor=' . urlencode($search);
        $oldData['search'] = $search;
    }

    $queryJoined = implode('&', $query);

    $itemList = json_decode(file_get_contents(getenv('API_URL') . '/api/gms/latest/item?' . $queryJoined));
    $categories = json_decode(file_get_contents(getenv('API_URL') . '/api/gms/latest/item/category'));

    return view('itemlist', ['items' => $itemList, 'oldQuery' => $oldData, 'categories' => $categories]);
});

Route::get('/item/{id}', function ($id) {
    $itemData = json_decode(file_get_contents(getenv('API_URL') . '/api/gms/latest/item/' . $id));
    return view('item', ['item' => $itemData]);
});

Route::get('/mob/{id}', function ($id) {
    $mobData = json_decode(file_get_contents(getenv('API_URL') . '/api/gms/latest/mob/'. $id));
    return view('mob', ['mob' => $mobData]);
});

Route::get('/npc/{id}', function ($id) {
    $npcData = json_decode(file_get_contents(getenv('API_URL') . '/api/gms/latest/npc/'. $id));
    return view('npc', ['npc' => $npcData]);
});

Route::get('/map/{id}', function ($id) {
    $mapData = json_decode(file_get_contents(getenv('API_URL') . '/api/gms/latest/map/'. $id));
    return view('map', ['map' => $mapData]);
});
