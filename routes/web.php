<?php

use App\Http\Controllers\Event\EventDataController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\EventController;
use Illuminate\Foundation\Http\Middleware\HandlePrecognitiveRequests as Precognition;
use App\Http\Controllers\Event\EventGraphicMaterialController;
use App\Http\Controllers\Event\EventInscriptionController;
use App\Http\Controllers\Event\EventKitController;
use App\Http\Controllers\Event\EventLocationController;
use App\Http\Controllers\Event\EventLogoController;
use App\Http\Controllers\Event\EventLotController;
use App\Http\Controllers\Event\EventProductController;
use App\Http\Controllers\Event\EventRouteController;
use App\Http\Controllers\Event\PaymentMethodsController;
use App\Http\Controllers\Event\ValuesController;
use App\Http\Controllers\TestController;
use App\Models\EventKit;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('events', [EventController::class, 'index'])->name('events');
    Route::get('event/create', [EventController::class, 'create'])->name('event.create');
    Route::get('event/view', [EventController::class, 'view'])->name('event.view');
    // Route::post('event/save', [EventController::class, 'eventSave'])->name('event.save')->middleware(Precognition::class);
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
});

Route::middleware(['auth'])->group(function () {

    Route::get('evento/{id}', [EventController::class, 'event'])->name('event');
    Route::get('events', [EventController::class, 'index'])->name('events');
    Route::get('event/create', [EventController::class, 'create'])->name('event.create');

    // dados do evento
    Route::post('event/save/{id?}', [EventDataController::class, 'save'])->name('event.data.save')->middleware(Precognition::class);
    Route::post('event/regulation/upload/{id?}', [EventDataController::class, 'regulationUpload'])->name('event.regulation.upload');
    Route::post('event/regulation/delete/{id}', [EventDataController::class, 'regulationDelete'])->name('event.regulation.delete');

    //localização do evento
    Route::post('event/location/save/{id}', [EventLocationController::class, 'save'])->name('event.location.save')->middleware(Precognition::class);

    // materias gráficos do evento
    // Route::post('event/graphic-materials/save/{id}', [EventController::class, 'eventGraphicMaterialsSave'])->name('event.graphic.materials.save')->middleware(Precognition::class);
    Route::post('event/materials/upload/{id?}', [EventGraphicMaterialController::class, 'materialsUpload'])->name('event.materials.upload');
    Route::post('event/materials/delete/{id}', [EventGraphicMaterialController::class, 'materialsDelete'])->name('event.materials.delete');

    // logos do evento
    Route::put('/photo/move/{id}', [EventLogoController::class, 'photoMove'])->name('photo.move');
    Route::post('/logo/delete/{id}', [EventLogoController::class, 'logoDelete'])->name('event.logo.delete');
    Route::post('/row/delete/{id}', [EventLogoController::class, 'rowDelete'])->name('event.row.delete');
    Route::post('/drag/move/mobile/{id}', [EventLogoController::class, 'dragMoveMobile'])->name('drag.move.mobile');
    Route::put('/drag/move/{id}', [EventLogoController::class, 'dragMove'])->name('drag.move');
    Route::post('event/logo/save/{id}', [EventLogoController::class, 'save'])->name('event.logo.save');
    Route::post('event/row/logo/save/{id}', [EventLogoController::class, 'saveLogoInRow'])->name('event.row.logo.save');

    //inscrições do evento
    Route::put('event/inscription/order/{id}', [EventInscriptionController::class, 'order'])->name('event.inscription.order');
    Route::put('event/inscription/order/mobile/{id}', [EventInscriptionController::class, 'orderMobile'])->name('event.inscription.order.mobile');

    Route::post('event/inscription/create/{id}', [EventInscriptionController::class, 'create'])->name('event.inscription.create');
    Route::delete('event/inscription/delete/{id}', [EventInscriptionController::class, 'delete'])->name('event.inscription.delete');
    Route::post('event/inscription/duplicate/{id}', [EventInscriptionController::class, 'duplicate'])->name('event.inscription.duplicate');
    Route::post('event/inscription/edit/{id}', [EventInscriptionController::class, 'edit'])->name('event.inscription.edit');

    //lotes do evento
    Route::post('event/lot/create/{id}', [EventLotController::class, 'create'])->name('event.lot.create');
    Route::post('event/lot/edit/{id}', [EventLotController::class, 'edit'])->name('event.lot.edit');
    Route::delete('event/lot/delete/{id}', [EventLotController::class, 'delete'])->name('event.lot.delete');

    //percursos do evento
    Route::post('event/route/create/{id}', [EventRouteController::class, 'create'])->name('event.route.create');
    Route::delete('event/route/delete/image/{id}', [EventRouteController::class, 'deleteImage'])->name('event.route.delete.image');
    Route::post('event/route/update/image/{id}', [EventRouteController::class, 'updateImage'])->name('event.route.update.image');
    Route::delete('event/route/reset/fields/{id}', [EventRouteController::class, 'resetFields'])->name('event.route.reset.fields');
    Route::put('event/route/edit/{id}', [EventRouteController::class, 'edit'])->name('event.route.edit');
    Route::delete('event/route/delete/{id}', [EventRouteController::class, 'delete'])->name('event.route.delete');

    //kits do evento
    Route::put('event/kit/{id}', [EventKitController::class, 'have'])->name('event.has.products.and.kits');
    Route::post('event/kit/create/{id}', [EventKitController::class, 'create'])->name('event.kit.create');
    Route::delete('event/kit/delete/image/{id}', [EventKitController::class, 'deleteImage'])->name('event.kit.delete.image');
    Route::post('event/kit/update/image/{id}', [EventKitController::class, 'updateImage'])->name('event.kit.update.image');
    Route::put('event/kit/edit/{id}', [EventKitController::class, 'edit'])->name('event.kit.edit');
    Route::delete('event/kit/delete/{id}', [EventKitController::class, 'delete'])->name('event.kit.delete');
    Route::post('event/kit/duplicate/{id}', [EventKitController::class, 'duplicate'])->name('event.kit.duplicate');

    Route::post('event/kit/relation/products/{id}', [EventKitController::class, 'relationProducts'])->name('event.kit.relation.products.create');
    Route::post('event/remove/product/from/kit/{id}', [EventKitController::class, 'removeProduct'])->name('event.remove.product.from.kit');
    

    //produtos do evento
    Route::post('event/product/create/{id}', [EventProductController::class, 'create'])->name('event.product.create');
    Route::delete('event/product/delete/{id}', [EventProductController::class, 'delete'])->name('event.product.delete');
    Route::put('event/product/update/{id}', [EventProductController::class, 'update'])->name('event.product.update');
    Route::delete('event/variation/delete/{id}', [EventProductController::class, 'deleteVariation'])->name('event.variation.delete');
    Route::post('event/extra/product/create/{id}', [EventProductController::class, 'extraProductCreate'])->name('event.extra.product.create');
    Route::put('event/extra/product/edit/{id}', [EventProductController::class, 'extraProductEdit'])->name('event.extra.product.edit');
    Route::post('event/product/without/kit/duplicate/{id?}', [EventProductController::class, 'productWithoutKitDuplicate'])->name('event.product.without.kit.duplicate');
    Route::delete('event/product/without/kit/delete/{id}', [EventProductController::class, 'productWithoutKitDelete'])->name('event.product.without.kit.delete');
    Route::post('event/product/variation/create/{id}', [EventProductController::class, 'productVariationCreate'])->name('event.product.variation.create');
    Route::put('event/product/variation/update/{id}', [EventProductController::class, 'productVariationUpdate'])->name('event.product.variation.update');
    Route::post('event/extra/product/variation/create/{id}', [EventProductController::class, 'extraProductVariationCreate'])->name('event.extra.product.variation.create');
    Route::put('event/extra/product/variation/update/{id}', [EventProductController::class, 'extraProductVariationUpdate'])->name('event.extra.product.variation.update');
    Route::delete('event/extra/product/variation/delete/{id}', [EventProductController::class, 'extraProductVariationDelete'])->name('event.extra.product.variation.delete');
    Route::post('event/product/duplicate/{id}', [EventProductController::class, 'productDuplicate'])->name('event.product.duplicate');

    Route::put('event/product/quantity/update/{id}', [EventProductController::class, 'productQuantityUpdate'])->name('event.product.quantity.update');

    //quantidade de produtos por inscrição:
    Route::put('event/kit/inscription/order/{id}', [EventKitController::class, 'order'])->name('event.kit.inscription.order');

    //valores
    Route::post('event/add/with/kit/{id}', [ValuesController::class, 'addWithKit'])->name('event.add.with.kit');
    Route::post('event/add/without/kit/{id}', [ValuesController::class, 'addWithoutKit'])->name('event.add.without.kit');
    Route::delete('event/kit/lot/delete/{id}', [ValuesController::class, 'kitLotDelete'])->name('event.kit.lot.delete');
    Route::put('event/kit/lot/update/{id}', [ValuesController::class, 'kitLotUpdate'])->name('event.kit.lot.update');

    //Formas de pagamento
    Route::post('event/payment/methods/{id}', [PaymentMethodsController::class, 'storePaymentMethods'])->name('event.payment.methods');


    //zzz
    // Route::post('event/graphic-materials/save/{id}', [EventGraphicMaterialController::class, 'eventGraphicMaterialsSave'])->name('event.graphic.materials.save');


    Route::view('/inscriptions', 'pages.inscriptions')->name('inscriptions');
    Route::view('/administrative', 'pages.administrative')->name('administrative');
    Route::view('/panel', 'pages.panel')->name('panel');
});

Route::get('/terms', [TermsController::class, 'show'])->name('terms.show');
Route::get('/privacy-policy', [PolicyController::class, 'show'])->name('policy.show');
