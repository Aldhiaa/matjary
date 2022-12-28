<?php

use Illuminate\Support\Facades\Route;

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

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');usersusers

require __DIR__.'/auth.php';

//Route::get('/register/{lang?}', 'Auth\RegisteredUserController@showRegistrationForm')->name('register');


Route::get('/register', function () {
    $settings = Utility::settings();
    $lang = $settings['default_language'];

    if($settings['enable_signup'] == 'on'){
        return view("auth.register", compact('lang'));
        // Route::get('/register', 'Auth\RegisteredUserController@showRegistrationForm')->name('register');
    }else{
        return Redirect::to('login');
    }

});

Route::post('register', 'Auth\RegisteredUserController@store')->name('register');
Route::get('/login/{lang?}', 'Auth\AuthenticatedSessionController@showLoginForm')->name('login');

Route::get('/password/resets/{lang?}', 'Auth\AuthenticatedSessionController@showLinkRequestForm')->name('change.langPass');

Route::get('invoice/{id}/show', 'InvoiceController@customerInvoiceShow')->name('customer.invoice.show')->middleware(
    [
        'auth:customer',
        'XSS','revalidate',
    ]
);

//================================= Contract Type  ====================================//
Route::group(
    [
        'middleware' => [
            'auth',
            'XSS',
            'revalidate',
        ],
    ], function (){
    Route::resource('contractType', 'ContractTypeController');
}
);

//================================= Contract  ====================================//
Route::group(
    [
        'middleware' => [
            'auth',
            'XSS',
            'revalidate',
        ],
    ], function (){
    // Route::get('contract/{id}/description', 'ContractController@description')->name('contract.description');
    // Route::get('contract/grid', 'ContractController@grid')->name('contract.grid');
    Route::resource('contract', 'ContractController');
    Route::get('contract/duplicate/{id}', 'ContractController@duplicate')->name('contract.duplicate')->middleware(['auth','XSS']);
    Route::put('contract/duplicatecontract/{id}', 'ContractController@duplicatecontract')->name('contract.duplicatecontract')->middleware(['auth','XSS']);
    Route::post('contract/{id}/description', 'ContractController@descriptionStore')->name('contract.description.store')->middleware(['auth','XSS']);
    Route::post('contract/{id}/file', 'ContractController@fileUpload')->name('contract.file.upload')->middleware(['auth','XSS']);
    Route::get('/contract/{id}/file/{fid}','ContractController@fileDownload')->name('contract.file.download')->middleware(['auth','XSS']);
    Route::delete('/contract/{id}/file/delete/{fid}','ContractController@fileDelete')->name('contract.file.delete')->middleware(['auth','XSS']);
    Route::post('/contract/{id}/comment','ContractController@commentStore')->name('comment.store')->middleware(['auth','XSS']);
    Route::get('/contract/{id}/comment','ContractController@commentDestroy')->name('comment.destroy')->middleware(['auth','XSS']);  
    Route::post('/contract/{id}/note', 'ContractController@noteStore')->name('contract.note.store')->middleware(['auth','XSS']);
    Route::get('/contract/{id}/note', 'ContractController@noteDestroy')->name('contract.note.destroy')->middleware(['auth','XSS']);
    Route::get('contract/pdf/{id}', 'ContractController@pdffromcontract')->name('contract.download.pdf')->middleware(['auth','XSS']);
    Route::get('contract/{id}/get_contract', 'ContractController@printContract')->name('get.contract')->middleware(['auth','XSS']);
    Route::get('/signature/{id}', 'ContractController@signature')->name('signature')->middleware(['auth','XSS']);
    Route::post('/signaturestore', 'ContractController@signatureStore')->name('signaturestore')->middleware(['auth','XSS']);
    Route::get('/contract/{id}/mail','ContractController@sendmailContract')->name('send.mail.contract')->middleware(['auth','XSS']);
    



    // Route::get('/contract/copy/{id}',['as' => 'contract.copy','uses' =>'ContractController@copycontract'])->middleware(['auth','XSS']);
    // Route::post('/contract/copy/store',['as' => 'contract.copy.store','uses' =>'ContractController@copycontractstore'])->middleware(['auth','XSS']);

    
}
);

//================================= Retainers  ====================================//


Route::resource('retainer', 'RetainerController');
Route::get('retainer/create/{cid}', 'RetainerController@create')->name('retainer.create')->middleware(['auth','XSS']);
Route::post('retainer/product', 'RetainerController@product')->name('retainer.product');
Route::get('retainer/{id}/sent', 'RetainerController@sent')->name('retainer.sent');
Route::get('retainer/{id}/status/change', 'RetainerController@statusChange')->name('retainer.status.change');
Route::get('retainer/pdf/{id}', 'RetainerController@retainer')->name('retainer.pdf')->middleware(['XSS','revalidate',]);
Route::get('retainer/{id}/resent', 'RetainerController@resent')->name('retainer.resent');
Route::get('retainer/{id}/duplicate', 'RetainerController@duplicate')->name('retainer.duplicate');
Route::get('retainer/{id}/payment', 'RetainerController@payment')->name('retainer.payment');
Route::post('retainer/{id}/payment', 'RetainerController@createPayment')->name('retainer.payment');
Route::get('retainer/{id}/payment/reminder', 'RetainerController@paymentReminder')->name('retainer.payment.reminder');
Route::post('retainer/{id}/payment/{pid}/destroy', 'RetainerController@paymentDestroy')->name('retainer.payment.destroy');
Route::get('retainer/{id}/convert', 'RetainerController@convert')->name('retainer.convert');
Route::post('retainer/product/destroy', 'RetainerController@productDestroy')->name('retainer.product.destroy');
Route::get(
    '/retainer/pay/{retainer}', [
           'as' => 'pay.retainerpay',
           'uses' => 'RetainerController@payretainer',
       ]
);
Route::post(
    '/retainer/template/setting', [
                                    'as' => 'retainer.template.setting',
                                    'uses' => 'RetainerController@saveRetainerTemplateSettings',
                                ]
);
Route::get(
    '/retainer/preview/{template}/{color}', [
                                              'as' => 'retainer.preview',
                                              'uses' => 'RetainerController@previewRetainer',
                                          ]
);





//================================= Email Templates  ====================================//
       
        Route::get('email_template_lang/{id}/{lang?}', 'EmailTemplateController@manageEmailLang')->name('manage.email.language')->middleware(['auth','XSS']);
        Route::post('email_template_store/{pid}', 'EmailTemplateController@storeEmailLang')->name('store.email.language')->middleware(['auth']);
        Route::post('email_template_status/{id}', 'EmailTemplateController@updateStatus')->name('status.email.language')->middleware(['auth']);

        Route::resource('email_template', 'EmailTemplateController')->middleware(
            [
                'auth',
                'XSS',
                'revalidate',
            ]
        );
        

Route::prefix('customer')->as('customer.')->group(
    function (){
        Route::get('login/{lang}', 'Auth\AuthenticatedSessionController@showCustomerLoginLang')->name('login.lang')->middleware(['XSS']);
        Route::get('login', 'Auth\AuthenticatedSessionController@showCustomerLoginForm')->name('login')->middleware(['XSS']);
        Route::post('login', 'Auth\AuthenticatedSessionController@customerLogin')->name('login')->middleware(['XSS']);

        Route::get('/password/resets/{lang?}', 'Auth\AuthenticatedSessionController@showCustomerLinkRequestForm')->name('change.langPass');
        Route::post('/password/email', 'Auth\AuthenticatedSessionController@postCustomerEmail')->name('password.email');

        Route::get('reset-password/{token}', 'Auth\AuthenticatedSessionController@getCustomerPassword')->name('
        ');
        Route::post('reset-password', 'Auth\AuthenticatedSessionController@updateCustomerPassword')->name('password.reset');

        //================================= Retainer  ====================================//

        Route::get('retainer', 'RetainerController@customerRetainer')->name('retainer')->middleware(
            [
                'auth:customer',
                'XSS','revalidate',
            ]
        );

        Route::get('retainer/{id}/show', 'RetainerController@customerRetainerShow')->name('retainer.show')->middleware(
            [
                'auth:customer',
                'XSS','revalidate',
            ]
        );

        Route::get('retainer/{id}/send', 'RetainerController@customerRetainerSend')->name('retainer.send')->middleware(
            [
                'auth:customer',
                'XSS','revalidate',
            ]
        );
        
        Route::post('retainer/{id}/send/mail', 'RetainerController@customerRetainerSendMail')->name('retainer.send.mail')->middleware(
            [
                'auth:customer',
                'XSS','revalidate',
            ]
        );

        Route::post('retainer/{id}/payment', 'StripePaymentController@addretainerpayment')->name('retainer.payment')->middleware(
            [
                'auth:customer',
                'XSS','revalidate',
            ]
        );


        Route::get('dashboard', 'CustomerController@dashboard')->name('dashboard')->middleware(
            [
                'auth:customer',
                'XSS','revalidate',
            ]
        );

        Route::get('invoice', 'InvoiceController@customerInvoice')->name('invoice')->middleware(
            [
                'auth:customer',
                'XSS','revalidate',
            ]
        );
        Route::get(
            '/invoice/pay/{invoice}', [
                   'as' => 'pay.invoice',
                   'uses' => 'InvoiceController@payinvoice',
               ]
        );
        Route::get('proposal', 'ProposalController@customerProposal')->name('proposal')->middleware(
            [
                'auth:customer',
                'XSS','revalidate',
            ]
        );

        Route::get('proposal/{id}/show', 'ProposalController@customerProposalShow')->name('proposal.show')->middleware(
            [
                'auth:customer',
                'XSS','revalidate',
            ]
        );
        

        Route::get('invoice/{id}/send', 'InvoiceController@customerInvoiceSend')->name('invoice.send')->middleware(
            [
                'auth:customer',
                'XSS','revalidate',
            ]
        );
        
        Route::post('invoice/{id}/send/mail', 'InvoiceController@customerInvoiceSendMail')->name('invoice.send.mail')->middleware(
            [
                'auth:customer',
                'XSS','revalidate',
            ]
        );

        

        Route::get('invoice/{id}/show', 'InvoiceController@customerInvoiceShow')->name('invoice.show')->middleware(
            [
                'auth:customer',
                'XSS','revalidate',
            ]
        );

        Route::get('invoice/{id}/show', 'InvoiceController@customerInvoiceShow')->name('invoice.view')->middleware(
            [
                'auth:customer',
                'XSS','revalidate',
            ]
        );

        Route::post('invoice/{id}/payment', 'StripePaymentController@addpayment')->name('invoice.payment')->middleware(
            [
                'auth:customer',
                'XSS','revalidate',
            ]
        );

        Route::post('retainer/{id}/payment', 'StripePaymentController@addretainerpayment')->name('retainer.payment')->middleware(
            [
                'auth:customer',
                'XSS','revalidate',
            ]
        );
        

        Route::get('payment', 'CustomerController@payment')->name('payment')->middleware(
            [
                'auth:customer',
                'XSS','revalidate',
            ]
        );
        Route::get('transaction', 'CustomerController@transaction')->name('transaction')->middleware(
            [
                'auth:customer',
                'XSS','revalidate',
            ]
        );
        Route::post('logout', 'CustomerController@customerLogout')->name('logout')->middleware(
            [
                'auth:customer',
                'XSS','revalidate',
            ]
        );
        Route::get('profile', 'CustomerController@profile')->name('profile')->middleware(
            [
                'auth:customer',
                'XSS','revalidate',
            ]
        );

        Route::post('update-profile', 'CustomerController@editprofile')->name('update.profile')->middleware(
            [
                'auth:customer',
                'XSS','revalidate',
            ]
        );
        Route::post('billing-info', 'CustomerController@editBilling')->name('update.billing.info')->middleware(
            [
                'auth:customer',
                'XSS','revalidate',
            ]
        );
        Route::post('shipping-info', 'CustomerController@editShipping')->name('update.shipping.info')->middleware(
            [
                'auth:customer',
                'XSS','revalidate',
            ]
        );
        Route::post('change.password', 'CustomerController@updatePassword')->name('update.password')->middleware(
            [
                'auth:customer',
                'XSS','revalidate',
            ]
        );
        
        Route::get('change-language/{lang}', 'CustomerController@changeLanquage')->name('change.language')->middleware(
            [
                'auth:customer',
                'XSS','revalidate',
            ]
        );

        //================================= contract ====================================//

        Route::resource('contract', 'ContractController')->middleware(
            [
                'auth:customer',
                'XSS','revalidate',
            ]
        );

        Route::post('contract/{id}/description', 'ContractController@descriptionStore')->name('contract.description.store')->middleware(
            [
                'auth:customer',
                'XSS','revalidate',
            ]
        );
        Route::post('contract/{id}/file', 'ContractController@fileUpload')->name('contract.file.upload')->middleware(['auth:customer','XSS']);
        Route::post('/contract/{id}/comment','ContractController@commentStore')->name('comment.store')->middleware(['auth:customer','XSS']);
        Route::post('/contract/{id}/note', 'ContractController@noteStore')->name('contract.note.store')->middleware(['auth:customer','XSS']);
        Route::get('contract/pdf/{id}', 'ContractController@pdffromcontract')->name('contract.download.pdf')->middleware(['auth:customer','XSS']);
        Route::get('contract/{id}/get_contract', 'ContractController@printContract')->name('get.contract')->middleware(['auth:customer','XSS']);
        Route::get('/signature/{id}', 'ContractController@signature')->name('signature')->middleware(['auth:customer','XSS']);
        Route::post('/signaturestore', 'ContractController@signatureStore')->name('signaturestore')->middleware(['auth:customer','XSS']);
        Route::get('contract/pdf/{id}', 'ContractController@pdffromcontract')->name('contract.download.pdf')->middleware(['auth:customer','XSS']);
        Route::delete('/contract/{id}/file/delete/{fid}','ContractController@fileDelete')->name('contract.file.delete')->middleware(['auth:customer','XSS']);
        Route::get('/contract/{id}/comment','ContractController@commentDestroy')->name('comment.destroy')->middleware(['auth:customer','XSS']);  
        Route::get('/contract/{id}/note', 'ContractController@noteDestroy')->name('contract.note.destroy')->middleware(['auth:customer','XSS']);






        //================================= Invoice Payment Gateways  ====================================//


        Route::post('/paymentwall' , ['as' => 'invoice.paymentwallpayment','uses' =>'PaymentWallPaymentController@invoicepaymentwall'])->middleware(['XSS','auth:customer']);

        Route::post('{id}/invoice-with-paypal', 'PaypalController@customerPayWithPaypal')->name('invoice.with.paypal')->middleware(
            [
                'XSS',
                'revalidate',
            ]
        );

        Route::post('{id}/pay-with-paypal', 'PaypalController@customerretainerPayWithPaypal')->name('pay.with.paypal')->middleware(
            [
                'XSS',
                'revalidate',
            ]
        );

        Route::get('{id}/get-retainer-payment-status', 'PaypalController@customerGetRetainerPaymentStatus')->name('get.retainer.payment.status')->middleware(
            [
                'XSS:customer',
                'revalidate',
            ]
        );

        Route::get('{id}/get-payment-status', 'PaypalController@customerGetPaymentStatus')->name('get.payment.status')->middleware(
            [
                'XSS',
                'revalidate',
            ]
        );

        Route::post('invoice/{id}/payment', 'StripePaymentController@addpayment')->name('invoice.payment')->middleware(
            [
                'XSS',
                'revalidate',
            ]
        );

        Route::post('/retainer-pay-with-paystack',['as' => 'retainer.pay.with.paystack','uses' =>'PaystackPaymentController@RetainerPayWithPaystack'])->middleware(['XSS:customer']);
        Route::any('/retainer/paystack/{pay_id}/{retainer_id}', ['as' => 'retainer.paystack','uses' => 'PaystackPaymentController@getRetainerPaymentStatus'])->middleware(['XSS:customer']);

        Route::post('/invoice-pay-with-paystack',['as' => 'invoice.pay.with.paystack','uses' =>'PaystackPaymentController@invoicePayWithPaystack'])->middleware(['XSS']);
        Route::any('/invoice/paystack/{pay_id}/{invoice_id}', ['as' => 'invoice.paystack','uses' => 'PaystackPaymentController@getInvoicePaymentStatus']);

        Route::post('/retainer-pay-with-flaterwave',['as' => 'retainer.pay.with.flaterwave','uses' =>'FlutterwavePaymentController@retainerPayWithFlutterwave'])->middleware(['XSS:customer']);
        Route::get('/retainer/flaterwave/{txref}/{retainer_id}', ['as' => 'retainer.flaterwave','uses' => 'FlutterwavePaymentController@getRetainerPaymentStatus'])->middleware(['XSS']);

        Route::post('/invoice-pay-with-flaterwave',['as' => 'invoice.pay.with.flaterwave','uses' =>'FlutterwavePaymentController@invoicePayWithFlutterwave'])->middleware(['XSS']);
        Route::get('/invoice/flaterwave/{txref}/{invoice_id}', ['as' => 'invoice.flaterwave','uses' => 'FlutterwavePaymentController@getInvoicePaymentStatus']);

        Route::post('/retainer-pay-with-razorpay',['as' => 'retainer.pay.with.razorpay','uses' =>'RazorpayPaymentController@retainerPayWithRazorpay'])->middleware(['XSS']);
        Route::get('/retainer/razorpay/{txref}/{retainer_id}', ['as' => 'retainer.razorpay','uses' => 'RazorpayPaymentController@getRetainerPaymentStatus']);


        Route::post('/invoice-pay-with-razorpay',['as' => 'invoice.pay.with.razorpay','uses' =>'RazorpayPaymentController@invoicePayWithRazorpay'])->middleware(['XSS']);
        Route::get('/invoice/razorpay/{txref}/{invoice_id}', ['as' => 'invoice.razorpay','uses' => 'RazorpayPaymentController@getInvoicePaymentStatus']);

        Route::post('/retainer-pay-with-paytm',['as' => 'retainer.pay.with.paytm','uses' =>'PaytmPaymentController@retainerPayWithPaytm'])->middleware(['XSS']);
        Route::post('/retainer/paytm/{retainer}/{amount}', ['as' => 'retainer.paytm','uses' => 'PaytmPaymentController@getRetainerPaymentStatus'])->middleware(['XSS','auth:customer']);


        Route::post('/invoice-pay-with-paytm',['as' => 'invoice.pay.with.paytm','uses' =>'PaytmPaymentController@invoicePayWithPaytm'])->middleware(['XSS']);
        Route::post('/invoice/paytm/{invoice}/{amount}', ['as' => 'invoice.paytm','uses' => 'PaytmPaymentController@getInvoicePaymentStatus']);

        Route::post('/retainer-pay-with-mercado',['as' => 'retainer.pay.with.mercado','uses' =>'MercadoPaymentController@retainerPayWithMercado'])->middleware(['XSS']);
        Route::any('/retainer/mercado/{retainer}', ['as' => 'retainer.mercado','uses' => 'MercadoPaymentController@getRetainerPaymentStatus']);
        Route::any('/retainer/mercado/{retainer}', ['as' => 'retainer.mercado','uses' => 'MercadoPaymentController@getRetainerPaymentStatus'])->middleware(['XSS','auth:customer']);


        Route::post('/invoice-pay-with-mercado',['as' => 'invoice.pay.with.mercado','uses' =>'MercadoPaymentController@invoicePayWithMercado'])->middleware(['XSS']);
        Route::any('/invoice/mercado/{invoice}', ['as' => 'invoice.mercado','uses' => 'MercadoPaymentController@getInvoicePaymentStatus']);

        Route::post('/retainer-pay-with-mollie',['as' => 'retainer.pay.with.mollie','uses' =>'MolliePaymentController@retainerPayWithMollie'])->middleware(['XSS']);
        Route::get('/retainer/mollie/{invoice}/{amount}', ['as' => 'retainer.mollie','uses' => 'MolliePaymentController@getRetainerPaymentStatus']);

        Route::post('/invoice-pay-with-mollie',['as' => 'invoice.pay.with.mollie','uses' =>'MolliePaymentController@invoicePayWithMollie'])->middleware(['XSS']);
        Route::get('/invoice/mollie/{invoice}/{amount}', ['as' => 'invoice.mollie','uses' => 'MolliePaymentController@getInvoicePaymentStatus']);

        Route::post('/retainer-pay-with-skrill',['as' => 'retainer.pay.with.skrill','uses' =>'SkrillPaymentController@retainerPayWithSkrill'])->middleware(['XSS']);
        Route::get('/retainer/skrill/{retainer}/{amount}', ['as' => 'retainer.skrill','uses' => 'SkrillPaymentController@getRetainerPaymentStatus']);

        Route::post('/invoice-pay-with-skrill',['as' => 'invoice.pay.with.skrill','uses' =>'SkrillPaymentController@invoicePayWithSkrill'])->middleware(['XSS']);
        Route::get('/invoice/skrill/{invoice}/{amount}', ['as' => 'invoice.skrill','uses' => 'SkrillPaymentController@getInvoicePaymentStatus']);

        Route::post('/retainer-pay-with-coingate',['as' => 'retainer.pay.with.coingate','uses' =>'CoingatePaymentController@retainerPayWithCoingate'])->middleware(['XSS']);
        Route::get('/retainer/coingate/{retainer}/{amount}', ['as' => 'retainer.coingate','uses' => 'CoingatePaymentController@getRetainerPaymentStatus'])->middleware(['XSS']);

        Route::post('/invoice-pay-with-coingate',['as' => 'invoice.pay.with.coingate','uses' =>'CoingatePaymentController@invoicePayWithCoingate'])->middleware(['XSS']);
        Route::get('/invoice/coingate/{invoice}/{amount}', ['as' => 'invoice.coingate','uses' => 'CoingatePaymentController@getInvoicePaymentStatus'])->middleware(['XSS']);

         
   

    }
);

Route::prefix('vender')->as('vender.')->group(
    function (){
        Route::get('login/{lang}', 'Auth\AuthenticatedSessionController@showVenderLoginLang')->name('login.lang')->middleware(['XSS']);
        Route::get('login', 'Auth\AuthenticatedSessionController@showVenderLoginForm')->name('login')->middleware(['XSS']);
        Route::post('login', 'Auth\AuthenticatedSessionController@VenderLogin')->name('login')->middleware(['XSS']);


        Route::get('/password/resets/{lang?}', 'Auth\AuthenticatedSessionController@showVendorLinkRequestForm')->name('change.langPass');
        Route::post('/password/email', 'Auth\AuthenticatedSessionController@postVendorEmail')->name('password.email');

        Route::get('reset-password/{token}', 'Auth\AuthenticatedSessionController@getVendorPassword')->name('reset.password');
        Route::post('reset-password', 'Auth\AuthenticatedSessionController@updateVendorPassword')->name('password.reset');




        Route::get('dashboard', 'VenderController@dashboard')->name('dashboard')->middleware(
            [
                'auth:vender',
                'XSS','revalidate',
            ]
        );
        Route::get('bill', 'BillController@VenderBill')->name('bill')->middleware(
            [
                'auth:vender',
                'XSS','revalidate',
            ]
        );
        Route::get('bill/{id}/show', 'BillController@venderBillShow')->name('bill.show')->middleware(
            [
                'auth:vender',
                'XSS','revalidate',
            ]
        );


        Route::get('bill/{id}/send', 'BillController@venderBillSend')->name('bill.send')->middleware(
            [
                'auth:vender',
                'XSS','revalidate',
            ]
        );
        Route::post('bill/{id}/send/mail', 'BillController@venderBillSendMail')->name('bill.send.mail')->middleware(
            [
                'auth:vender',
                'XSS','revalidate',
            ]
        );


        Route::get('payment', 'VenderController@payment')->name('payment')->middleware(
            [
                'auth:vender',
                'XSS','revalidate',
            ]
        );
        Route::get('transaction', 'VenderController@transaction')->name('transaction')->middleware(
            [
                'auth:vender',
                'XSS','revalidate',
            ]
        );
        Route::post('logout', 'VenderController@venderLogout')->name('logout')->middleware(
            [
                'auth:vender',
                'XSS','revalidate',
            ]
        );

        Route::get('profile', 'VenderController@profile')->name('profile')->middleware(
            [
                'auth:vender',
                'XSS','revalidate',
            ]
        );

        Route::post('update-profile', 'VenderController@editprofile')->name('update.profile')->middleware(
            [
                'auth:vender',
                'XSS','revalidate',
            ]
        );
        Route::post('billing-info', 'VenderController@editBilling')->name('update.billing.info')->middleware(
            [
                'auth:vender',
                'XSS','revalidate',
            ]
        );
        Route::post('shipping-info', 'VenderController@editShipping')->name('update.shipping.info')->middleware(
            [
                'auth:vender',
                'XSS','revalidate',
            ]
        );
        Route::post('change.password', 'VenderController@updatePassword')->name('update.password')->middleware(
            [
                'auth:vender',
                'XSS','revalidate',
            ]
        );
        Route::get('change-language/{lang}', 'VenderController@changeLanquage')->name('change.language')->middleware(
            [
                'auth:vender',
                'XSS','revalidate',
            ]
        );

    }
);


Route::get('/', 'DashboardController@index')->name('dashboard')->middleware(['XSS','revalidate',]);

Route::get('/dashboard', 'DashboardController@index')->name('dashboard')->middleware(
    [
        'auth',
        'XSS','revalidate',
    ]
);
Route::get('user/{id}/plan', 'UserController@upgradePlan')->name('plan.upgrade')->middleware(
    [
        'auth',
        'XSS','revalidate',
    ]
);
Route::get('user/{id}/plan/{pid}', 'UserController@activePlan')->name('plan.active')->middleware(
    [
        'auth',
        'XSS','revalidate',
    ]
);
Route::get('profile', 'UserController@profile')->name('profile')->middleware(
    [
        'auth',
        'XSS','revalidate',
    ]
);
Route::post('edit-profile', 'UserController@editprofile')->name('update.account')->middleware(
    [
        'auth',
        'XSS','revalidate',
    ]
);

Route::resource('users', 'UserController')->middleware(
    [
        'auth',
        'XSS','revalidate',
    ]
);
Route::post('change-password', 'UserController@updatePassword')->name('update.password');
Route::any('user-reset-password/{id}', 'UserController@userPassword')->name('users.reset');
Route::post('user-reset-password/{id}', 'UserController@userPasswordReset')->name('user.password.update');


Route::get('/change/mode',['as' => 'change.mode','uses' =>'UserController@changeMode']);



Route::resource('roles', 'RoleController')->middleware(
    [
        'auth',
        'XSS','revalidate',
    ]
);
Route::resource('permissions', 'PermissionController')->middleware(
    [
        'auth',
        'XSS','revalidate',
    ]
);

Route::group(
    [
        'middleware' => [
            'auth',
            'XSS','revalidate',
        ],
    ], function (){
    Route::get('change-language/{lang}', 'LanguageController@changeLanquage')->name('change.language');
    Route::get('manage-language/{lang}', 'LanguageController@manageLanguage')->name('manage.language');
    Route::post('store-language-data/{lang}', 'LanguageController@storeLanguageData')->name('store.language.data');
    Route::get('create-language', 'LanguageController@createLanguage')->name('create.language');
    Route::post('store-language', 'LanguageController@storeLanguage')->name('store.language');

    Route::delete('/lang/{lang}', 'LanguageController@destroyLang')->name('lang.destroy');
}
);

Route::group(
    [
        'middleware' => [
            'auth',
            'XSS','revalidate',
        ],
    ], function (){

    Route::resource('systems', 'SystemController');
    Route::post('email-settings', 'SystemController@saveEmailSettings')->name('email.settings');
    Route::post('company-settings', 'SystemController@saveCompanySettings')->name('company.settings');
    Route::post('stripe-settings', 'SystemController@savePaymentSettings')->name('payment.settings');
    Route::post('system-settings', 'SystemController@saveSystemSettings')->name('system.settings');
    Route::post('recaptcha-settings',['as' => 'recaptcha.settings.store','uses' =>'SystemController@recaptchaSettingStore'])->middleware(['auth','XSS']);
    Route::get('company-setting', 'SystemController@companyIndex')->name('company.setting');
    Route::post('business-setting', 'SystemController@saveBusinessSettings')->name('business.setting');
    Route::post('twilio-settings', 'SystemController@saveTwilioSettings')->name('twilio.settings');
    Route::post('company-payment-setting', 'SystemController@saveCompanyPaymentSettings')->name('company.payment.settings');
    Route::get('test-mail', 'SystemController@testMail')->name('test.mail');
    Route::post('test-mail', 'SystemController@testSendMail')->name('test.send.mail');

}
);


Route::get('productservice/index', 'ProductServiceController@index')->name('productservice.index');
Route::resource('productservice', 'ProductServiceController')->middleware(
    [
        'auth',
        'XSS','revalidate',
    ]
);


//Product Stock
Route::resource('productstock', 'ProductStockController')->middleware(
    [
        'auth',
        'XSS','revalidate',
    ]
);



Route::group(
    [
        'middleware' => [
            'auth',
            'XSS','revalidate',
        ],
    ], function (){

    Route::get('customer/{id}/show', 'CustomerController@show')->name('customer.show');
    Route::ANY('customer/{id}/statement', 'CustomerController@statement')->name('customer.statement');
    Route::any('customer-reset-password/{id}', 'CustomerController@customerPassword')->name('customer.reset');
    Route::post('customer-reset-password/{id}', 'CustomerController@customerPasswordReset')->name('customer.password.update');
    Route::resource('customer', 'CustomerController');

}
);
Route::group(
    [
        'middleware' => [
            'auth',
            'XSS','revalidate',
        ],
    ], function (){

    Route::get('vender/{id}/show', 'VenderController@show')->name('vender.show');
    Route::ANY('vender/{id}/statement', 'VenderController@statement')->name('vender.statement');

    Route::resource('vender', 'VenderController');

}
);

Route::group(
    [
        'middleware' => [
            'auth',
            'XSS','revalidate',
        ],
    ], function (){

    Route::resource('bank-account', 'BankAccountController');

}
);
Route::group(
    [
        'middleware' => [
            'auth',
            'XSS','revalidate',
        ],
    ], function (){

    Route::get('transfer/index', 'TransferController@index')->name('transfer.index');
    Route::resource('transfer', 'TransferController');

}
);


Route::resource('taxes', 'TaxController')->middleware(
    [
        'auth',
        'XSS','revalidate',
    ]
);

Route::resource('product-category', 'ProductServiceCategoryController')->middleware(
    [
        'auth',
        'XSS','revalidate',
    ]
);

Route::resource('product-unit', 'ProductServiceUnitController')->middleware(
    [
        'auth',
        'XSS','revalidate',
    ]
);


Route::get('invoice/pdf/{id}', 'InvoiceController@invoice')->name('invoice.pdf')->middleware(['XSS','revalidate',]);
Route::group(
    [
        'middleware' => [
            'auth',
            'XSS','revalidate',
        ],
    ], function (){


    Route::get('invoice/{id}/duplicate', 'InvoiceController@duplicate')->name('invoice.duplicate');
    Route::get('invoice/{id}/shipping/print', 'InvoiceController@shippingDisplay')->name('invoice.shipping.print');
    Route::get('invoice/{id}/payment/reminder', 'InvoiceController@paymentReminder')->name('invoice.payment.reminder');
    Route::get('invoice/index', 'InvoiceController@index')->name('invoice.index');
    Route::post('invoice/product/destroy', 'InvoiceController@productDestroy')->name('invoice.product.destroy');
    Route::post('invoice/product', 'InvoiceController@product')->name('invoice.product');
    Route::post('invoice/customer', 'InvoiceController@customer')->name('invoice.customer');
    Route::get('invoice/{id}/sent', 'InvoiceController@sent')->name('invoice.sent');
    Route::get('invoice/{id}/resent', 'InvoiceController@resent')->name('invoice.resent');
    Route::get('invoice/{id}/payment', 'InvoiceController@payment')->name('invoice.payment');
    Route::post('invoice/{id}/payment', 'InvoiceController@createPayment')->name('invoice.payment');
    Route::post('invoice/{id}/payment/{pid}/destroy', 'InvoiceController@paymentDestroy')->name('invoice.payment.destroy');
    Route::get('invoice/items', 'InvoiceController@items')->name('invoice.items');

    Route::resource('invoice', 'InvoiceController');
    Route::get('invoice/create/{cid}', 'InvoiceController@create')->name('invoice.create');
}
);

Route::get(
    '/invoices/preview/{template}/{color}', [
                                              'as' => 'invoice.preview',
                                              'uses' => 'InvoiceController@previewInvoice',
                                          ]
);
Route::post(
    '/invoices/template/setting', [
                                    'as' => 'invoice.template.setting',
                                    'uses' => 'InvoiceController@saveTemplateSettings',
                                ]
);

Route::group(
    [
        'middleware' => [
            'auth',
            'XSS','revalidate',
        ],
    ], function (){


    Route::get('credit-note', 'CreditNoteController@index')->name('credit.note');
    Route::get('custom-credit-note', 'CreditNoteController@customCreate')->name('invoice.custom.credit.note');
    Route::post('custom-credit-note', 'CreditNoteController@customStore')->name('invoice.custom.credit.note');
    Route::get('credit-note/invoice', 'CreditNoteController@getinvoice')->name('invoice.get');
    Route::get('invoice/{id}/credit-note', 'CreditNoteController@create')->name('invoice.credit.note');
    Route::post('invoice/{id}/credit-note', 'CreditNoteController@store')->name('invoice.credit.note');
    Route::get('invoice/{id}/credit-note/edit/{cn_id}', 'CreditNoteController@edit')->name('invoice.edit.credit.note');
    Route::post('invoice/{id}/credit-note/edit/{cn_id}', 'CreditNoteController@update')->name('invoice.edit.credit.note');
    Route::delete('invoice/{id}/credit-note/delete/{cn_id}', 'CreditNoteController@destroy')->name('invoice.delete.credit.note');

}
);

Route::group(
    [
        'middleware' => [
            'auth',
            'XSS','revalidate',
        ],
    ], function (){


    Route::get('debit-note', 'DebitNoteController@index')->name('debit.note');
    Route::get('custom-debit-note', 'DebitNoteController@customCreate')->name('bill.custom.debit.note');
    Route::post('custom-debit-note', 'DebitNoteController@customStore')->name('bill.custom.debit.note');
    Route::get('debit-note/bill', 'DebitNoteController@getbill')->name('bill.get');
    Route::get('bill/{id}/debit-note', 'DebitNoteController@create')->name('bill.debit.note');
    Route::post('bill/{id}/debit-note', 'DebitNoteController@store')->name('bill.debit.note');
    Route::get('bill/{id}/debit-note/edit/{cn_id}', 'DebitNoteController@edit')->name('bill.edit.debit.note');
    Route::post('bill/{id}/debit-note/edit/{cn_id}', 'DebitNoteController@update')->name('bill.edit.debit.note');
    Route::delete('bill/{id}/debit-note/delete/{cn_id}', 'DebitNoteController@destroy')->name('bill.delete.debit.note');

}
);


Route::get(
    '/bill/preview/{template}/{color}', [
                                          'as' => 'bill.preview',
                                          'uses' => 'BillController@previewBill',
                                      ]
);
Route::post(
    '/bill/template/setting', [
                                'as' => 'bill.template.setting',
                                'uses' => 'BillController@saveBillTemplateSettings',
                            ]
);

Route::resource('taxes', 'TaxController')->middleware(
    [
        'auth',
        'XSS','revalidate',
    ]
);

Route::get('revenue/index', 'RevenueController@index')->name('revenue.index')->middleware(
    [
        'auth',
        'XSS','revalidate',
    ]
);
Route::resource('revenue', 'RevenueController')->middleware(
    [
        'auth',
        'XSS','revalidate',
    ]
);

Route::get('bill/pdf/{id}', 'BillController@bill')->name('bill.pdf')->middleware(['XSS','revalidate',]);
Route::group(
    [
        'middleware' => [
            'auth',
            'XSS','revalidate',
        ],
    ], function (){

    Route::get('bill/{id}/duplicate', 'BillController@duplicate')->name('bill.duplicate');
    Route::get('bill/{id}/shipping/print', 'BillController@shippingDisplay')->name('bill.shipping.print');
    Route::get('bill/index', 'BillController@index')->name('bill.index');
    Route::post('bill/product/destroy', 'BillController@productDestroy')->name('bill.product.destroy');
    Route::post('bill/product', 'BillController@product')->name('bill.product');
    Route::post('bill/vender', 'BillController@vender')->name('bill.vender');
    Route::get('bill/{id}/sent', 'BillController@sent')->name('bill.sent');
    Route::get('bill/{id}/resent', 'BillController@resent')->name('bill.resent');
    Route::get('bill/{id}/payment', 'BillController@payment')->name('bill.payment');
    Route::post('bill/{id}/payment', 'BillController@createPayment')->name('bill.payment');
    Route::post('bill/{id}/payment/{pid}/destroy', 'BillController@paymentDestroy')->name('bill.payment.destroy');
    Route::get('bill/items', 'BillController@items')->name('bill.items');

    Route::resource('bill', 'BillController');
    Route::get('bill/create/{cid}', 'BillController@create')->name('bill.create');
}
);


Route::get('payment/index', 'PaymentController@index')->name('payment.index')->middleware(
    [
        'auth',
        'XSS','revalidate',
    ]
);
Route::resource('payment', 'PaymentController')->middleware(
    [
        'auth',
        'XSS','revalidate',
    ]
);


Route::resource('plans', 'PlanController')->middleware(
    [
        'auth',
        'XSS','revalidate',
    ]
);


Route::resource('expenses', 'ExpenseController')->middleware(
    [
        'auth',
        'XSS','revalidate',
    ]
);





Route::group(
    [
        'middleware' => [
            'auth',
            'XSS','revalidate',
        ],
    ], function (){

    Route::get('report/transaction', 'TransactionController@index')->name('transaction.index');


}
);

Route::group(
    [
        'middleware' => [
            'auth',
            'XSS','revalidate',
        ],
    ], function (){

    Route::get('report/income-summary', 'ReportController@incomeSummary')->name('report.income.summary');
    Route::get('report/expense-summary', 'ReportController@expenseSummary')->name('report.expense.summary');
    Route::get('report/income-vs-expense-summary', 'ReportController@incomeVsExpenseSummary')->name('report.income.vs.expense.summary');
    Route::get('report/tax-summary', 'ReportController@taxSummary')->name('report.tax.summary');
    Route::get('report/profit-loss-summary', 'ReportController@profitLossSummary')->name('report.profit.loss.summary');

    Route::get('report/invoice-summary', 'ReportController@invoiceSummary')->name('report.invoice.summary');
    Route::get('report/bill-summary', 'ReportController@billSummary')->name('report.bill.summary');
    Route::get('report/product-stock-report', 'ReportController@productStock')->name('report.product.stock.report');


    Route::get('report/invoice-report', 'ReportController@invoiceReport')->name('report.invoice');
    Route::get('report/account-statement-report', 'ReportController@accountStatement')->name('report.account.statement');

    Route::get('report/balance-sheet', 'ReportController@balanceSheet')->name('report.balance.sheet');
    Route::get('report/ledger', 'ReportController@ledgerSummary')->name('report.ledger');
    Route::get('report/trial-balance', 'ReportController@trialBalanceSummary')->name('trial.balance');
}
);

Route::get(
    '/apply-coupon', [
                       'as' => 'apply.coupon',
                       'uses' => 'CouponController@applyCoupon',
                   ]
)->middleware(
    [
        'auth',
        'XSS','revalidate',
    ]
);

Route::resource('coupons', 'CouponController')->middleware(
    [
        'auth',
        'XSS','revalidate',
    ]
);

Route::get('proposal/pdf/{id}', 'ProposalController@proposal')->name('proposal.pdf')->middleware(['XSS','revalidate',]);

Route::group(
    [
        'middleware' => [
            'auth',
            'XSS','revalidate',
        ],
    ], function (){

    Route::get('proposal/{id}/status/change', 'ProposalController@statusChange')->name('proposal.status.change');
    Route::get('proposal/{id}/convert', 'ProposalController@convert')->name('proposal.convert');
    Route::get('proposal/{id}/duplicate', 'ProposalController@duplicate')->name('proposal.duplicate');
    Route::post('proposal/product/destroy', 'ProposalController@productDestroy')->name('proposal.product.destroy');
    Route::post('proposal/customer', 'ProposalController@customer')->name('proposal.customer');
    Route::post('proposal/product', 'ProposalController@product')->name('proposal.product');
    Route::get('proposal/items', 'ProposalController@items')->name('proposal.items');
    Route::get('proposal/{id}/sent', 'ProposalController@sent')->name('proposal.sent');
    Route::get('proposal/{id}/resent', 'ProposalController@resent')->name('proposal.resent');

    Route::resource('proposal', 'ProposalController');
    Route::get('proposal/create/{cid}', 'ProposalController@create')->name('proposal.create');
}
);

Route::get(
    '/proposal/preview/{template}/{color}', [
                                              'as' => 'proposal.preview',
                                              'uses' => 'ProposalController@previewProposal',
                                          ]
);
Route::post(
    '/proposal/template/setting', [
                                    'as' => 'proposal.template.setting',
                                    'uses' => 'ProposalController@saveProposalTemplateSettings',
                                ]
);



//Budget Planner //

Route::resource('budget', 'BudgetController')->middleware(
    [
        'auth',
        'XSS',
        'revalidate',
    ]
);


Route::resource('goal', 'GoalController')->middleware(
    [
        'auth',
        'XSS','revalidate',
    ]
);
Route::resource('account-assets', 'AssetController')->middleware(
    [
        'auth',
        'XSS','revalidate',
    ]
);
Route::resource('custom-field', 'CustomFieldController')->middleware(
    [
        'auth',
        'XSS','revalidate',
    ]
);

Route::post('plan-pay-with-paypal', 'PaypalController@planPayWithPaypal')->name('plan.pay.with.paypal')->middleware(
    [
        'XSS','revalidate',
    ]
);

Route::get('{id}/plan-get-payment-status', 'PaypalController@planGetPaymentStatus')->name('plan.get.payment.status')->middleware(
    [
        'auth',
        'XSS','revalidate',
    ]
);

Route::post('chart-of-account/subtype', 'ChartOfAccountController@getSubType')->name('charofAccount.subType')->middleware(
    [
        'auth',
        'XSS','revalidate',
    ]
);

Route::group(
    [
        'middleware' => [
            'auth',
            'XSS','revalidate',
        ],
    ], function (){

    Route::resource('chart-of-account', 'ChartOfAccountController');

}
);


Route::group(
    [
        'middleware' => [
            'auth',
            'XSS','revalidate',
        ],
    ], function (){

    Route::post('journal-entry/account/destroy', 'JournalEntryController@accountDestroy')->name('journal.account.destroy');
    Route::resource('journal-entry', 'JournalEntryController');

}
);

//================================= Plan Payment Gateways  ====================================//

Route::post('/plan-pay-with-paystack',['as' => 'plan.pay.with.paystack','uses' =>'PaystackPaymentController@planPayWithPaystack'])->middleware(['auth','XSS']);
Route::get('/plan/paystack/{pay_id}/{plan_id}', ['as' => 'plan.paystack','uses' => 'PaystackPaymentController@getPaymentStatus']);

Route::post('/plan-pay-with-flaterwave',['as' => 'plan.pay.with.flaterwave','uses' =>'FlutterwavePaymentController@planPayWithFlutterwave'])->middleware(['auth','XSS']);
Route::get('/plan/flaterwave/{txref}/{plan_id}', ['as' => 'plan.flaterwave','uses' => 'FlutterwavePaymentController@getPaymentStatus']);

Route::post('/plan-pay-with-razorpay',['as' => 'plan.pay.with.razorpay','uses' =>'RazorpayPaymentController@planPayWithRazorpay'])->middleware(['auth','XSS']);
Route::get('/plan/razorpay/{txref}/{plan_id}', ['as' => 'plan.razorpay','uses' => 'RazorpayPaymentController@getPaymentStatus']);

Route::post('/plan-pay-with-paytm',['as' => 'plan.pay.with.paytm','uses' =>'PaytmPaymentController@planPayWithPaytm'])->middleware(['auth','XSS']);
Route::post('/plan/paytm/{plan}', ['as' => 'plan.paytm','uses' => 'PaytmPaymentController@getPaymentStatus']);

Route::post('/plan-pay-with-mercado',['as' => 'plan.pay.with.mercado','uses' =>'MercadoPaymentController@planPayWithMercado'])->middleware(['auth','XSS']);
Route::get('/plan/mercado/{plan}', ['as' => 'plan.mercado','uses' => 'MercadoPaymentController@getPaymentStatus']);

Route::post('/plan-pay-with-mollie',['as' => 'plan.pay.with.mollie','uses' =>'MolliePaymentController@planPayWithMollie'])->middleware(['auth','XSS']);
Route::get('/plan/mollie/{plan}', ['as' => 'plan.mollie','uses' => 'MolliePaymentController@getPaymentStatus']);

Route::post('/plan-pay-with-skrill',['as' => 'plan.pay.with.skrill','uses' =>'SkrillPaymentController@planPayWithSkrill'])->middleware(['auth','XSS']);
Route::get('/plan/skrill/{plan}', ['as' => 'plan.skrill','uses' => 'SkrillPaymentController@getPaymentStatus']);

Route::post('/plan-pay-with-coingate',['as' => 'plan.pay.with.coingate','uses' =>'CoingatePaymentController@planPayWithCoingate'])->middleware(['auth','XSS']);
Route::get('/plan/coingate/{plan}', ['as' => 'plan.coingate','uses' => 'CoingatePaymentController@getPaymentStatus']);



Route::group(
    [
        'middleware' => [
            'auth',
            'XSS',
            'revalidate',
        ],
    ], function (){
    Route::get('order', 'StripePaymentController@index')->name('order.index');
    Route::get('/stripe/{code}', 'StripePaymentController@stripe')->name('stripe');
    Route::post('/stripe', 'StripePaymentController@stripePost')->name('stripe.post');
}
);


Route::post('plan-pay-with-paypal', 'PaypalController@planPayWithPaypal')->name('plan.pay.with.paypal')->middleware(
    [
        'auth',
        'XSS',
        'revalidate',
    ]
);

Route::get('{id}/plan-get-payment-status', 'PaypalController@planGetPaymentStatus')->name('plan.get.payment.status')->middleware(
    [
        'auth',
        'XSS',
        'revalidate',
    ]
);


// Plan Request Module
Route::get('plan_request', 'PlanRequestController@index')->name('plan_request.index')->middleware(['auth','XSS',]);
Route::get('request_frequency/{id}', 'PlanRequestController@requestView')->name('request.view')->middleware(['auth','XSS',]);
Route::get('request_send/{id}', 'PlanRequestController@userRequest')->name('send.request')->middleware(['auth','XSS',]);
Route::get('request_response/{id}/{response}', 'PlanRequestController@acceptRequest')->name('response.request')->middleware(['auth','XSS',]);
Route::get('request_cancel/{id}', 'PlanRequestController@cancelRequest')->name('request.cancel')->middleware(['auth','XSS',]);

// --------------------------- invoice payments  ---------------------

Route::get(
    '/invoice/pay/{invoice}', [
           'as' => 'pay.invoice',
           'uses' => 'InvoiceController@payinvoice',
       ]
);

Route::get(
    '/bill/pay/{bill}', [
           'as' => 'pay.billpay',
           'uses' => 'BillController@paybill',
       ]
);

Route::get(
    '/proposal/pay/{proposal}', [
           'as' => 'pay.proposalpay',
           'uses' => 'ProposalController@payproposal',
       ]
);


Route::post('/invoice-pay-with-stripe',['as' => 'invoice.pay.with.stripe','uses' =>'StripePaymentController@invoicePayWithStripe']);

Route::post('{id}/pay-with-paypal', 'PaypalController@clientPayWithPaypal')->name('client.pay.with.paypal')->middleware(
    [

        'XSS',
        'revalidate',
    ]
);

Route::get('invoice/pay/pdf/{id}', 'InvoiceController@pdffrominvoice')->name('invoice.download.pdf');


// -------------------------------------import export------------------------------

Route::get('export/productservice', 'ProductServiceController@export')->name('productservice.export');
Route::get('import/productservice/file', 'ProductServiceController@importFile')->name('productservice.file.import');
Route::post('import/productservice', 'ProductServiceController@import')->name('productservice.import');

Route::get('export/customer', 'CustomerController@export')->name('customer.export');
Route::get('import/customer/file', 'CustomerController@importFile')->name('customer.file.import');
Route::post('import/customer', 'CustomerController@import')->name('customer.import');

Route::get('export/vender', 'VenderController@export')->name('vender.export');
Route::get('import/vender/file', 'VenderController@importFile')->name('vender.file.import');
Route::post('import/vender', 'VenderController@import')->name('vender.import');


Route::get('export/Proposal', 'ProposalController@export')->name('proposal.export');
Route::get('export/invoice', 'InvoiceController@export')->name('invoice.export');
Route::get('export/Bill', 'BillController@export')->name('Bill.export');
Route::get('export/retainer', 'RetainerController@export')->name('retainer.export');



//Clear Config cache:
Route::get('/config-cache', function() {
    $exitCode = Artisan::call('config:cache');
    return '<h1>Clear Config cleared</h1>';
});
Route::get('/config-clear', function() {
    $exitCode = Artisan::call('config:clear');
    return '<h1>Clear Config cleared</h1>';
});

// ------------------------------------- PaymentWall ------------------------------

Route::post('/paymentwalls' , ['as' => 'plan.paymentwallpayment','uses' =>'PaymentWallPaymentController@paymentwall'])->middleware(['XSS']);
Route::post('/plan-pay-with-paymentwall/{plan}',['as' => 'plan.pay.with.paymentwall','uses' =>'PaymentWallPaymentController@planPayWithPaymentWall'])->middleware(['XSS']);
Route::get('/plan/{flag}', ['as' => 'error.plan.show','uses' => 'PaymentWallPaymentController@planeerror']);


Route::post('/paymentwall' , ['as' => 'invoice.paymentwallpayment','uses' =>'PaymentWallPaymentController@invoicepaymentwall'])->middleware(['XSS']);
Route::post('/invoice-pay-with-paymentwall/{plan}',['as' => 'invoice.pay.with.paymentwall','uses' =>'PaymentWallPaymentController@invoicePayWithPaymentwall'])->middleware(['XSS']);
Route::get('/invoices/{flag}/{invoice}', ['as' => 'error.invoice.show','uses' => 'PaymentWallPaymentController@invoiceerror']);

Route::post('/paymentwall' , ['as' => 'retainer.paymentwallpayment','uses' =>'PaymentWallPaymentController@retainerpaymentwall'])->middleware(['XSS']);
Route::post('/retainer-pay-with-paymentwall/{plan}',['as' => 'retainer.pay.with.paymentwall','uses' =>'PaymentWallPaymentController@retainerPayWithPaymentwall'])->middleware(['XSS']);
Route::get('/retainer/{flag}/{retainer}', ['as' => 'error.retainer.show','uses' => 'PaymentWallPaymentController@retainererror']);

