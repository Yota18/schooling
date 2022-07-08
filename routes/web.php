<?php

use App\Models\News;
use App\Models\User;
use App\Mail\OtpMail;
use App\Models\Major;
use App\Models\Staff;
use App\Mail\CobaMail;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Position;
use App\Models\NewsCategory;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Controllers\AccessKeyController;
use App\Http\Controllers\Master\NewsController;
use App\Http\Controllers\Master\AdminController;
use App\Http\Controllers\Master\StaffController;
use App\Http\Controllers\Akademik\MajorController;
use App\Http\Controllers\Master\StudentController;
use App\Http\Controllers\Master\TeacherController;
use App\Http\Controllers\Master\PositionController;
use App\Http\Controllers\Akademik\ClassesController;
use App\Http\Controllers\Akademik\SubjectController;
use App\Http\Controllers\Akademik\SchoolYearController;
use App\Http\Controllers\Master\NewsCategoryController;
use App\Http\Controllers\Master\SchoolProfileController;
use App\Http\Controllers\Akademik\SettingClassController;
use App\Http\Controllers\Akademik\ClassPromotionController;
use App\Http\Controllers\Akademik\CategorySubjectController;
use App\Http\Controllers\Akademik\AdminController as AkademikAdmin;
use App\Http\Controllers\Akademik\StudentController as AkademikStudent;
use App\Http\Controllers\Akademik\TeacherController as AkademikTeacher;
use App\Http\Controllers\Akademik\AlumniController as AkademikAlumni;

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

Route::get('/produk', function () {
    return view('pages.produk');
})->name('product');


Route::get('/', function () {
    return redirect()->route('master.dashboard');
});

// Route::get('/coba', function () {
//     return view('auth.verify');
// });

// must login
Route::middleware(['auth'])->group(function () {
    Route::middleware(['verified'])->group(function () {
        Route::prefix('master')->group(function () {
            Route::name('master.')->group(function () {
                Route::get('/', function () {
                    return view('index');
                })->name('dashboard');
                Route::get('/coba', function () {
                    return view('API.edit');
                });

                Route::group(['prefix' => 'access_key', 'controller' => AccessKeyController::class], function () {
                    Route::name('accesskey.')->group(function () {
                        Route::get('', 'index')->name('index');
                        Route::post('', 'store')->name('store');
                        Route::get('/add', 'create')->name('add');
                        Route::put('/{apiUser}', 'update')->name('update');
                        Route::get('/detail/{apiUser}', 'show')->name('detail');
                        Route::get('/edit/{apiUser}', 'edit')->name('edit');
                        Route::delete('/{apiUser}', 'destroy')->name('delete');
                    });
                });
                Route::group(['prefix' => 'jabatan', 'controller' => PositionController::class], function () {
                    Route::name('jabatan.')->group(function () {
                        Route::get('', 'index')->name('index');
                        Route::post('', 'store')->name('store');
                        Route::get('/add', 'create')->name('add');
                        Route::put('/{position}', 'update')->name('update');
                        Route::get('/detail/{position}', 'show')->name('detail');
                        Route::get('/edit/{position}', 'edit')->name('edit');
                        Route::delete('/{position}', 'destroy')->name('delete');
                        Route::post('/data', function () {
                            return DataTables::of(Position::orderBy('id', 'ASC')->get())->make(true);
                        })->name('data');
                    });
                });
                Route::prefix('user')->group(function () {
                    Route::group(['prefix' => '/admin', 'controller' => AdminController::class], function () {
                        Route::name('users.admin.')->group(function () {
                            Route::get('', 'index')->name('index');
                            Route::post('', 'store')->name('store');
                            Route::get('/add', 'create')->name('add');
                            Route::put('/{user}', 'update')->name('update');
                            Route::get('/detail/{admin}', 'show')->name('detail');
                            Route::get('/edit/{user}', 'edit')->name('edit');
                            Route::delete('/{user}', 'destroy')->name('delete');
                            Route::post('/switch', 'switch')->name('switch');
                            Route::post('/data', function () {
                                return DataTables::of(User::latest()->get()->load('position'))->make(true);
                            })->name('data');
                        });
                    });
                    Route::group(['prefix' => '/guru', 'controller' => TeacherController::class], function () {
                        Route::name('users.teacher.')->group(function () {
                            Route::get('', 'index')->name('index');
                            Route::post('', 'store')->name('store');
                            Route::get('/add', 'create')->name('add');
                            Route::get('/edit/{teacher}', 'edit')->name('edit');
                            Route::put('/{teacher}', 'update')->name('update');
                            // Route::get('/detail/{teacher}', 'show')->name('detail');
                            // Route::delete('/{teacher}', 'destroy')->name('delete');
                            Route::post('/switch', 'switch')->name('switch');
                            Route::post('/data', function () {
                                return DataTables::of(Teacher::latest()->get()->load('user', 'user.position'))->make(true);
                            })->name('data');
                        });
                    });
                    Route::group(['prefix' => '/siswa', 'controller' => StudentController::class], function () {
                        Route::name('users.student.')->group(function () {
                            Route::get('', 'index')->name('index');
                            Route::post('', 'store')->name('store');
                            Route::get('/add', 'create')->name('add');
                            Route::put('/{student}', 'update')->name('update');
                            Route::get('/detail/{student}', 'show')->name('detail');
                            Route::get('/edit/{student}', 'edit')->name('edit');
                            // Route::delete('/{student}', 'destroy')->name('delete');
                            Route::post('/switch', 'switch')->name('switch');
                            Route::post('/data', 'data')->name('data');
                        });
                    });
                    Route::group(['prefix' => '/staff', 'controller' => StaffController::class], function () {
                        Route::name('users.staff.')->group(function () {
                            Route::get('', 'index')->name('index');
                            Route::post('', 'store')->name('store');
                            Route::get('/add', 'create')->name('add');
                            Route::put('/{staff}', 'update')->name('update');
                            // Route::get('/detail/{staff}', 'show')->name('detail');
                            Route::get('/edit/{staff}', 'edit')->name('edit');
                            // Route::delete('/{staff}', 'destroy')->name('delete');
                            Route::post('/switch', 'switch')->name('switch');
                            Route::post('/data', function () {
                                // return Staff::latest()->get()->load('user', 'user.position');
                                return DataTables::of(Staff::latest()->get()->load('user', 'user.position'))->make(true);
                            })->name('data');
                        });
                    });
                    Route::group(['prefix' => '/alumni', 'controller' => AkademikAlumni::class], function () {
                        Route::name('users.alumni.')->group(function () {
                            Route::get('', 'index')->name('index');
                            Route::get('/edit/{student}', 'edit')->name('edit');
                            Route::put('/{student}', 'update')->name('update');
                            Route::post('/switch', 'switch')->name('switch');
                            Route::post('/data', 'data')->name('data');
                            // Route::post('', 'store')->name('store');
                            // Route::get('/add', 'create')->name('add');
                            // Route::delete('/{student}', 'destroy')->name('delete');
                            // Route::get('/detail/{student}', 'show')->name('detail');
                        });
                    });
                    //ppdb
                    Route::group(['prefix' => '/ppdb', 'controller' => PPDBController::class], function () {
                        Route::name('users.ppdb')->group(function () {
                            Route::get('', 'index')->name('index');
                            Route::post('', 'store')->name('store');
                            Route::get('/add', 'create')->name('add');
                            Route::put('/{ppdb}', 'update')->name('update');
                            Route::get('/detail/{ppdb}', 'show')->name('detail');
                            Route::get('/edit/{ppdb}', 'edit')->name('edit');
                            // Route::delete('/{ppdb}', 'destroy')->name('delete');
                            Route::post('/switch', 'switch')->name('switch');
                            Route::post('/data', 'data')->name('data');
                        });
                    });
                    //payment
                    Route::group(['prefix' => '/ppdb_payment', 'controller' => PPDBController::class], function () {
                        Route::name('users.payment')->group(function () {
                            Route::get('', 'index')->name('index');
                            Route::post('', 'store')->name('store');
                            Route::get('/add', 'create')->name('add');
                            Route::put('/{ppdb_payment}', 'update')->name('update');
                            Route::get('/detail/{ppdb_payment}', 'show')->name('detail');
                            Route::get('/edit/{ppdb_payment}', 'edit')->name('edit');
                            // Route::delete('/{ppdb}', 'destroy')->name('delete');
                            Route::post('/switch', 'switch')->name('switch');
                            Route::post('/data', 'data')->name('data');
                        });
                    });
                });
                Route::group(['prefix' => 'school-profile', 'controller' => SchoolProfileController::class], function () {
                    Route::name('school.profile.')->group(function () {
                        Route::get('', 'edit')->name('index');
                        Route::put('', 'update')->name('update');
                    });
                });
                Route::prefix('berita')->group(function () {
                    Route::name('news.')->group(function () {
                        //news category
                        Route::group(['prefix' => 'kategori', 'controller' => NewsCategoryController::class], function () {
                            Route::name('category.')->group(function () {
                                Route::get('', 'index')->name('index');
                                Route::post('', 'store')->name('store');
                                Route::get('/add', 'create')->name('add');
                                Route::post('/data', function () {
                                    return DataTables::of(NewsCategory::all())->make(true);
                                })->name('data');
                                Route::get('/edit/{NewsCategory}', 'edit')->name('edit');
                                Route::put('/edit/{NewsCategory}', 'update')->name('update');
                                Route::delete('/{NewsCategory}', 'destroy')->name('delete');
                            });
                        });

                        //news
                        Route::group(['controller' => NewsController::class], function () {
                            Route::get('', 'index')->name('index');
                            Route::post('', 'store')->name('store');
                            Route::get('/add', 'create')->name('add');
                            Route::post('/data', function () {
                                return DataTables::of(News::latest()->get())->make(true);
                            })->name('data');
                            Route::get('/edit/{news}', 'edit')->name('edit');
                            Route::put('/edit/{news}', 'update')->name('update');
                            Route::delete('/{news}', 'destroy')->name('delete');
                        });
                    });
                });
            });
        });
        Route::prefix('akademik')->group(function () {
            Route::name('akademik.')->group(function () {
                Route::get('/', function () {
                    return view('index');
                })->name('dashboard');

                Route::prefix('user')->group(function () {
                    Route::group(['prefix' => '/admin', 'controller' => AkademikAdmin::class], function () {
                        Route::name('users.admin.')->group(function () {
                            Route::get('', 'index')->name('index');
                            Route::post('', 'store')->name('store');
                            Route::get('/add', 'create')->name('add');
                            Route::put('/{user}', 'update')->name('update');
                            Route::get('/detail/{admin}', 'show')->name('detail');
                            Route::get('/edit/{user}', 'edit')->name('edit');
                            Route::delete('/{user}', 'destroy')->name('delete');
                            Route::post('/switch', 'switch')->name('switch');
                            Route::post('/data', function () {
                                return DataTables::of(User::where(['position_id' => '3'])->orWhere('position_id', '4')->get()->load('position'))->make(true);
                            })->name('data');
                        });
                    });
                    Route::group(['prefix' => '/guru', 'controller' => AkademikTeacher::class], function () {
                        Route::name('users.teacher.')->group(function () {
                            Route::get('', 'index')->name('index');
                            Route::post('', 'store')->name('store');
                            Route::get('/add', 'create')->name('add');
                            Route::get('/edit/{teacher}', 'edit')->name('edit');
                            Route::put('/{teacher}', 'update')->name('update');
                            // Route::get('/detail/{teacher}', 'show')->name('detail');
                            // Route::delete('/{teacher}', 'destroy')->name('delete');
                            Route::post('/switch', 'switch')->name('switch');
                            Route::post('/data', function () {
                                return DataTables::of(Teacher::latest()->get()->load('user', 'user.position'))->make(true);
                            })->name('data');
                        });
                    });
                    Route::group(['prefix' => '/siswa', 'controller' => AkademikStudent::class], function () {
                        Route::name('users.student.')->group(function () {
                            Route::get('', 'index')->name('index');
                            Route::post('', 'store')->name('store');
                            Route::get('/add', 'create')->name('add');
                            Route::put('/{student}', 'update')->name('update');
                            Route::get('/detail/{student}', 'show')->name('detail');
                            Route::get('/edit/{student}', 'edit')->name('edit');
                            // Route::delete('/{student}', 'destroy')->name('delete');
                            Route::post('/switch', 'switch')->name('switch');
                            Route::post('/data', 'data')->name('data');
                        });
                    });
                    // route orang tua
                    Route::group(['prefix' => '/parents', 'controller' => StudentParents::class], function () {
                        Route::name('users.parents.')->group(function () {
                            Route::get('', 'index')->name('index');
                            Route::post('', 'store')->name('store');
                            Route::get('/add', 'create')->name('add');
                            Route::put('/{parents}', 'update')->name('update');
                            Route::get('/detail/{parents}', 'show')->name('detail');
                            Route::get('/edit/{parents}', 'edit')->name('edit');
                            // Route::delete('/{student}', 'destroy')->name('delete');
                            Route::post('/switch', 'switch')->name('switch');
                            Route::post('/data', 'data')->name('data');
                        });
                    });
                    Route::group(['prefix' => '/alumni', 'controller' => AkademikAlumni::class], function () {
                        Route::name('users.alumni.')->group(function () {
                            Route::get('', 'index')->name('index');
                            Route::get('/edit/{student}', 'edit')->name('edit');
                            Route::put('/{student}', 'update')->name('update');
                            Route::post('/switch', 'switch')->name('switch');
                            Route::post('/data', 'data')->name('data');
                            // Route::post('', 'store')->name('store');
                            // Route::get('/add', 'create')->name('add');
                            // Route::delete('/{student}', 'destroy')->name('delete');
                            // Route::get('/detail/{student}', 'show')->name('detail');
                        });
                    });
                });
                Route::group(['prefix' => 'jurusan', 'controller' => MajorController::class], function () {
                    Route::name('major.')->group(function () {
                        Route::get('', 'index')->name('index');
                        Route::post('', 'store')->name('store');
                        Route::get('/add', 'create')->name('add');
                        Route::put('/{major}', 'update')->name('update');
                        // Route::get('/detail/{major}', 'show')->name('detail');
                        Route::get('/edit/{major}', 'edit')->name('edit');
                        Route::delete('/{major}', 'destroy')->name('delete');
                        Route::post('/switch', 'switch')->name('switch');
                        Route::post('/data', 'data')->name('data');
                    });
                });
                Route::group(['prefix' => 'kelas', 'controller' => ClassesController::class], function () {
                    Route::name('classes.')->group(function () {
                        Route::get('', 'index')->name('index');
                        Route::post('', 'store')->name('store');
                        Route::get('/add', 'create')->name('add');
                        Route::put('/{classes}', 'update')->name('update');
                        // Route::get('/detail/{classes}', 'show')->name('detail');
                        Route::get('/edit/{classes}', 'edit')->name('edit');
                        Route::delete('/{classes}', 'destroy')->name('delete');
                        Route::post('/switch', 'switch')->name('switch');
                        Route::post('/data', 'data')->name('data');
                    });
                });

                Route::group(['prefix' => 'tahun-ajaran', 'controller' => SchoolYearController::class], function () {
                    Route::name('school.year.')->group(function () {
                        Route::get('', 'index')->name('index');
                        Route::post('', 'store')->name('store');
                        Route::get('/add', 'create')->name('add');
                        Route::put('/{schoolYear}', 'update')->name('update');
                        // Route::get('/detail/{schoolYear}', 'show')->name('detail');
                        Route::get('/edit/{schoolYear}', 'edit')->name('edit');
                        Route::delete('/{schoolYear}', 'destroy')->name('delete');
                        Route::post('/switch', 'switch')->name('switch');
                        Route::post('/data', 'data')->name('data');
                    });
                });
                Route::group(['prefix' => 'mapel/kategori', 'controller' => CategorySubjectController::class], function () {
                    Route::name('mapel.category.')->group(function () {
                        Route::get('', 'index')->name('index');
                        Route::post('', 'store')->name('store');
                        Route::get('/add', 'create')->name('add');
                        Route::put('/{categorySubject}', 'update')->name('update');
                        // Route::get('/detail/{categorySubject}', 'show')->name('detail');
                        Route::get('/edit/{categorySubject}', 'edit')->name('edit');
                        Route::delete('/{categorySubject}', 'destroy')->name('delete');
                        Route::post('/switch', 'switch')->name('switch');
                        Route::post('/data', 'data')->name('data');
                    });
                });
                Route::group(['prefix' => 'mapel', 'controller' => SubjectController::class], function () {
                    Route::name('mapel.')->group(function () {
                        Route::get('', 'index')->name('index');
                        Route::post('', 'store')->name('store');
                        Route::get('/add', 'create')->name('add');
                        Route::put('/{subject}', 'update')->name('update');
                        // Route::get('/detail/{subject}', 'show')->name('detail');
                        Route::get('/edit/{subject}', 'edit')->name('edit');
                        Route::delete('/{subject}', 'destroy')->name('delete');
                        Route::post('/switch', 'switch')->name('switch');
                        Route::post('/data', 'data')->name('data');
                    });
                });

                Route::group(['prefix' => 'setting/kelas', 'controller' => SettingClassController::class], function () {
                    Route::name('setting.class.')->group(function () {
                        Route::get('', 'class')->name('class');
                        Route::get('/{class:code}', 'index')->name('index');
                        Route::get('/{class:code}/add', 'create')->name('add');
                        Route::post('/{class:code}/add', 'store')->name('store');
                        // Route::get('/detail/{id}', 'show')->name('detail');
                        Route::get('/{class:code}/edit/{settingClass}', 'edit')->name('edit');
                        Route::put('/{class:code}/edit/{settingClass}', 'update')->name('update');
                        Route::put('/{class:code}/wali', 'update_homeroom')->name('update.homeroom');
                        Route::delete('/{class:code}/{settingClass}', 'destroy')->name('delete');
                        Route::post('/{class:code}/data', 'data')->name('data');
                    });
                });
                Route::group(['prefix' => 'pindah-kelas', 'controller' => ClassPromotionController::class], function () {
                    Route::name('pindah.class.')->group(function () {
                        Route::get('', 'class')->name('class');
                        Route::get('/{class:code}', 'index')->name('index');
                        Route::get('/{class:code}/add', 'create')->name('add');
                        Route::post('/{class:code}/pindah', 'store')->name('store');
                        // Route::get('/detail/{id}', 'show')->name('detail');
                        Route::get('/{class:code}/edit/{settingClass}', 'edit')->name('edit');
                        Route::put('/{class:code}/edit/{settingClass}', 'update')->name('update');
                        Route::put('/{class:code}/wali', 'update_homeroom')->name('update.homeroom');
                        Route::delete('/{class:code}/{settingClass}', 'destroy')->name('delete');
                        Route::post('/{class:code}/data', 'data')->name('data');
                    });
                });
            });
        });
    });
});







// Route::get('/review-product', function () {
//     return view('pages.review');
// })->name('review-product');

Route::get('/table', function () {
    return view('pages.table');
})->name('table');

Route::get('/form', function () {
    return view('pages.form');
})->name('form');

// Route::get('/orders', function () {
//     return view('pages.orders');
// })->name('orders');