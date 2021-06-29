<?php

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\ViewErrorBag;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;

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
    return view('index');
})->name('index');

Route::get('/issues', function () {
    return view('issues');
})->name('issues');

Route::get('/call-for-dev', function () {
    return view('call-for-dev');
})->name('call-for-dev');

Route::post('/issues', function (Request $request) {
    $errors = Validator::make($request->all(), [
        'url'                  => 'required|max:255|url',
        'issue'                => 'required|max:255',
        'date'                 => 'required|date|date_format:Y-m-d',
        'g-recaptcha-response' => 'required|captcha'
    ],
    [],
    [
        'url'                  => 'website link',
        'issue'                => 'issue description',
        'g-recaptcha-response' => 'captcha'
    ])->errors();

    $data = [
        // field validation error bag
        'errors'     => $errors,
        // email has been sent successfully
        'success'    => false,
        // force the modal to stay open
        'modal_open' => true
    ];

    if (count($errors) > 0) {
        // validation errors
        $data['errors'] = $errors;
    } else {
        $text = view('emails.new-issue', [
            'ip'          => $request->getClientIp(),
            'url'         => $request->get('url'),
            'description' => $request->get('issue'),
            'date'        => $request->get('date')
        ]);

        Mail::raw($text, function($message) {
            $message->to('federico.monaco02@gmail.com');
            $message->subject('New issue from ' . url('/'));
        });

        // if email success
        if (!Mail::failures()) {
            return redirect()->back()->with('success', true);

            // $data['success'] = true;
        }
    }

    return view('issues', $data);
})->name('new-issue');
