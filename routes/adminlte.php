<?php

/*
|--------------------------------------------------------------------------
| Adminlte Routes
|--------------------------------------------------------------------------
|
| Here is where you can register adminlte web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::prefix('adminlte')->group(function () {
    Route::any('/index', 'Adminlte\IndexController@index')->name('adminlte.index');
    Route::get('/index2', 'Adminlte\IndexController@index2')->name('adminlte.index2');
    Route::any('/index3', 'Adminlte\IndexController@index3')->name('adminlte.index3');
    Route::get('/starter', 'Adminlte\IndexController@starter')->name('adminlte.starter');

    Route::get('/pages/charts/chartjs', 'Adminlte\Pages\ChartsController@chartjs')->name('adminlte.pages.charts.chartjs');
    Route::get('/pages/charts/flot', 'Adminlte\Pages\ChartsController@flot')->name('adminlte.pages.charts.flot');
    Route::get('/pages/charts/inline', 'Adminlte\Pages\ChartsController@inline')->name('adminlte.pages.charts.inline');

    Route::get('/pages/examples/example404', 'Adminlte\Pages\ExamplesController@example404')->name('adminlte.pages.examples.example404');
    Route::get('/pages/examples/example500', 'Adminlte\Pages\ExamplesController@example500')->name('adminlte.pages.examples.example500');
    Route::get('/pages/examples/blank', 'Adminlte\Pages\ExamplesController@blank')->name('adminlte.pages.examples.blank');
    Route::get('/pages/examples/contacts', 'Adminlte\Pages\ExamplesController@contacts')->name('adminlte.pages.examples.contacts');
    Route::get('/pages/examples/eCommerce', 'Adminlte\Pages\ExamplesController@eCommerce')->name('adminlte.pages.examples.eCommerce');
    Route::get('/pages/examples/forgotPassword', 'Adminlte\Pages\ExamplesController@forgotPassword')->name('adminlte.pages.examples.forgotPassword');
    Route::get('/pages/examples/invoicePrint', 'Adminlte\Pages\ExamplesController@invoicePrint')->name('adminlte.pages.examples.invoicePrint');
    Route::get('/pages/examples/invoice', 'Adminlte\Pages\ExamplesController@invoice')->name('adminlte.pages.examples.invoice');
    Route::get('/pages/examples/languageMenu', 'Adminlte\Pages\ExamplesController@languageMenu')->name('adminlte.pages.examples.languageMenu');
    Route::get('/pages/examples/legacyUserMenu', 'Adminlte\Pages\ExamplesController@legacyUserMenu')->name('adminlte.pages.examples.legacyUserMenu');
    Route::get('/pages/examples/lockscreen', 'Adminlte\Pages\ExamplesController@lockscreen')->name('adminlte.pages.examples.lockscreen');
    Route::any('/pages/examples/login', 'Adminlte\Pages\ExamplesController@login')->name('adminlte.pages.examples.login');
    Route::get('/pages/examples/pace', 'Adminlte\Pages\ExamplesController@pace')->name('adminlte.pages.examples.pace');
    Route::get('/pages/examples/profile', 'Adminlte\Pages\ExamplesController@profile')->name('adminlte.pages.examples.profile');
    Route::get('/pages/examples/projectAdd', 'Adminlte\Pages\ExamplesController@projectAdd')->name('adminlte.pages.examples.projectAdd');
    Route::get('/pages/examples/projectDetail', 'Adminlte\Pages\ExamplesController@projectDetail')->name('adminlte.pages.examples.projectDetail');
    Route::get('/pages/examples/projectEdit', 'Adminlte\Pages\ExamplesController@projectEdit')->name('adminlte.pages.examples.projectEdit');
    Route::get('/pages/examples/projects', 'Adminlte\Pages\ExamplesController@projects')->name('adminlte.pages.examples.projects');
    Route::any('/pages/examples/recoverPassword', 'Adminlte\Pages\ExamplesController@recoverPassword')->name('adminlte.pages.examples.recoverPassword');
    Route::get('/pages/examples/register', 'Adminlte\Pages\ExamplesController@register')->name('adminlte.pages.examples.register');

    Route::get('/pages/forms/advanced', 'Adminlte\Pages\FormsController@advanced')->name('adminlte.pages.forms.advanced');
    Route::get('/pages/forms/editors', 'Adminlte\Pages\FormsController@editors')->name('adminlte.pages.forms.editors');
    Route::get('/pages/forms/general', 'Adminlte\Pages\FormsController@general')->name('adminlte.pages.forms.general');
    Route::get('/pages/forms/validation', 'Adminlte\Pages\FormsController@validation')->name('adminlte.pages.forms.validation');

    Route::get('/pages/calendar', 'Adminlte\Pages\IndexController@calendar')->name('adminlte.pages.calendar');
    Route::get('/pages/gallery', 'Adminlte\Pages\IndexController@gallery')->name('adminlte.pages.gallery');
    Route::get('/pages/widgets', 'Adminlte\Pages\IndexController@widgets')->name('adminlte.pages.widgets');

    Route::get('/pages/layout/boxed', 'Adminlte\Pages\LayoutController@boxed')->name('adminlte.pages.layout.boxed');
    Route::get('/pages/layout/collapsedSidebar', 'Adminlte\Pages\LayoutController@collapsedSidebar')->name('adminlte.pages.layout.collapsedSidebar');
    Route::get('/pages/layout/fixedFooter', 'Adminlte\Pages\LayoutController@fixedFooter')->name('adminlte.pages.layout.fixedFooter');
    Route::get('/pages/layout/fixedSidebar', 'Adminlte\Pages\LayoutController@fixedSidebar')->name('adminlte.pages.layout.fixedSidebar');
    Route::get('/pages/layout/fixedTopnav', 'Adminlte\Pages\LayoutController@fixedTopnav')->name('adminlte.pages.layout.fixedTopnav');
    Route::get('/pages/layout/topNavSidebar', 'Adminlte\Pages\LayoutController@topNavSidebar')->name('adminlte.pages.layout.topNavSidebar');
    Route::get('/pages/layout/topNav', 'Adminlte\Pages\LayoutController@topNav')->name('adminlte.pages.layout.topNav');

    Route::get('/pages/mailbox/compose', 'Adminlte\Pages\MailboxController@compose')->name('adminlte.pages.mailbox.compose');
    Route::get('/pages/mailbox/mailbox', 'Adminlte\Pages\MailboxController@mailbox')->name('adminlte.pages.mailbox.mailbox');
    Route::get('/pages/mailbox/readMail', 'Adminlte\Pages\MailboxController@readMail')->name('adminlte.pages.mailbox.readMail');

    Route::get('/pages/tables/data', 'Adminlte\Pages\TablesController@data')->name('adminlte.pages.tables.data');
    Route::get('/pages/tables/jsgrid', 'Adminlte\Pages\TablesController@jsgrid')->name('adminlte.pages.tables.jsgrid');
    Route::get('/pages/tables/simple', 'Adminlte\Pages\TablesController@simple')->name('adminlte.pages.tables.simple');

    Route::get('/pages/UI/buttons', 'Adminlte\Pages\UIController@buttons')->name('adminlte.pages.UI.buttons');
    Route::get('/pages/UI/general', 'Adminlte\Pages\UIController@general')->name('adminlte.pages.UI.general');
    Route::get('/pages/UI/icons', 'Adminlte\Pages\UIController@icons')->name('adminlte.pages.UI.icons');
    Route::get('/pages/UI/modals', 'Adminlte\Pages\UIController@modals')->name('adminlte.pages.UI.modals');
    Route::get('/pages/UI/navbar', 'Adminlte\Pages\UIController@navbar')->name('adminlte.pages.UI.navbar');
    Route::get('/pages/UI/ribbons', 'Adminlte\Pages\UIController@ribbons')->name('adminlte.pages.UI.ribbons');
    Route::get('/pages/UI/sliders', 'Adminlte\Pages\UIController@sliders')->name('adminlte.pages.UI.sliders');
    Route::get('/pages/UI/timeline', 'Adminlte\Pages\UIController@timeline')->name('adminlte.pages.UI.timeline');
});
