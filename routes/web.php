<?php

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

Auth::routes();

Route::get('auth/github', 'Auth\LoginController@redirectToProvider');
Route::get('auth/github/callback', 'Auth\LoginController@handleProviderCallback');
Route::get('/redirect', 'Auth\LoginController@redirectToProvidergoogle')->name('google.login');
Route::get('/callback', 'Auth\LoginController@handleProviderCallbackgoogle');
Route::get('facebook', function () {
    return view('facebook');
});

Route::get('auth/login', 'Auth\LoginController@redirectToFacebook')->name('facebook.login');
Route::get('auth/login/callback', 'Auth\LoginController@handleFacebookCallback');

Route::get('auth/linkedin', 'Auth\LoginController@redirectToLinkedin')->name('linkedin.login');
Route::get('auth/linkedin/callback', 'Auth\LoginController@handleLinkedinCallback');

Route::post('password/email', 'ForgotPasswordController@forgot')->name('password.reset');

Route::get('/sellerregister', 'Auth\RegisterController@sellerregister')->name('sellerregister');
Route::get('/emailverify', 'Auth\RegisterController@emailverify')->name('emailverify');
Route::get('/emailverifyseller', 'Auth\RegisterController@emailverifyseller')->name('emailverifyseller');
Route::post('/emails/sendverifycode', 'Frontend\EmailsController@sendverifycode')->name('emails.sendverifycode');
Route::post('/emails/validatecode', 'Frontend\EmailsController@validatecode')->name('emails.validatecode');
//Route::get('/emails/directconfirmpage/{email}/{role}/{codes}', 'Frontend\EmailsController@directconfirmpage')->name('emails.directconfirmpage');
Route::get('/emails/validatecode/{role}/{codes}', 'Auth\RegisterController@validatecode')->name('emails.validatecode');
Route::get('/emailverifyforresend/{email}/{role}', 'Auth\RegisterController@emailverifyforresend')->name('emailverifyforresend');

Route::get('/', 'Frontend\HomeController@index')->name('home');
Route::get('/verify_check/{email}', 'Frontend\HomeController@verify_check')->name('verify_check');
Route::get('/about-us', 'Frontend\HomeController@aboutus')->name('home.aboutus');
Route::get('/products', 'Frontend\HomeController@products')->name('home.products');
Route::get('/how-to-buy', 'Frontend\HomeController@howtobuy')->name('home.howtobuy');
Route::get('/how-to-sell', 'Frontend\HomeController@howtosell')->name('home.howtosell');
Route::get('/our-goal', 'Frontend\HomeController@ourgoal')->name('home.ourgoal');
Route::get('/privacy-policy', 'Frontend\HomeController@privacypolicy')->name('home.privacypolicy');
Route::get('/terms-conditions', 'Frontend\HomeController@termsconditions')->name('home.termsconditions');
Route::get('/all-category', 'Frontend\HomeController@allcategory')->name('home.allcategory');
Route::get('/blog', 'Frontend\HomeController@bloghome')->name('home.bloghome');
Route::get('/blogdetail/{postid}', 'Frontend\HomeController@blogdetail')->name('blogdetail');
Route::get('/seller/{sellerid}', 'Frontend\HomeController@sellerdetail')->name('home.sellerdetail');
Route::get('/product/curltest', 'Frontend\HomeController@curltest')->name('product.curltest');

Route::get('/account', 'Frontend\AccountController@index')->name('account');
Route::get('/changepass', 'Frontend\AccountController@changepass')->name('changepass');
Route::get('/myreviews', 'Frontend\AccountController@myreviews')->name('myreviews');

Route::put('/account/update', 'Frontend\AccountController@update')->name('account.update');

Route::resource('request', 'Frontend\RequestController');
Route::post('/request/store', 'Frontend\RequestController@store')->name('request.store');
Route::post('/request/generalstore', 'Frontend\RequestController@generalstore')->name('request.generalstore');
Route::post('/request/update', 'Frontend\RequestController@update')->name('request.update');
Route::get('/request/destroy/{id}', 'Frontend\RequestController@destroy')->name('request.destroy');
Route::get('/request/create/{product_id}', 'Frontend\RequestController@create')->name('request.sendrequest');
Route::get('/request/change/{request_id}', 'Frontend\RequestController@change')->name('request.change');
Route::get('/request/view/{request_id}', 'Frontend\RequestController@view')->name('request.view');
Route::get('/generalrequest', 'Frontend\RequestController@generalrequest')->name('request.general');
Route::get('/addgeneralrequest', 'Frontend\RequestController@addgeneralrequest')->name('request.addgeneral');

Route::resource('requestcallback', 'Frontend\RequestcallbackController');
Route::post('requestcallback/storeCallback', 'Frontend\RequestcallbackController@storeCallback')->name('requestcallback.storeCallback');

Route::resource('quote', 'Frontend\QuotesController');
Route::post('/quote/store', 'Frontend\QuotesController@store')->name('quote.store');
Route::post('/quote/update', 'Frontend\QuotesController@update')->name('quote.update');
Route::get('/quote/destroy/{id}', 'Frontend\QuotesController@destroy')->name('quote.destroy');
Route::get('/quote/reply/{id}', 'Frontend\QuotesController@reply')->name('quote.reply');
Route::get('/quote/edit/{id}', 'Frontend\QuotesController@editquote')->name('quote.edit');
Route::get('/quote/change/{id}', 'Frontend\QuotesController@change')->name('quote.change');
Route::get('/quote/detailview/{id}', 'Frontend\QuotesController@detailview')->name('quote.detailview');
Route::get('/quote/formaccepted/{id}', 'Frontend\QuotesController@formaccepted')->name('quote.formaccepted');
Route::get('/quote/formreject/{id}', 'Frontend\QuotesController@formreject')->name('quote.formreject');
Route::Post('/quote/accepted}', 'Frontend\QuotesController@accepted')->name('quote.accepted');
Route::Post('/quote/reject}', 'Frontend\QuotesController@reject')->name('quote.reject');
Route::post('/quote/getproductname', 'Frontend\QuotesController@getproductname')->name('quote.getproductname');
Route::post('/quote/quotedetail', 'Frontend\QuotesController@quotedetail')->name('quote.quotedetail');
Route::Post('/quote/quoteupdate}', 'Frontend\QuotesController@quoteupdate')->name('quote.quoteupdate');
Route::get('/quote/downloadpdf/{id}', 'Frontend\QuotesController@downloadpdf')->name('quote.downloadpdf');
Route::get('/quote/getcomments/{id}', 'Frontend\QuotesController@getcomments')->name('quote.getcomments');

Route::resource('purchaseorders', 'Frontend\PurchaseordersController');
Route::get('/purchaseorders/create', 'Frontend\PurchaseordersController@create')->name('purchaseorders.create');
Route::get('/purchaseorders/paymentchange/{id}', 'Frontend\PurchaseordersController@paymentchange')->name('purchaseorders.paymentchange');
Route::get('/purchaseorders/downloadpdf/{id}', 'Frontend\PurchaseordersController@downloadpdf')->name('purchaseorders.downloadpdf');
Route::get('/purchaseorders/deliverychange/{id}', 'Frontend\PurchaseordersController@deliverychange')->name('purchaseorders.deliverychange');
Route::post('/purchaseorders/update', 'Frontend\PurchaseordersController@update')->name('purchaseorders.update');
Route::post('/purchaseorders/deliveryupdate', 'Frontend\PurchaseordersController@deliveryupdate')->name('purchaseorders.deliveryupdate');
Route::get('/purchaseorders/comments/{id}', 'Frontend\PurchaseordersController@comments')->name('purchaseorders.comments');
Route::get('/purchaseorders/getcomments/{id}', 'Frontend\PurchaseordersController@getcomments')->name('purchaseorders.getcomments');

Route::get('/purchaseorders/addreview/{id}', 'Frontend\PurchaseordersController@addreview')->name('purchaseorders.addreview');
Route::get('/purchaseorders/viewreview/{id}', 'Frontend\PurchaseordersController@viewreview')->name('purchaseorders.viewreview');
Route::get('/purchaseorders/userreview/{id}', 'Frontend\ReviewsController@show')->name('purchaseorders.userreview');

Route::resource('howtoworks', 'Frontend\HowtoworksController');
Route::get('/howtoworks', 'Frontend\HowtoworksController@index')->name('howtoworks.index');

Route::resource('userprofile', 'Frontend\UserprofileController');
Route::get('/userprofile/view/{id}', 'Frontend\UserprofileController@view')->name('userprofile.view');
Route::get('/userprofile/show', 'Frontend\UserprofileController@show')->name('userprofile.show');

Route::resource('achieved', 'Frontend\AchievedquotesController');
Route::get('/achieved/downloadpdf/{id}', 'Frontend\AchievedquotesController@downloadpdf')->name('achieved.downloadpdf');
Route::get('/achieved/detailview/{id}', 'Frontend\AchievedquotesController@detailview')->name('achieved.detailview');

Route::resource('howtosells', 'Frontend\HowtosellsController');
Route::get('/howtosells', 'Frontend\HowtosellsController@index')->name('howtosells.index');

Route::resource('howtobuys', 'Frontend\HowtobuysController');
Route::get('/howtobuys', 'Frontend\HowtobuysController@index')->name('howtobuys.index');

Route::resource('comments', 'Frontend\CommentsController');
Route::post('/comments/store', 'Frontend\CommentsController@store')->name('comments.store');

Route::resource('emails', 'Frontend\EmailsController');
Route::post('/emails/store', 'Frontend\EmailsController@store')->name('emails.store');

Route::resource('reviews', 'Frontend\ReviewsController');
Route::post('/reviews/save', 'Frontend\ReviewsController@save')->name('reviews.save');

Route::put('/account/updatePassword', 'Frontend\AccountController@updatePassword')->name('account.updatePassword');

Route::get('/cart/index', 'Frontend\CartController@index')->name('cart.index');
Route::get('/cart/create/{product}', 'Frontend\CartController@create')->name('cart.create');
Route::get('/cart/destroy/{id}', 'Frontend\CartController@destroy')->name('cart.destroy');
Route::put('/cart/update/{id}', 'Frontend\CartController@update')->name('cart.update');
Route::get('/cart/empty', 'Frontend\CartController@empty')->name('cart.empty');
Route::get('/cart/checkout', 'Frontend\CartController@checkout')->name('cart.checkout');

Route::get('order/sales', 'Frontend\OrderController@sales')->name('order.sales');
Route::resource('order', 'Frontend\OrderController');

Route::resource('product', 'Frontend\ProductController');
Route::get('/myproduct', 'Frontend\ProductController@myproduct')->name('product.my');
Route::get('/create', 'Frontend\ProductController@create')->name('product.create');
Route::get('/edit/{slug}', 'Frontend\ProductController@edit')->name('product.edit');
Route::post('/product/upload', 'Frontend\ProductController@uploadFile')->name('product.upload');
Route::post('/updateupload', 'Frontend\ProductController@updateupload')->name('product.updateupload');
Route::post('/deleteadditionalimage', 'Frontend\ProductController@deleteadditionalimage')->name('product.deleteadditionalimage');
Route::get('/search', 'Frontend\ProductController@search_product')->name('product.search');

Route::get('products/deleteproductsbychoosing', 'Frontend\ProductController@deleteproductsbychoosing')->name('products.deleteproductsbychoosing');
Route::get('products/approveproductsbychoosing', 'Frontend\ProductController@approveproductsbychoosing')->name('products.approveproductsbychoosing');

Route::resource('shop', 'Frontend\ShopController');
Route::resource('address', 'Frontend\AddressController');
Route::put('address/setmain/{address}', 'Frontend\AddressController@set_main_address')->name('address.set_main_address');

Route::post('/image/deleteimage/{image}', 'Frontend\ImageController@deleteimage')->name('image.deleteim');
Route::delete('/image/destroy/{image}', 'Frontend\ImageController@destroy')->name('image.destroy');

// Blog  Start

Route::get('/bloghome', 'Blog\GeneralSettingsController@index')->name('blog.index');
Route::get('/blog/categorylist', 'Blog\CategoryController@index')->name('blog.category');
Route::get('/blog/create', 'Blog\CategoryController@create')->name('blog.create');
Route::get('/blog/edit/{category}', 'Blog\CategoryController@edit')->name('blog.edit');
Route::post('/blog/update/{category}', 'Blog\CategoryController@update')->name('blog.update');
Route::post('/blog/store', 'Blog\CategoryController@store')->name('blog.store');
Route::delete('/blog/destroy/{category}', 'Blog\CategoryController@destroy')->name('blog.destroy');
Route::get('/blog/posts', 'Blog\PostsController@index')->name('blog.posts');
Route::get('/post/create', 'Blog\PostsController@create')->name('post.create');
Route::get('/post/edit/{category}', 'Blog\PostsController@edit')->name('post.edit');
Route::post('/post/store', 'Blog\PostsController@store')->name('post.store');
Route::post('/post/update/{category}', 'Blog\PostsController@update')->name('post.update');
Route::delete('/post/destroy/{category}', 'Blog\PostsController@destroy')->name('post.destroy');

// Blog  End

Route::get('/admin', 'Admin\DashboardController@index')->name('dashboard.index');
Route::get('/manager', 'Admin\ManagesellersController@index')->name('managesellers.index');
Route::get('/admin/general', 'Admin\GeneralSettingsController@index')->name('admin.generalsetting');
Route::put('/admin/general/update/{generalsetting}', 'Admin\GeneralSettingsController@update')->name('admin.generalsetting.update');

Route::get('/admin/localization', 'Admin\LocalizationSettingsController@index')->name('admin.localizationsetting');
Route::put('/admin/localization/update/{localizationsetting}', 'Admin\LocalizationSettingsController@update')->name('admin.localizationsetting.update');

Route::resource('admin/managemanagers', 'Admin\ManagemanagersController');
Route::resource('admin/managesellers', 'Admin\ManagesellersController');
Route::get('/admin/managesellers', 'Admin\ManagesellersController@index')->name('managesellers.index');
Route::get('/admin/managesellers/verify/{id}', 'Admin\ManagesellersController@verify')->name('managesellers.verify');
Route::get('/admin/managesellers/notverify/{id}', 'Admin\ManagesellersController@notverify')->name('managesellers.notverify');
Route::post('/admin/managesellers/submitVerify', 'Admin\ManagesellersController@submitVerify')->name('managesellers.submitVerify');
Route::get('/admin/managesellers/details/{id}', 'Admin\ManagesellersController@details')->name('managesellers.details');

Route::resource('admin/managebuyers', 'Admin\ManagebuyersController');
Route::get('/admin/managebuyers', 'Admin\ManagebuyersController@index')->name('managebuyers.index');
Route::get('/admin/managebuyers/verify/{id}', 'Admin\ManagebuyersController@verify')->name('managebuyers.verify');
Route::get('/admin/managebuyers/notverify/{id}', 'Admin\ManagebuyersController@notverify')->name('managebuyers.notverify');
Route::post('/admin/managebuyers/submitVerify', 'Admin\ManagebuyersController@submitVerify')->name('managebuyers.submitVerify');

Route::resource('admin/category', 'Admin\CategoryController');
Route::get('/admin/category', 'Admin\CategoryController@index')->name('category.index');

Route::resource('admin/unit', 'Admin\UnitController');
Route::get('/admin/unit', 'Admin\UnitController@index')->name('unit.index');
// Route::get('/admin/unit/create', 'Admin\UnitController@index')->name('unit.create');

Route::resource('admin/products', 'Admin\ProductsController');
Route::get('/admin/products', 'Admin\ProductsController@index')->name('products.index');
Route::get('/admin/products/edit/{id}', 'Admin\ProductsController@edit')->name('products.edit');
Route::post('/admin/products/update', 'Admin\ProductsController@update')->name('products.update');
Route::post('/admin/products/delete_add_image', 'Admin\ProductsController@delete_add_image')->name('products.delete_add_image');

Route::resource('admin/requests', 'Admin\RequestsController');
Route::get('/admin/requests', 'Admin\RequestsController@index')->name('requests.index');
Route::get('/admin/requests/assign/{id}', 'Admin\RequestsController@assign')->name('requests.assign');
Route::get('/admin/requests/view/{id}', 'Admin\RequestsController@view')->name('requests.view');

Route::resource('admin/requestadmincallback', 'Admin\RequestAdmincallbackController');
Route::get('/admin/requestadmincallback', 'Admin\RequestAdmincallbackController@index')->name('requestadmincallback.index');

Route::resource('admin/quotes', 'Admin\QuotesController');
Route::get('/admin/quotes', 'Admin\QuotesController@index')->name('quotes.index');
Route::get('/admin/quotes/view/{id}', 'Admin\QuotesController@view')->name('quotes.view');

Route::get('/admin/purchaseorder', 'Admin\PurchaseordersController@index')->name('purchaseorder.index');
Route::get('/admin/purchaseorder/details/{id}', 'Admin\PurchaseordersController@details')->name('purchaseorder.details');

Route::get('/admin/completedorders', 'Admin\PurchaseordersController@completedorders')->name('completedorders.index');
Route::get('/admin/completedorders/{id}', 'Admin\PurchaseordersController@completedordersdetails')->name('completedorders.details');

Route::get('/admin/archievedorders', 'Admin\PurchaseordersController@archievedorders')->name('archievedorders.index');
Route::get('/admin/archievedorders/{id}', 'Admin\PurchaseordersController@archievedordersview')->name('archievedorders.view');

Route::resource('admin/emails', 'Admin\EmailsController');
Route::get('/admin/emails', 'Admin\EmailsController@index')->name('emails.index');
Route::get('/admin/template', 'Admin\EmailsController@template')->name('template.index');
Route::get('/admin/template/create', 'Admin\EmailsController@template_create')->name('template.create');
Route::get('/admin/template/edit/{id}', 'Admin\EmailsController@template_edit')->name('template.edit');
Route::get('/admin/template/view/{id}', 'Admin\EmailsController@template_view')->name('template.view');
Route::post('/admin/template/store', 'Admin\EmailsController@template_store')->name('template.store');
Route::post('/admin/template/update', 'Admin\EmailsController@template_update')->name('template.update');
Route::get('/admin/template/delete/{id}', 'Admin\EmailsController@template_delete')->name('template.delete');

Route::resource('admin/logs', 'Admin\AdminlogsController');
Route::get('/admin/logs', 'Admin\AdminlogsController@index')->name('logs.index');
Route::get('/admin/changepass', 'Admin\AdminlogsController@changepass')->name('admin.changepass');
Route::put('/admin/updatePassword', 'Admin\AdminlogsController@updatePassword')->name('admin.updatePassword');
Route::get('/admin/blog', 'Admin\BlogController@index')->name('blog.index');
Route::get('/admin/approve/{id}', 'Admin\BlogController@approve')->name('blog.approve');
Route::get('/admin/deapprove/{id}', 'Admin\BlogController@deapprove')->name('blog.deapprove');
Route::get('/admin/destroy/{id}', 'Admin\BlogController@destroy')->name('adminblog.destroy');

Route::get('/home', 'HomeController@index')->name('home');

// Axios AJAX call
Route::get('/getproducts-byfilter/{word}/{by}/{min}/{max}/{category}/{sort}', 'Frontend\ProductController@getproductsbyfilter');

Route::get('/api-getcategory', 'Frontend\ProductController@getcategory');
Route::get('/api-getcurrency', 'Frontend\ProductController@getlocalizationsettings');
Route::get('/api-getrole', 'Frontend\ProductController@getrole');

Route::get('/address-api', 'API\AddressApiController@index');
Route::get('/address-api/search/{searchQuery}', 'API\AddressApiController@search');
Route::get('/address-api/byid/{address}', 'API\AddressApiController@getAddressById');
Route::get('/address-api/mainaddress', 'API\AddressApiController@getMainAddress');

Route::get('/buyerdashboard', 'Frontend\BuyerdashboardController@index')->name('buyerdashboard.index');
Route::get('/sellerdashboard', 'Frontend\SellerdashboardController@index')->name('sellerdashboard.index');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/inventoryboard', 'Inventory\DashboardController@index')->name('inventory.index');
// Route::get('/inventory/label', 'Inventory\LabelController@index')->name('inventory.index');
Route::get('/inventory/label/create', 'Inventory\LabelController@create')->name('label.create');
Route::post('/inventory/label/store', 'Inventory\LabelController@store')->name('label.store');


Route::get('/inventory/customer', 'Inventory\CustomerController@index')->name('customer.index');
Route::get('/inventory/customer/create', 'Inventory\CustomerController@create')->name('customer.create');
Route::get('/inventory/customer/edit/{id}', 'Inventory\CustomerController@edit')->name('customer.edit');
Route::get('/inventory/customer/deposit/{id}', 'Inventory\CustomerController@deposit')->name('customer.deposit');
Route::get('/inventory/customer/view/{id}', 'Inventory\CustomerController@view')->name('customer.view');
Route::get('/inventory/customer/invoice/{id}', 'Inventory\CustomerController@invoice')->name('customer.invoice');
Route::get('/inventory/customer/consolidate/{id}/{con_id}', 'Inventory\CustomerController@consolidate')->name('customer.consolidate');
Route::post('/inventory/customer/update', 'Inventory\CustomerController@update')->name('customer.update');
Route::post('/inventory/customer/store', 'Inventory\CustomerController@store')->name('customer.store');
Route::get('/inventory/customer/delete/{id}', 'Inventory\CustomerController@delete_customer')->name('customer.delete');
Route::get('/inventory/customer/downloadExcel/{type}', 'Inventory\CustomerController@downloadExcel');



Route::get('/inventory/unit', 'Inventory\InventoryunitController@index')->name('inventoryunit.index');
Route::get('/inventory/unit/create', 'Inventory\InventoryunitController@create')->name('inventoryunit.create');
Route::get('/inventory/unit/edit/{id}', 'Inventory\InventoryunitController@edit')->name('inventoryunit.edit');
Route::post('/inventory/unit/update', 'Inventory\InventoryunitController@update')->name('inventoryunit.update');
Route::get('/inventory/unit/delete/{id}', 'Inventory\InventoryunitController@delete_unit')->name('inventoryunit.delete');
Route::post('/inventory/unit/store', 'Inventory\InventoryunitController@store')->name('inventoryunit.store');


Route::get('/inventory/category', 'Inventory\InventorycategoryController@index')->name('inventorycategory.index');
Route::get('/inventory/category/create', 'Inventory\InventorycategoryController@create')->name('inventorycategory.create');
Route::get('/inventory/category/edit/{id}', 'Inventory\InventorycategoryController@edit')->name('inventorycategory.edit');
Route::post('/inventory/category/update', 'Inventory\InventorycategoryController@update')->name('inventorycategory.update');
Route::post('/inventory/category/store', 'Inventory\InventorycategoryController@store')->name('inventorycategory.store');
Route::get('/inventory/category/delete/{id}', 'Inventory\InventorycategoryController@delete_cat')->name('inventorycategory.delete');


Route::get('/inventory/prod', 'Inventory\ProdController@index')->name('prod.index');
Route::get('/inventory/prod/create', 'Inventory\ProdController@create')->name('prod.create');
Route::get('/inventory/prod/edit/{id}', 'Inventory\ProdController@edit')->name('prod.edit');
Route::get('/inventory/prod/view/{id}', 'Inventory\ProdController@view')->name('prod.view');
Route::post('/inventory/prod/update', 'Inventory\ProdController@update')->name('prod.update');
Route::post('/inventory/prod/updatemanually', 'Inventory\ProdController@updatemanually')->name('prod.updatemanually');
Route::post('/inventory/prod/store', 'Inventory\ProdController@store')->name('prod.store');
Route::get('/inventory/prod/delete/{id}', 'Inventory\ProdController@delete_prod')->name('prod.delete');
Route::get('/inventory/prod/importExport', 'Inventory\ProdController@importExport');
Route::get('/inventory/prod/downloadExcel/{type}', 'Inventory\ProdController@downloadExcel');
Route::post('/inventory/prod/importExcel', 'Inventory\ProdController@importExcel');
Route::get('/inventory/prod/deleteall', 'Inventory\ProdController@deleteall')->name('inventory.deleteall');


Route::get('/inventory/container', 'Inventory\ContainerController@index')->name('container.index');
Route::get('/inventory/container/create', 'Inventory\ContainerController@create')->name('container.create');
Route::get('/inventory/container/edit/{id}', 'Inventory\ContainerController@edit')->name('container.edit');
Route::post('/inventory/container/update', 'Inventory\ContainerController@update')->name('container.update');
Route::post('/inventory/container/store', 'Inventory\ContainerController@store')->name('container.store');
Route::get('/inventory/container/delete/{id}', 'Inventory\ContainerController@delete_container')->name('container.delete');
Route::get('/inventory/container/addproduct/{id}', 'Inventory\ContainerController@addProduct')->name('container.addproduct');
Route::get('/inventory/container/ajax_cat_prod/{id}', 'Inventory\ContainerController@ajax_cat_prod')->name('container.ajax_cat_prod');
Route::post('/inventory/container/product/store', 'Inventory\ContainerController@storeProduct')->name('product.store');
Route::get('/inventory/container/detail', 'Inventory\ContainerController@detaillist')->name('detail.index');
Route::get('/inventory/container/detail/create', 'Inventory\ContainerController@detailcreate')->name('detail.create');
Route::get('/inventory/container/detail/edit/{id}', 'Inventory\ContainerController@detailedit')->name('detail.edit');
Route::post('/inventory/container/detail/store', 'Inventory\ContainerController@detailstore')->name('detail.store');
Route::post('/inventory/container/detail/update', 'Inventory\ContainerController@detailupdate')->name('detail.update');
Route::get('/inventory/container/detail/delete/{id}', 'Inventory\ContainerController@detaildelete')->name('detail.delete');
Route::get('/inventory/container/downloadExcel/{type}', 'Inventory\ContainerController@downloadExcel')->name('container.download');;


Route::get('/inventory/container/type', 'Inventory\ContainerController@type')->name('type.index');
Route::get('/inventory/container/type/create', 'Inventory\ContainerController@typecreate')->name('type.create');
Route::get('/inventory/container/type/edit/{id}', 'Inventory\ContainerController@typeedit')->name('type.edit');
Route::post('/inventory/container/type/store', 'Inventory\ContainerController@typestore')->name('type.store');
Route::post('/inventory/container/type/update', 'Inventory\ContainerController@typeupdate')->name('type.update');
Route::get('/inventory/container/type/delete/{id}', 'Inventory\ContainerController@typedelete')->name('type.delete');


Route::get('/inventory/container/batch', 'Inventory\ContainerController@batch')->name('batch.index');
Route::get('/inventory/container/batch/create', 'Inventory\ContainerController@batchcreate')->name('batch.create');
Route::get('/inventory/container/batch/edit/{id}', 'Inventory\ContainerController@batchedit')->name('batch.edit');
Route::get('/inventory/container/batch/view/{id}', 'Inventory\ContainerController@batchview')->name('batch.view');
Route::post('/inventory/container/batch/update', 'Inventory\ContainerController@batchupdate')->name('batch.update');
Route::post('/inventory/container/batch/store', 'Inventory\ContainerController@batchstore')->name('batch.store');
Route::get('/inventory/container/batch/delete/{id}', 'Inventory\ContainerController@batchdelete')->name('batch.delete');
Route::get('/inventory/container/batch/addProductbatch/{batchid}', 'Inventory\ContainerController@addProductbatch')->name('batch.addProductbatch');
Route::post('/inventory/container/batch/product/store', 'Inventory\ContainerController@batchproduct')->name('batchproduct.store');
Route::get('/inventory/container/ajax_mark/{id}', 'Inventory\ContainerController@batchajax_mark')->name('batch.ajax_mark');


Route::get('/inventory/supplier', 'Inventory\SupplierController@index')->name('supplier.index');
Route::get('/inventory/supplier/create', 'Inventory\SupplierController@create')->name('supplier.create');
Route::post('/inventory/supplier/store', 'Inventory\SupplierController@store')->name('supplier.store');
Route::get('/inventory/supplier/edit/{id}', 'Inventory\SupplierController@edit')->name('supplier.edit');
Route::post('/inventory/supplier/update', 'Inventory\SupplierController@update')->name('supplier.update');
Route::get('/inventory/supplier/delete/{id}', 'Inventory\SupplierController@delete')->name('supplier.delete');


Route::get('/inventory/shipper', 'Inventory\ShipperController@index')->name('shipper.index');
Route::get('/inventory/shipper/create', 'Inventory\ShipperController@create')->name('shipper.create');
Route::post('/inventory/shipper/store', 'Inventory\ShipperController@store')->name('shipper.store');
Route::get('/inventory/shipper/edit/{id}', 'Inventory\ShipperController@edit')->name('shipper.edit');
Route::post('/inventory/shipper/update', 'Inventory\ShipperController@update')->name('shipper.update');
Route::get('/inventory/shipper/delete/{id}', 'Inventory\ShipperController@delete')->name('shipper.delete');

Route::get('/inventory/consignee', 'Inventory\ConsigneeController@index')->name('consignee.index');
Route::get('/inventory/consignee/create', 'Inventory\ConsigneeController@create')->name('consignee.create');
Route::post('/inventory/consignee/store', 'Inventory\ConsigneeController@store')->name('consignee.store');
Route::get('/inventory/consignee/edit/{id}', 'Inventory\ConsigneeController@edit')->name('consignee.edit');
Route::post('/inventory/consignee/update', 'Inventory\ConsigneeController@update')->name('consignee.update');
Route::get('/inventory/consignee/delete/{id}', 'Inventory\ConsigneeController@delete')->name('consignee.delete');


Route::get('/inventory/purchase', 'Inventory\PurchaseController@index')->name('purchase.index');
Route::get('/inventory/purchase/create', 'Inventory\PurchaseController@create')->name('purchase.create');
Route::post('/inventory/purchase/store', 'Inventory\PurchaseController@store')->name('purchase.store');
Route::get('/inventory/purchase/edit/{id}', 'Inventory\PurchaseController@edit')->name('purchase.edit');
Route::get('/inventory/purchase/view/{id}', 'Inventory\PurchaseController@view')->name('purchase.view');
Route::post('/inventory/purchase/update', 'Inventory\PurchaseController@update')->name('purchase.update');
Route::get('/inventory/purchase/delete/{id}', 'Inventory\PurchaseController@delete')->name('purchase.delete');
Route::get('/inventory/purchase/ajax_cat_prod/{id}', 'Inventory\PurchaseController@ajax_cat_prod')->name('purchase.ajax_cat_prod');
Route::get('/inventory/purchase/ajax_prod/{id}', 'Inventory\PurchaseController@ajax_prod')->name('purchase.ajax_prod');
