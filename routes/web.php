<?php

use Illuminate\Support\Facades\Route;

use App\Models\Staff;
use App\Models\Photo;
use App\Models\Product;

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

Route::get('/', function () {
    return view('welcome');
});

//create
Route::get('/create', function () {
    $staff = Staff::findOrFail(1);
    $staff->photos()->create(['path' => 'staff_id_1.jpg']);
    return "Staff with id:1 photo saved to database";
});

//read
Route::get('/read', function () {
    $staff = Staff::findOrFail(1);
    foreach ($staff->photos as $photo) {
        echo $photo->path . "<br>";
    }
});

//update
Route::get('/update', function () {
    $staff = Staff::findOrFail(1);
    $photo = $staff->photos()->where('id', 1)->first(); //"first" returns an object whereas "get" returns a collection
    $photo->path = "Updated_staff_id_1.jpg";
    $photo->save();
    return "Staff id:1 with his image id:1 => image path updated";
});

//delete
Route::get('/delete', function (){
    $staff = Staff::findOrFail(1);
    $staff->photos()->where('id', 2)->delete();
    return "Staff id:1 with his image id:2 => image DELETED";
});

//assign
Route::get('/assign',function (){
    $staff = Staff::findOrFail(1);
    $photo = Photo::findOrFail(3);
    $staff->photos()->save($photo);
    return "Image with ID:3 assigned to userID:1";
});

//unassign
Route::get('/unassign',function (){
    $staff = Staff::findOrFail(1);
    $staff->photos()->where('id', 3)->update([
        'imageable_id'=>'0',
        'imageable_type'=>''
        ]);
    return "Image with ID:3 unassigned from userID:1";
});
