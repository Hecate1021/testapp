<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\Resort\MenuController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Resort\CategoryController;
use App\Http\Controllers\resort\dashboard;
use App\Http\Controllers\Resort\EventController;
use App\Http\Controllers\Resort\ImageController;
use App\Http\Controllers\Resort\ResortController;
use App\Http\Controllers\Resort\ReviewController as ResortReviewController;
use App\Http\Controllers\Resort\RoomController;
use App\Http\Controllers\Resort\SubcategoryController;
use App\Http\Controllers\Resort\UploadTemporaryImageController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\User\BookingController;
use App\Http\Controllers\User\UserController;

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [UserController::class, 'index']);
Route::get('/accomodation', [UserController::class, 'accomodation']);

Route::get('/dashboard', [ChatController::class, 'dashboard'])->middleware(['auth', 'verified', 'PreventBackHistory'])->name('dashboard');
Route::get('/chat/{id}', [ChatController::class, 'chat'])->middleware(['auth', 'verified'])->name('chat');
Route::get('/chatlist', [ChatController::class, 'chatlist'])->middleware(['auth', 'verified'])->name('chatlist');
Route::post('/chat/{id}/mark-as-read', [ChatController::class, 'markAsRead'])->name('chatCount');


Route::middleware(['auth', 'PreventBackHistory'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    //room book
    Route::get('/resort/room/book/{id}', [BookingController::class, 'booking'])->name('room.book');
    Route::post('/store/booking', [BookingController::class, 'store'])->name('booking.store');
    Route::get('/mybooking', [BookingController::class, 'mybooking'])->name('user.mybooking');
    Route::post('/booking/cancel/{id}', [BookingController::class, 'bookingCancel'])->name('booking.cancel');

    Route::post('/reviews/store/{room}', [ReviewController::class, 'store'])->name('reviews.store');
    Route::get('/resort/profile/{name}', [UserController::class, 'resort'])->name('resort.profiles');
    Route::get('resort/room/{name}', [UserController::class, 'resortRoom'])->name('resort.Room');
});

require __DIR__ . '/auth.php';


/**------------Admin----------------- */
Route::middleware(['auth', 'role:admin', 'PreventBackHistory'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
});

/**------------Resort----------------- */
Route::middleware(['guest', 'PreventBackHistory'])->group(function () {

    Route::get('resort/register', [ResortController::class, 'create'])->name('resort.register');
    Route::post('register', [ResortController::class, 'store'])->name('resort.store');
});
Route::middleware(['auth', 'role:resort', 'PreventBackHistory'])->group(function () {

    Route::get('/resort/profile', [ResortController::class, 'profile'])->name('resort.profile');
    //dashboard
    Route::get('/resort/dashboard', [dashboard::class, 'dashboard'])->name('resort.dashboard');
    //ROOM
    Route::get('/resort/room', [RoomController::class, 'room'])->name('resort.room');

    Route::get('resort/add-room', [RoomController::class, 'create'])->name('room.create');
    Route::post('resort/store', [RoomController::class, 'store'])->name('room.store');
    Route::put('resort/update/{room}', [RoomController::class, 'update'])->name('room.update');
    Route::delete('resort/delete/{room}', [RoomController::class, 'destroy'])->name('room.delete');
    Route::get('resort/roomEdit/{id}', [RoomController::class, 'edit'])->name('room.edit');
    Route::post('/update-room-status', [RoomController::class, 'updateStatus']);
    Route::get('/registration/{id}', [RoomController::class, 'registration'])->name('registration');
    // Route::put('resort/room/{id}/update', [RoomController::class, 'update'])->name('room.update');
    Route::delete('/room/image/{id}', [ImageController::class, 'destroy'])->name('image.destroy');
    Route::delete('/rooms/{room}', [RoomController::class, 'destroy'])->name('room.destroy');

    //booking

    Route::get('/resort/booking', [ResortController::class, 'booking'])->name('resort.booking');
    Route::get('/resort/bookings/{booking}', [ResortController::class, 'bookingShow'])->name('bookings.show');
    Route::get('/bookings/{booking}/checkout', [BookingController::class, 'check_outView'])->name('bookings.checkout');
    Route::patch('/bookings/{booking}/checkout', [BookingController::class, 'check_out'])->name('bookings.checkOut');
    Route::patch('/bookings/{booking}/status', [BookingController::class, 'updateBooking'])->name('bookings.updateBooking');
    Route::patch('/booking/accept/{id}', [BookingController::class, 'bookingAccept'])->name('booking.accept');

    Route::get('/resort/add/bookings', [ResortController::class, 'addbooking'])->name('addbooking');
    Route::post('bookings', [BookingController::class, 'bookingstore'])->name('addbooking.store');
    Route::post('bookings/cancel/{id}', [BookingController::class, 'cancelBooking'])->name('cancelBooking');
    //calendar
    Route::get('/bookings/calendar', [BookingController::class, 'calendar'])->name('bookings.calendar');
    Route::get('/bookings/events', [BookingController::class, 'getEvents'])->name('bookings.events');

    //post
    Route::post('resort/post', [PostController::class, 'post'])->name('resort.post');
    Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');

    //event
    Route::get('/event', [EventController::class, 'event'])->name('resort.event');
    Route::post('/events', [EventController::class, 'store'])->name('events.store');
    Route::delete('/event-images/{id}', [EventController::class, 'destroyImages'])->name('event.image.destroy');
    Route::put('/events/{id}', [EventController::class, 'update'])->name('events.update');
    Route::delete('/events/{id}', [EventController::class, 'destroy'])->name('events.destroy');

    //image event delete
    Route::delete('/image/{id}', [EventController::class, 'imagedestroy'])->name('image-event.destroy');
  //image menu delete
  Route::delete('/menu/image/{id}', [MenuController::class, 'imagedestroy'])->name('image-menu.destroy');
    // menus
    Route::get('/menus', [MenuController::class, 'index'])->name('resort.menus');
    Route::post('/menu', [MenuController::class, 'store'])->name('menus.store');
    Route::put('/menu/{id}', [MenuController::class, 'update'])->name('menus.update');
    Route::delete('/menu/{id}', [MenuController::class, 'destroy'])->name('menu.destroy');

    Route::get('categories/{category}/subcategories', function ($category) {
        $subcategories = \App\Models\Subcategory::where('category_id', $category)->get();
        return response()->json(['subcategories' => $subcategories]);
    });

    //category
    Route::get('/category', [CategoryController::class, 'index'])->name('resort.category');
    Route::post('/categories/store', [CategoryController::class, 'store'])->name('categories.store');
    Route::put('/{category}', [CategoryController::class, 'update'])->name('categories.update'); // Update a category
    Route::delete('/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy'); // Delete a category

    //subcategory
    Route::post('/subcategories', [SubcategoryController::class, 'store'])->name('subcategories.store');
    Route::put('/categpry/{subcategory}', [SubcategoryController::class, 'update'])->name('subcategories.update'); // Update a subcategory
    Route::delete('/category/{subcategory}', [SubcategoryController::class, 'destroy'])->name('subcategories.destroy'); // Delete a subcategory

    //review
    Route::get('/review', [ResortReviewController::class, 'index'])->name('resort.review');

});

//IMAGE FilePond
Route::post('/upload', [UploadTemporaryImageController::class, 'uploadTempImage']);
Route::delete('/delete', [UploadTemporaryImageController::class, 'deleteTempImage']);

//Profile and Cover photo update
Route::patch('/resort/changeProfile', [ProfileController::class, 'profilePhoto'])->name('profilePhoto');
Route::patch('/resort/changeCoverPhoto', [ProfileController::class, 'coverPhoto'])->name('coverPhoto');
