<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminLoginController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\Centers\CenterControllers;
use App\Http\Controllers\Currency\CurrencyController;
use App\Http\Controllers\Faqs\FaqsController;
use App\Http\Controllers\Gallery\GalleryController;
use App\Http\Controllers\Games\GameController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Investments\InvestmentController;
use App\Http\Controllers\Investments\InvestmentSettingsController;
use App\Http\Controllers\News\NewsController;
use App\Http\Controllers\PrimaryPages\PrimaryPagesController;
use App\Http\Controllers\Roles\AddRolesController;
use App\Http\Controllers\Roles\RolesController;
use App\Http\Controllers\Roles\UserTypeController;
use App\Http\Controllers\Settings\AppSettingsController;
use App\Http\Controllers\Support\SupportController;
use App\Http\Controllers\Testimony\TestimonyController;
use App\Http\Controllers\UsersArea\CreateUsersController;
use App\Http\Controllers\Verifications\VerifyBankController;
use App\Http\Controllers\Wallet\TransactionController;
use App\Http\Controllers\Wallet\WithdrawalController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LoginAuthenticator;

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

//Route::get('/login/{refId?}', [LoginController::class, 'showLoginForm'])->name('login');


Route::get('/investment_manager/{refId}', [PrimaryPagesController::class, 'manageRef'])->name('investment_manager');

Route::post('/logUserOut', function(){

    Auth::logout();
    return response()->json(['status'=>true]);

})->name('front_page');
//Route::get('/', [PrimaryPagesController::class, 'index'])->name('front_page');
Route::get('/packages', [PrimaryPagesController::class, 'viewPackages'])->name('packages');
Route::get('/about', [PrimaryPagesController::class, 'about'])->name('about');
Route::get('/anthem', [PrimaryPagesController::class, 'anthem'])->name('anthem');
Route::get('/how-it-works', [PrimaryPagesController::class, 'howItWorks'])->name('how-it-works');
Route::get('/testimony', [PrimaryPagesController::class, 'testimony'])->name('testimony');
Route::get('/gallery', [PrimaryPagesController::class, 'gallery'])->name('gallery');
Route::get('/single_gallery/{single_gallery_id}', [PrimaryPagesController::class, 'single_gallery'])->name('single_gallery');
Route::get('/collection-centers', [PrimaryPagesController::class, 'collectionCenters'])->name('collection-centers');
Route::get('/contact', [PrimaryPagesController::class, 'contact'])->name('contact');
/*Route::get('/packages', [PrimaryPagesController::class, 'packages'])->name('packages');*/
Route::get('/news-events', [PrimaryPagesController::class, 'newsEvents'])->name('news-events');
Route::get('/privacy-policy', [PrimaryPagesController::class, 'privacyPolicy'])->name('privacy-policy');
Route::get('/terms-of-service', [PrimaryPagesController::class, 'termsOfService'])->name('terms-of-service');
Route::get('/faqs-page', [PrimaryPagesController::class, 'faqsPage'])->name('faqs-page');
Route::get('/news-details/{newsId}', [PrimaryPagesController::class, 'newsDetails'])->name('news-details');

//show alt login
Route::get('/alt_login', [AdminLoginController::class, 'index'])->name('alt_login');
Route::post('/login-admin-user', [AdminLoginController::class, 'login'])->name('login-admin-user');



//registration form route
Route::get('/registration', [CreateUsersController::class, 'showForm'])->name('show_registration_form');
//handle registration
Route::post('/handle_registration', [CreateUsersController::class, 'storeUsers'])->name('handle_registration');


//bank verification
Route::get('/verifications/bank/{userId?}', [VerifyBankController::class, 'verifyBankInterface'])->name('account_validation');
Route::post('/verify-bank', [VerifyBankController::class, 'verifyBank'])->name('verify-bank');
Route::post('/add-bank/{userId?}', [VerifyBankController::class, 'addBank'])->name('add-bank');

//failed fee payment
Route::get('/failed_api', [TransactionController::class,'returnFailedPage'])->name('failed_api');

Auth::routes(['verify' => true]);
//verify email address
Route::get('/email/verify', [VerificationController::class, 'showNotice'])->middleware(['auth'])->name('verification.notice');//verification.notice


//email verification handler
Route::get('/email/verify/{id}/{hash}', [VerificationController::class,'verifyEmailHandler'])->middleware(['auth', 'signed'])->name('verification.verify');
//resend verification link
Route::post('/email/verification-notification', [VerificationController::class, 'sendVerificationEmailNotification'])->middleware(['auth', 'throttle:6,1'])->name('verification.send');


//password reset link page
Route::get('/forgot-password', [ResetPasswordController::class, 'showPasswordResetInterface'])->middleware(['guest'])->name('password.request');
//send email fpr password reset
Route::post('/forgot-password', [ResetPasswordController::class, 'sendPasswordResetLink'])->middleware(['guest'])->name('password.email');
//verify reset password token
Route::get('/reset-password/{token}', [ResetPasswordController::class, 'verifyPasswordResetToken'])->middleware(['guest'])->name('password.reset');
//RESET THE PASSWORD
Route::post('/reset-password', [ResetPasswordController::class, 'resetThePassword'])->middleware(['guest'])->name('password.update');

/*Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/main', function (){
    return view('main_view.register');
})->name('main');*/

Route::group(['middleware'=>['web', 'emailVerifier', 'loginAuthChecker']], function () {//->middleware('verified')

Route::get('/home', [HomeController::class, 'index'])->name('home');

//route for the user's details
Route::get('/profile/{userID?}', [HomeController::class, 'profile'])->name('profile')/*->middleware('verified')*/;
Route::get('/editProfile/{userID?}', [HomeController::class, 'editProfile'])->name('editProfile');
Route::post('/updateProfile', [HomeController::class, 'updateProfile'])->name('updateProfile');
Route::post('/uploadUserImage', [HomeController::class, 'uploadUserImage'])->name('uploadUserImage');
Route::post('/updateCurrency', [HomeController::class, 'updateCurrency'])->name('updateCurrency');
Route::post('/updatePassword', [HomeController::class, 'updatePassword'])->name('updatePassword');


});
//
Route::group(['middleware'=>['web', 'emailVerifier', 'loginAuthChecker']], function(){

    //game route control
    Route::get('/games_type', function (){
        return view('dashboard.games_type');
    })->name('games_type');

    Route::get('/create_game_type', function (){
        return view('dashboard.create_game_type');
    })->name('create_game_type');


    Route::get('/play_game', function (){
        return view('dashboard.play_game');
    })->name('play_game');

    Route::get('/game_history', function (){
        return view('dashboard.game_history');
    })->name('game_history');

    //main system settings
    Route::get('/main_settings_page/{unique_id?}', [AppSettingsController::class, 'showAppSettings'])->name('main_settings_page');
    Route::get('/settings_page', [AppSettingsController::class, 'displayAppSettings'])->name('settings_page');
    Route::post('/createAppSettings}', [AppSettingsController::class, 'createAppSettings'])->name('createAppSettings');
    Route::post('/app_settings_sub/{appSettingId?}', [AppSettingsController::class, 'storeAppSettings'])->name('app_settings_sub');
    Route::post('/create_game_type', [AppSettingsController::class, 'createGameType'])->name('create_game_type');


    //transaction history
    Route::get('/transaction_history/{unique_id}', [TransactionController::class, 'show'])->name('transaction_history');
    //store new transactions and pay
    Route::get('/store_new_transaction/{amount_in_base_64}/{action_type}/{option_for_payment}', [TransactionController::class, 'storeNewTransactions'])->name('store_new_transaction');
    Route::post('/api/validate_flutter_wave_top_up_payment', [TransactionController::class, 'validateFlutterWavePayment'])->name('validate_flutter_wave_payment');
    //show wallet transactions
    Route::get('/wallet/{userId?}', [TransactionController::class, 'showTransactions'])->name('wallet');
    Route::get('/confirmed_wallet/{userId?}', [TransactionController::class, 'showConfirmedTransactions'])->name('confirmed_wallet');
    Route::get('/charge/{userId?}', [TransactionController::class, 'showChargeTransactions'])->name('charge');
    //show all top up transaction
    Route::get('/get_top_up_with_conditions/{start_date?}/{end_date?}/{userId?}', [TransactionController::class, 'getTopUpWithConditions'])->name('get_top_up_with_conditions');
    Route::get('/get_confirmed_top_up_with_conditions/{start_date?}/{end_date?}/{userId?}', [TransactionController::class, 'getConfirmedTopUpWithConditions'])->name('get_confirmed_top_up_with_conditions');
    Route::get('/show_bank_transaction/{transId}', [TransactionController::class, 'showBankTransaction'])->name('show_bank_transaction');
    //upload payment proof
    Route::post('/upload_payment_proof', [TransactionController::class, 'uploadPaymentProof'])->name('upload_payment_proof');

    //show pending top ups by date
    Route::post('/show_top_up_transactions_by_date/{userId?}', [TransactionController::class, 'showTopUpTransactionsByDate'])->name('show_top_up_transactions_by_date');

    //show confirmed and failed top ups by date
    Route::post('/show_confirmed_top_up_transactions_by_date/{userId?}', [TransactionController::class, 'showConfirmedTopUpTransactionsByDate'])->name('show_confirmed_top_up_transactions_by_date');

    Route::post('/confirmTop', [TransactionController::class, 'confirmTopUp'])->name('confirmTop');
    Route::post('/handle_transfers', [TransactionController::class, 'handleTransfers'])->name('handle_transfers');
    Route::post('/confirm_withdrawal_payment', [TransactionController::class, 'markWithdrawalsAsPaid'])->name('confirm_withdrawal_payment');
    Route::post('/show_charges_by_date/{userId?}', [TransactionController::class, 'showChargesByDate'])->name('show_charges_by_date');
    Route::get('/get_charges_with_conditions/{start_date?}/{end_date?}/{userId?}', [TransactionController::class, 'getChargesWithConditions'])->name('get_charges_with_conditions');
    Route::post('/deleteTransactionDetails', [TransactionController::class, 'deleteTransactionDetails'])->name('deleteTransactionDetails');

    //show all withdrawal for admin
    Route::get('/show_all_withdrawals/{userId?}', [WithdrawalController::class, 'showAllWithdrawals'])->name('show_all_withdrawals');
    Route::get('/show_all_confirmed_withdrawals/{userId?}', [WithdrawalController::class, 'showAllConfirmedWithdrawals'])->name('show_all_confirmed_withdrawals');
    //request withdrwawal
    Route::post('/make_withdrawal', [WithdrawalController::class, 'storeWithdrawal'])->name('make_withdrawal');
    //show withdrawals by date
    Route::post('/show_withdrawals_transactions_by_date/{userId?}', [WithdrawalController::class, 'showAllWithdrawalsByDate'])->name('show_withdrawals_transactions_by_date');
    Route::post('/show_all_confirmed_withdrawals_by_date/{userId?}', [WithdrawalController::class, 'showAllConfirmedWithdrawalsByDate'])->name('show_all_confirmed_withdrawals_by_date');

    Route::get('/show_withdrawals_with_conditions/{start_date?}/{end_date?}/{type}/{userId?}', [WithdrawalController::class, 'showWithdrawalsWithConditions'])->name('show_withdrawals_with_conditions');
    Route::get('/show_confirmed_withdrawals_with_conditions/{start_date?}/{end_date?}/{userId?}', [WithdrawalController::class, 'showConfirmedWithdrawalsWithConditions'])->name('show_confirmed_withdrawals_with_conditions');


    //admin routes
    //admin routes
    Route::get('/all_users', [AdminController::class, 'showAllUsers'])->name('all_users');
    Route::get('/all_admin', [AdminController::class, 'showAllAdmin'])->name('all_admin');
    Route::get('/all_super_admin', [AdminController::class, 'showAllSuperAdmin'])->name('all_super_admin');
    Route::post('/manage_account', [AdminController::class, 'manageAccount'])->name('manage_account');


    //grandour bank details
    Route::get('/getAccountDetails', [AppSettingsController::class, 'getAccountDetails'])->name('getAccountDetails');
    Route::post('/deleteBankDetails', [AppSettingsController::class, 'deleteBankDetails'])->name('deleteBankDetails');


    //validate with web hook
    Route::get('/hook/validate_with_hook', [TransactionController::class, 'validateWithWebHook'])->name('validate_with_hook');



    //investments
    Route::get('/investments_settings', [InvestmentSettingsController::class, 'index'])->name('investments_settings');
    Route::post('/create_investment_plan', [InvestmentSettingsController::class, 'createInvestmentPlan'])->name('create_investment_plan');
    Route::post('/update_investment_plan/{investmentPlanId?}', [InvestmentSettingsController::class, 'updateInvestmentPlan'])->name('update_investment_plan');
    Route::get('/view_investment_plan/{investmentId?}', [InvestmentSettingsController::class, 'viewInvestmentPlans'])->name('view_investment_plan');
    Route::post('/deletePlans', [InvestmentSettingsController::class, 'deletePlans'])->name('deletePlans');
    Route::get('/create_investment_interface/{refId?}', [InvestmentController::class, 'createInvestmentInterface'])->name('create_investment_interface');
    Route::get('/get_single_investment_settings/{InvestmentSettingsUniqueId}', [InvestmentController::class, 'getInvestmentSettings'])->name('get_single_investment_settings');
    Route::post('/create_an_investment', [InvestmentController::class, 'createAnInvestment'])->name('create_an_investment');
    Route::get('/reward_day_checker', [InvestmentController::class, 'rewardDayChecker'])->name('reward_day_checker');
    Route::get('/view_investments/{investmentPlanID?}/{userUniqueId?}', [InvestmentController::class, 'viewInvestments'])->name('view_investments');
    Route::get('/view_due_investments/{investmentPlanID?}/{userUniqueId?}', [InvestmentController::class, 'viewDueInvestments'])->name('view_due_investments');
    Route::get('/view_investment_history/{investmentPlanID?}/{userUniqueId?}', [InvestmentController::class, 'viewInvestmentHistory'])->name('view_investment_history');
    Route::post('/confirm_dispensation', [InvestmentController::class, 'confirmDispensation'])->name('confirm_dispensation');
    Route::post('/show_investments_by_date/{investmentPlanID?}/{option?}/{userUniqueId?}', [InvestmentController::class, 'showInvestmentsByDate'])->name('show_investments_by_date');
    Route::get('/get_investments_by_date/{investmentPlanID?}/{start_date?}/{end_date?}/{option?}/{userUniqueId?}', [InvestmentController::class, 'getInvestmentsByDate'])->name('get_investments_by_date');
    Route::get('/investment_referral/{investmentID?}', [InvestmentController::class, 'investmentReferral'])->name('investment_referral');
    Route::get('/edit_investment_settings_page/{investmentPlanId}', [InvestmentSettingsController::class, 'edit'])->name('edit_investment_settings_page');
    Route::get('/edit_investment/{investmentPlanId}', [InvestmentController::class, 'editUserInvestment'])->name('edit_investment');
    Route::post('/update_user_investment/{investmentPlanId}', [InvestmentController::class, 'updateUserInvestment'])->name('update_user_investment');
    //confirm incentives disbursement
    Route::post('/confirm_disbursement', [InvestmentController::class, 'confirmDisbursement'])->name('confirm_disbursement');


    //Gallery routes
    Route::get('/create_gallery_view', [GalleryController::class, 'index'])->name('create_gallery_view');
    Route::post('/store_gallery', [GalleryController::class, 'storeNewEvent'])->name('store_gallery');
    Route::get('/view_gallery_events', [GalleryController::class, 'viewGalleryEvents'])->name('view_gallery_events');
    Route::get('/view_single_gallery/{galleryId?}', [GalleryController::class, 'viewSingleGallery'])->name('view_single_gallery');
    Route::post('/deleteGalleryImage', [GalleryController::class, 'deleteGalleryImage'])->name('deleteGalleryImage');
    Route::post('/deleteGallery', [GalleryController::class, 'deleteGallery'])->name('deleteGallery');
    Route::get('/edit_gallery_page/{galleryId}', [GalleryController::class, 'editGalleryPage'])->name('edit_gallery_page');
    Route::post('/update_gallery/{galleryId}', [GalleryController::class, 'updateGallery'])->name('update_gallery');


    //News Routes
    Route::get('/create_news_view', [NewsController::class, 'createNewsView'])->name('create_news_view');
    Route::post('/store_news', [NewsController::class, 'storeNews'])->name('store_news');
    Route::get('/view_all_news', [NewsController::class, 'index'])->name('view_all_news');
    Route::get('/edit_news_page/{newsId}', [NewsController::class, 'editNewsPage'])->name('edit_news_page');
    Route::post('/update_news/{newsId}', [NewsController::class, 'updateNews'])->name('update_news');
    Route::post('/confirmNewsDelete', [NewsController::class, 'confirmNewsDelete'])->name('confirmNewsDelete');
    Route::get('/single_news_page/{newsId}', [NewsController::class, 'singleNewsPage'])->name('single_news_page');


    //frequentlt asked question
    Route::get('/create_faqs_page', [FaqsController::class, 'create'])->name('create_faqs_page');
    Route::get('/view_fags', [FaqsController::class, 'index'])->name('view_fags');
    Route::post('/store_faqs', [FaqsController::class, 'storeFaqs'])->name('store_faqs');
    Route::get('/edit_faqs/{faqsId}', [FaqsController::class, 'edit'])->name('edit_faqs');
    Route::post('/confirm_faq_delete', [FaqsController::class, 'destroy'])->name('confirm_faq_delete');
    Route::post('/update_faqs/{faqsId}', [FaqsController::class, 'update'])->name('update_faqs');

    //create new testimonies
    Route::get('/view_testimonies', [TestimonyController::class, 'index'])->name('view_testimonies');
    Route::post('/store_testimony', [TestimonyController::class, 'store'])->name('store_testimony');
    Route::post('/confirm_testimony_delete', [TestimonyController::class, 'destroy'])->name('confirm_testimony_delete');
    Route::post('/approve_testimonies', [TestimonyController::class, 'approveTestimonies'])->name('approve_testimonies');

    //centers
    Route::get('/create_center_page', [CenterControllers::class, 'create'])->name('create_center_page');
    Route::post('/store_centers', [CenterControllers::class, 'store'])->name('store_centers');
    Route::get('/show_all_centers', [CenterControllers::class, 'index'])->name('show_all_centers');
    Route::post('/deleteCenter', [CenterControllers::class, 'destroy'])->name('deleteCenter');
    Route::get('/edit_center_page/{centerId}', [CenterControllers::class, 'edit'])->name('edit_center_page');
    Route::post('/update_centers/{centerId}', [CenterControllers::class, 'update'])->name('update_centers');



    //currency rate controller
    Route::get('/currency_converter', [CurrencyController::class, 'currencyRatesUpdate'])->name('currency_converter');


    //support
    Route::get('/view_support/{userId?}', [SupportController::class, 'index'])->name('view_support');
    Route::get('/view_single_support/{support_id?}', [SupportController::class, 'indexSingle'])->name('view_single_support');
    Route::get('/compose/{userId?}', [SupportController::class, 'indexCompose'])->name('create_support');
    Route::post('/store_support/{mainSupportId?}', [SupportController::class, 'store'])->name('store_support');
    Route::post('/handle_message_delete', [SupportController::class, 'destroy'])->name('handle_message_delete');
    Route::get('/get_support_notification', [SupportController::class, 'supportNotifier'])->name('get_support_notification');

    //add funds
    Route::get('/add_funds/{userId?}', [TransactionController::class, 'showAddFunds'])->name('add_funds');
    Route::post('/store_funds/{userId?}', [TransactionController::class, 'storeFunds'])->name('store_funds');




});

Route::group(['middleware'=>['web']], function(){

    //send user to authicator page
    Route::get('/login_authenticator', [LoginAuthenticator::class, 'index'])->name('login_authenticator');
    Route::get('/resend_login_authenticator', [LoginAuthenticator::class, 'resendLoginAuthCode'])->name('resend_login_authenticator');
    Route::post('/update_login_auth', [LoginAuthenticator::class, 'checkLoginAuth'])->name('update_login_auth');
    Route::get('/send_text', [LoginAuthenticator::class, 'getAuthCodeForJs'])->name('send_text');

});

//add roles area
Route::get('/add_roles', [RolesController::class, 'create'])->name('add_roles');
Route::get('/view_all_roles', [RolesController::class, 'index'])->name('view_all_roles');
Route::post('/store_role', [RolesController::class, 'store'])->name('store_role');
Route::get('/add_role_for_user/{userTypeId}', [AddRolesController::class, 'index'])->name('add_role_for_user');
Route::post('/store_role_for_user/{userTypeId}', [AddRolesController::class, 'store'])->name('store_role_for_user');//user_type_id,role_id

//add user type
Route::get('/add_user_type', [UserTypeController::class, 'create'])->name('add_user_type');
Route::get('/all_user_type', [UserTypeController::class, 'index'])->name('all_user_type');
Route::post('/store_user_type', [UserTypeController::class, 'store'])->name('store_user_type');