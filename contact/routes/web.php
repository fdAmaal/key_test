<?php
use App\Contact;
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
    return view('contact');
});

Route::resource('contact','ContactController');


Route::any('contact/search',function(){
    $search = Input::get ( 'search' );
    $contact = Post::where('name','LIKE','%'.$search.'%')
                        ->orWhere ( 'email', 'LIKE', '%' . $search . '%' )
                        ->orWhere ( 'phone', 'LIKE', '%' . $search . '%' )
                        ->paginate(9);
    $contact = Contact::get();
    if(count($contact) > 0)
        return view('searchContact')->withDetails($contact)->withQuery ( $search );
    else return view ('searchContact')->withMessage('No Details found. Try to search again !');
});

Route::get('admin','ContactController@index');

