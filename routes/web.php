    <?php

    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\UserController;
    use App\Http\Controllers\CountriesController;

    Route::get('/', function () {
        return view('welcome');
    });

    Route::resource('usuarios', UserController::class);



