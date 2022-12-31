<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\OrganizerEventController;
use App\Http\Controllers\UserHomeController;
use App\Http\Controllers\ShowEventsController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\EventStaffController;
use App\Http\Controllers\EventExpensesController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\PollingController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\DashboardController;

use App\Http\Controllers\SoldTicketController;
use App\Http\Controllers\SmsNotificationController;
use App\Http\Controllers\EmailNotificationController;
use App\Http\Controllers\TableController;
use App\Http\Controllers\TableBookingController;
use App\Http\Controllers\BookedController;

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

// Route::get('/', function () {
//     return view('user.home');
// });

Route::get('/user/user-register', [AuthController::class, 'viewUserRegister'])->name('view.user-register')->middleware('isLoggedIn');
Route::post('/user/user-register', [AuthController::class, 'userRegister'])->name('user-register')->middleware('isLoggedIn');
Route::get('/admin/admin-register', [AuthController::class, 'viewAdminRegister'])->name('view.admin-register')->middleware('isLoggedIn');
Route::post('/admin/admin-register', [AuthController::class, 'adminRegister'])->name('admin-register')->middleware('isLoggedIn');

Route::get('/user/login', [AuthController::class, 'viewLogin'])->name('view.login')->middleware('isLoggedIn');
Route::post('/user/login', [AuthController::class, 'login'])->name('login');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

//users route
Route::get('/', [UserHomeController::class, 'home'])->name('home');
Route::get('/user/event-detail/{id}', [ShowEventsController::class, 'eventDetail'])->name('view.event-detail');
// Route::get('/user/back', [ShowEventsController::class, 'goBack'])->name('back');
Route::get('/user/show-location/{id}', [ShowEventsController::class, 'showLocation'])->name('show-location');

//purchase
Route::get('/user/buy-ticket/{id}', [TicketController::class, 'buyTicket'])->name('buy-ticket');
Route::post('/user/purchase-details/{id}', [TicketController::class, 'purchaseDetail'])->name('purchase-detail');
Route::post('/user/payment/verify', [TicketController::class, 'verifyPayment'])->name('verifyPayment');
Route::post('/user/payment/store', [TicketController::class, 'storePayment'])->name('storePayment');

//table booking
Route::get('/user/tables/{id}', [TableBookingController::class, 'index'])->name('show-tables');
Route::get('/user/tables/user-detail/{id}', [TableBookingController::class, 'proceed'])->name('table-booking-detail');
Route::get('/user/tables/book/{id}', [TableBookingController::class, 'book'])->name('book-table');

//polling
Route::post('/user/save-poll', [PollingController::class, 'create'])->name('save-poll');

//show More events
Route::get('/user/upcoming-event', [ShowEventsController::class, 'showUpcomingEvent'])->name('view.upcoming-event');
Route::get('/user/this-month-event', [ShowEventsController::class, 'showThisMonth'])->name('view.this-month-event');
Route::get('/user/all-events', [ShowEventsController::class, 'showAll'])->name('view.all-events');
Route::get('/user/today-events', [ShowEventsController::class, 'showToday'])->name('view.today-events');
Route::get('/user/tomorrow-events', [ShowEventsController::class, 'showTomorrow'])->name('view.tomorrow-events');
Route::get('/user/concert-event', [ShowEventsController::class, 'showConcert'])->name('view.concert-event');
Route::get('/user/aud-event', [ShowEventsController::class, 'showAud'])->name('view.aud-event');
Route::get('/user/hotel-event', [ShowEventsController::class, 'showHotel'])->name('view.hotel-event');
Route::get('/user/free-event', [ShowEventsController::class, 'showFree'])->name('view.free-event');
Route::get('/user/top-event', [ShowEventsController::class, 'showTopEvent'])->name('view.top-event');

Route::post('/user/event-by-location', [ShowEventsController::class, 'showByLocation'])->name('view.by-location');

//booked event/table
Route::get('/user/my-booked-list', [BookedController::class, 'show'])->name('view.booked-list');

// Rating
Route::post('/user/rating', [RatingController::class, 'rating'])->name('store.rating');


//admin routes
//home
Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard')->middleware('checkLoggedIn');

//staff
Route::get('/admin/staff/index', [StaffController::class, 'index'])->name('admin.show-staff')->middleware('checkLoggedIn');
Route::get('/admin/staff/add', [StaffController::class, 'create'])->name('admin.add-staff')->middleware('checkLoggedIn');
Route::post('/admin/staff/store', [StaffController::class, 'store'])->name('admin.store-staff')->middleware('checkLoggedIn');
Route::get('/admin/staff/edit/{id}', [StaffController::class, 'edit'])->name('admin.edit-staff')->middleware('checkLoggedIn');
Route::post('/admin/staff/update/{id}', [StaffController::class, 'update'])->name('admin.update-staff')->middleware('checkLoggedIn');
Route::get('/admin/staff/delete/{id}', [StaffController::class, 'destroy'])->name('admin.delete-staff')->middleware('checkLoggedIn');

//add event
Route::get('/admin/add-event-option', function () {
    return view('admin.event/choose');
})->middleware('checkLoggedIn');
Route::get('/admin/add-concert-event', [EventController::class, 'viewConcert'])->name('admin.view-concert')->middleware('checkLoggedIn');
Route::get('/admin/add-aud-event', [EventController::class, 'viewAud'])->name('admin.view-aud')->middleware('checkLoggedIn');
Route::get('/admin/add-hotel-event', [EventController::class, 'viewHotel'])->name('admin.view-hotel')->middleware('checkLoggedIn');

Route::post('/admin/store-concert-event', [EventController::class, 'storeConcert'])->name('admin.store-concert')->middleware('checkLoggedIn');
Route::post('/admin/store-aud-event', [EventController::class, 'storeAud'])->name('admin.store-aud')->middleware('checkLoggedIn');
Route::post('/admin/store-hotel-event', [EventController::class, 'storeHotel'])->name('admin.store-hotel')->middleware('checkLoggedIn');

Route::get('/admin/event/edit/{id}', [EventController::class, 'viewEventEdit'])->name('admin.edit-event')->middleware('checkLoggedIn');
Route::post('/admin/event/update/{id}', [EventController::class, 'updateEvent'])->name('admin.update-event')->middleware('checkLoggedIn');

//my event
Route::get('/admin/my-event', [OrganizerEventController::class, 'viewMyEvents'])->name('admin.view-my-event')->middleware('checkLoggedIn');
Route::get('/admin/my-event-detail/{id}', [OrganizerEventController::class, 'viewMyEventDetail'])->name('admin.view-my-event-detail')->middleware('checkLoggedIn');

//TABLE
//add table
Route::get('/admin/add/table/{id}', [TableController::class, 'index'])->name('admin.add-table')->middleware('checkLoggedIn');
Route::post('/admin/store/table/{id}', [TableController::class, 'store'])->name('admin.store-table')->middleware('checkLoggedIn');
//edit table
Route::get('/admin/edit/table/{id}', [TableController::class, 'edit'])->name('admin.edit-table')->middleware('checkLoggedIn');
Route::post('/admin/update/table/{id}', [TableController::class, 'update'])->name('admin.update-table')->middleware('checkLoggedIn');
// delete table
Route::get('/admin/delete/table/{id}', [TableController::class, 'delete'])->name('admin.delete-table')->middleware('checkLoggedIn');

//table booked list
Route::get('/admin/booking/table/{id}', [TableController::class, 'showBookedTable'])->name('admin.view-table-booking')->middleware('checkLoggedIn');

//ticket
Route::get('/admin/choose-event/sold/ticket', [SoldTicketController::class, 'index'])->name('admin.choose-event')->middleware('checkLoggedIn');
Route::post('/admin/view/sold/ticket', [SoldTicketController::class, 'show'])->name('admin.view-sold-ticket')->middleware('checkLoggedIn');

//manage
Route::get('/admin/manage/index', [EventController::class, 'index'])->name('admin.manage-index')->middleware('checkLoggedIn');
//staff
Route::get('/admin/manage/allocate-staff/{id}', [EventStaffController::class, 'index'])->name('admin.staff-view')->middleware('checkLoggedIn');
Route::post('/admin/manage/store/allocate-staff/{id}', [EventStaffController::class, 'store'])->name('admin.staff-allocate')->middleware('checkLoggedIn');
Route::get('/admin/manage/edit/allocate-staff/{id}', [EventStaffController::class, 'edit'])->name('admin.allocate-staff-edit')->middleware('checkLoggedIn');
Route::post('/admin/manage/update/allocate-staff/{id}', [EventStaffController::class, 'update'])->name('admin.allocate-staff-update')->middleware('checkLoggedIn');
Route::get('/admin/manage/delete/delete-staff/{id}', [EventStaffController::class, 'destroy'])->name('admin.allocate-staff-delete')->middleware('checkLoggedIn');

//expenses
Route::get('/admin/manage/allocate-expenses/{id}', [EventExpensesController::class, 'index'])->name('admin.expenses-view')->middleware('checkLoggedIn');
Route::post('/admin/manage/store/allocate-expenses/{id}', [EventExpensesController::class, 'store'])->name('admin.expenses-allocate')->middleware('checkLoggedIn');
Route::get('/admin/manage/edit/allocate-expenses/{id}', [EventExpensesController::class, 'edit'])->name('admin.allocate-expenses-edit')->middleware('checkLoggedIn');
Route::post('/admin/manage/update/allocate-expenses/{id}', [EventExpensesController::class, 'update'])->name('admin.allocate-expenses-update')->middleware('checkLoggedIn');
Route::get('/admin/manage/delete/delete-expenses/{id}', [EventExpensesController::class, 'destroy'])->name('admin.allocate-expenses-delete')->middleware('checkLoggedIn');


//report
Route::get('/admin/manage/report/{id}', [ReportController::class, 'index'])->name('admin.report-view')->middleware('checkLoggedIn');
Route::get('/admin/manage/overall-report/{id}', [ReportController::class, 'indexOverall'])->name('admin.overall-report-view')->middleware('checkLoggedIn');
Route::get('/admin/manage/staff-report/{id}', [ReportController::class, 'indexStaff'])->name('admin.staff-report-view')->middleware('checkLoggedIn');
Route::get('/admin/manage/expenses-report/{id}', [ReportController::class, 'indexExpenses'])->name('admin.expenses-report-view')->middleware('checkLoggedIn');

//sms
Route::get('/admin/sms/write/{id}', [SmsNotificationController::class, 'writeSMS'])->name('admin.write-sms')->middleware('checkLoggedIn');
Route::post('/admin/sms/send/{id}', [SmsNotificationController::class, 'send'])->name('admin.send-sms')->middleware('checkLoggedIn');
// email
Route::get('/admin/email/write/{id}', [EmailNotificationController::class, 'writeEmail'])->name('admin.write-email')->middleware('checkLoggedIn');
Route::post('/admin/email/send/{id}', [EmailNotificationController::class, 'sendEmail'])->name('admin.send-email')->middleware('checkLoggedIn');

//promote
Route::get('/admin/sms/choose/promotion/{id}', [SmsNotificationController::class, 'choose'])->name('admin.choose-promotion')->middleware('checkLoggedIn');

Route::get('/admin/sms/promote/{id}', [SmsNotificationController::class, 'indexPromoteSMS'])->name('admin.index.sms-promote')->middleware('checkLoggedIn');
Route::post('/admin/sms/send/promote/{id}', [SmsNotificationController::class, 'sendPromoteSMS'])->name('admin.send.sms-promote')->middleware('checkLoggedIn');

Route::get('/admin/email/promote/{id}', [EmailNotificationController::class, 'indexPromoteEmail'])->name('admin.index.email-promote')->middleware('checkLoggedIn');
Route::post('/admin/email/send/promote/{id}', [EmailNotificationController::class, 'sendPromoteEmail'])->name('admin.send.email-promote')->middleware('checkLoggedIn');