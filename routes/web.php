<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Dashboard;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\User\BotmanController;
use App\Http\Controllers\Admin\EventsController;
use App\Http\Controllers\Admin\TicketController;
use App\Http\Controllers\User\UserEventController;
use App\Http\Controllers\User\UserProfileController;
use App\Http\Controllers\User\UserTicketsController;
use App\Http\Controllers\Admin\ManageProfileController;
use App\Http\Controllers\Admin\ManageTicketsController;
use App\Http\Controllers\User\ManageUserProfileController;

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

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/', function () {
    return redirect()->route('Auth.Login');
});
Route::get('/Login', [AuthController::class, 'loginPage'])->name('Auth.Login');
Route::post('/Login/CheckUser', [AuthController::class, 'checkLogin'])->name('Auth.LoginCheck');
Route::get('/Register', [AuthController::class, 'registerPage'])->name('Auth.Register');
Route::post('/Register/Submit', [AuthController::class, 'registerUser'])->name('Auth.RegisterSubmit');



Route::middleware(['role'])->group(function () {

    Route::prefix('Admin')->group(function () {

        Route::get('/', [Dashboard::class, 'adminDashBoardPage'])->name('Admin.Dashboard');
        Route::get('/Logout', [AuthController::class, 'logout'])->name('Admin.Logout');

        // Manage Profile
        Route::get('/profile', [ManageProfileController::class, 'profilePage'])->name('Admin.ProfilePage');
        Route::get('/profile/{id}', [ManageProfileController::class, 'profileDetails'])->name('Admin.profileDetails');
        Route::post('/profile/{id}/Update', [ManageProfileController::class, 'updateProfile'])->name('Admin.UpdateProfile');

        // Manage Users
        Route::get('/Manage-Users', [ManageProfileController::class, 'userPage'])->name('Admin.ManageUsers');
        Route::get('/Manage-Users/Details/{id}/Page', [ManageProfileController::class, 'DetailPage'])->name('Admin.DetailPage');
        Route::get('/List-Users', [ManageProfileController::class, 'userList'])->name('Admin.UserList');

        // Manage Events
        Route::get('/Events', [EventsController::class, 'eventPage'])->name('Admin.eventPage');
        Route::get('/Events/Completed', [EventsController::class, 'eventCompletedPage'])->name('Admin.EventCompletedPage');
        Route::get('/List-Events/Page', [EventsController::class, 'eventListPage'])->name('Admin.EventListPage');
        Route::get('/Event-Fatch/{id}/Page', [EventsController::class, 'eventDetailsPage'])->name('Admin.EventDetailsPage');
        Route::get('/Edit-Event/{id}/Page', [EventsController::class, 'updateEventsPage'])->name('Admin.UpdateEventsPage');
        Route::post('/Store-Events', [EventsController::class, 'storeEvent'])->name('Admin.StoreEvent');
        Route::post('/Update-Event/{id}', [EventsController::class, 'updateEvent'])->name('Admin.UpdateEventsDetails');
        Route::patch('/Status-Event/{id}', [EventsController::class, 'statusEvent'])->name('Admin.StatusEvent');
        Route::get('/List-Events', [EventsController::class, 'getAllEvents'])->name('Admin.EventList');
        Route::get('/List-Events/Completed', [EventsController::class, 'getCompletedEvents'])->name('Admin.getCompletedEvents');
        Route::get('/Fatch-Event/{id}', [EventsController::class, 'fatchEvent'])->name('Admin.FatchEvent');


        // Manage States
        Route::get('/List-States', [EventsController::class, 'stateList'])->name('Admin.StateList');
        Route::get('/List-District/{state_id}', [EventsController::class, 'districtList'])->name('Admin.DistrictList');
        Route::get('/List-City/{dist_id}', [EventsController::class, 'citiesList'])->name('Admin.CitiesList');


        // Manage Tickets
        Route::get('/Add-Tickets/{id}/{total_tickets}', [TicketController::class, 'ticketPage'])->name('Admin.TicketPage');
        Route::get('/Tickets/Page', [TicketController::class, 'ticketsListPage'])->name('Admin.TicketsListPage');
        Route::post('/Store-Tickets', [TicketController::class, 'storeTicket'])->name('Admin.StoreTicket');
        Route::get('/tickets-Details/{id}', [TicketController::class, 'getTicketData'])->name('Admin.GetTicketData');
        Route::get('/User-Tickets/{id}', [TicketController::class, 'userTickets'])->name('Admin.UserTickets');
        Route::post('/Save-Seats', [ManageTicketsController::class, 'addTickets'])->name('Admin.addTickets');
    });
});


Route::middleware(['role'])->group(function () {
    Route::prefix('User')->group(function () {
        Route::get('/', [UserProfileController::class, 'userDashBoardPage'])->name('User.Dashboard');
        Route::get('/Logout', [AuthController::class, 'logout'])->name('User.Logout');

        // Manage Profile
        Route::get('/profile', [ManageUserProfileController::class, 'profilePage'])->name('User.ProfilePage');
        Route::get('/profile/{id}', [ManageUserProfileController::class, 'profileDetails'])->name('User.profileDetails');
        Route::post('/profile/{id}/Update', [ManageUserProfileController::class, 'updateProfile'])->name('User.UpdateProfile');

        // Manage Events 

        Route::get('/Events/Page', [UserEventController::class, 'index'])->name('User.Events');
        Route::get('/Fatch-Event/{id}', [UserEventController::class, 'fatchEvent'])->name('User.FatchEvent');
        Route::get('/Events/{status}', [UserEventController::class, 'getAllEvents'])->name('User.GetAllEvents');
        Route::get('/Event-Details/{id}', [UserEventController::class, 'ManageEventDetailssPage'])->name('User.ManageEventDetailssPage');


        // Ticket Booking Events
        Route::get('/Tickets/Page/{id}', [UserTicketsController::class, 'index'])->name('User.Tickets');
        Route::get('/Tickets/List/{id}', [UserTicketsController::class, 'ticketList'])->name('User.TicketList');
        Route::post('ConfirmBooking/Ticket', [UserTicketsController::class, 'confirmBooking'])->name('User.ConfirmBooking');
        Route::get('/Tickets/History/Page', [UserTicketsController::class, 'ticketHistory'])->name('User.TicketHistory');
        Route::get('/Tickets/History/{id}', [UserTicketsController::class, 'userTickets'])->name('User.UserTicketHistory');
        Route::get('/AiBooking', [BotmanController::class, 'index'])->name('User.BotmanBooking');
        Route::match(['get', 'post'], '/botman', [BotmanController::class, 'handle'])
            ->middleware('web') 
            ->name('botman.handle');
    });
});
