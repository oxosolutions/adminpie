<?php

    Route::get('/products',             ['as'=>'list.products',     'uses'=>'ProductsController@index']);
    Route::get('/product/delete/{id}',  ['as'=>'delete.products',   'uses'=>'ProductsController@delete']);
    Route::get('/product/create',       ['as'=>'create.product',    'uses'=>'ProductsController@create']);
    Route::post('/product/save',        ['as'=>'save.product',      'uses'=>'ProductsController@save']);
    Route::get('/product/edit/{id}',    ['as'=>'edit.product',      'uses'=>'ProductsController@edit']);
    Route::post('/product/update/{id}', ['as'=>'update.product',    'uses'=>'ProductsController@update']);

    Route::get('clients',               ['as'=>'list.client',   'uses'=>'ClientController@listClients']);
    Route::get('client/create',         ['as'=>'create.client', 'uses'=>'ClientController@create']);
    Route::post('client/save',          ['as'=>'save.client',   'uses'=>'ClientController@save']);
    Route::get('client/view/{id}',      ['as'=>'view.client',   'uses'=>'ClientController@view']);
    Route::get('client/edit/{id}',      ['as'=>'edit.client',   'uses'=>'ClientController@edit']);
    Route::post('client/update/{id}',   ['as'=>'update.client', 'uses'=>'ClientController@update']);
    Route::get('client/delete/{id}',    ['as'=>'delete.client', 'uses'=>'ClientController@delete']);
    
    Route::get('contacts',              ['as'=>'contact.list',      'uses'=>'ContactController@index']);
    Route::get('contact/add',           ['as'=>'contact.add',       'uses'=>'ContactController@add']);
    Route::post('contacts/save',        ['as'=>'contact.save',      'uses'=>'ContactController@saveContact']);
    Route::get('contact/edit/{id}',     ['as'=>'contact.edit',      'uses'=>'ContactController@edit']);
    Route::post('contact/update/{id}',  ['as'=>'contact.update',    'uses'=>'ContactController@update']);
    Route::get('contact/delete/{id}',   ['as'=>'delete.contact',    'uses'=>'ContactController@delete']);
    
    //Services
    Route::get('/services',             ['as'=>'list.services',         'uses'=>'ServicesController@index']);
    Route::get('/service/add',          ['as'=>'add.service',           'uses'=>'ServicesController@add']);
    Route::match(['get','post'],'/service/save',['as'=>'save.service',  'uses'=>'ServicesController@create']);
    Route::get('/service/delete/{id}',['as'=>'delete.service',          'uses'=>'ServicesController@delete']);

    Route::match(['get','post'],'/service/price/{id?}',['as'=>'price.service','uses'=>'ServicesController@prices']);
    Route::get('delete/service/price/{id?}',['as'=>'delete.price.service','uses'=>'ServicesController@delete_pricing']);

    //customer
    Route::get('/customer',['as'=>'list.customer','uses'=>'CustomerController@index']);
    //Invoice
    Route::get('/invoices',['as'=>'list.invoice','uses'=>'BillingController@index']);
    //billing
    Route::get('/billings',['as'=>'list.billing','uses'=>'BillingController@billing']);
    //products
   

    Route::match(['get','post'],'/product/price/{id?}',['as'=>'price.products','uses'=>'ProductsController@prices']);
    Route::get('delete/product/price/{id?}',['as'=>'delete.price.products','uses'=>'ProductsController@delete_pricing']);
    //Category price.products
    Route::get('product/category',      ['as'=>'list.product.category','uses'=>'CategoryController@product_category_listing']);
    Route::get('product/category/add',  ['as'=>'add.product.category','uses'=>'CategoryController@product_category_add']);
    Route::post('/category/save',['as'=>'save.crm.category','uses'=>'CategoryController@save_category']);
    Route::get('/category/delete/{id}',['as'=>'delete.crm.category','uses'=>'CategoryController@delete']);
    //service category
    Route::get('/service/category',     ['as'=>'list.service.category',     'uses'=>'CategoryController@service_category_listing']);
    Route::get('/service/category/add', ['as'=>'add.service.category',      'uses'=>'CategoryController@service_category_add']);


    //Leads
    Route::get('/leads',['as'=>'leads','uses'=>'LeadsController@index']);
    //sales
    Route::get('/sales',['as'=>'sales','uses'=>'SalesController@index']);
    //pricing
    Route::get('/pricing',['as'=>'pricing','uses'=>'BillingController@pricing']);
    //pricing
    Route::get('/payment-methods',      ['as'=>'payment-methods',   'uses'=>'PaymentMethodController@index']);
    Route::get('/payment-method/add',   ['as'=>'payment-method.add','uses'=>'PaymentMethodController@add']);
    Route::post('/payment-method/save', ['as'=>'save.payment.method','uses'=>'PaymentMethodController@create']);
    Route::get('/payment-method/delete/{id}',['as'=>'delete.payment.method','uses'=>'PaymentMethodController@delete']);
?>