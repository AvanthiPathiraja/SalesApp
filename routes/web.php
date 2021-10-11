<?php

use Livewire\Livewire;
use App\Models\Invoice;
use App\Models\Product;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StockController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\InvoiceItemController;
use App\Http\Controllers\DistributorStockController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');


Route::get('customers', \App\Http\Livewire\customer\index::class)->name('customer.index');
Route::get('customer/create', \App\Http\Livewire\customer\create::class)->name('customer.create');
Route::get('customers/{customer}/edit', \App\Http\Livewire\customer\create::class)->name('customer.edit');

Route::get('employees', \App\Http\Livewire\employee\index::class)->name('employee.index');
Route::get('employee/create', \App\Http\Livewire\employee\create::class)->name('employee.create');
Route::get('employees/{employee}/edit', \App\Http\Livewire\employee\create::class)->name('employee.edit');

Route::get('product', \App\Http\Livewire\product\index::class)->name('product.index');
Route::get('product/create', \App\Http\Livewire\product\create::class)->name('product.create');
Route::get('products/{product}/edit', \App\Http\Livewire\product\create::class)->name('product.edit');

Route::get('stocks', \App\Http\Livewire\stock\index::class)->name('stock.index');
Route::get('stock/create', \App\Http\Livewire\stock\create::class)->name('stock.create');
Route::get('stocks/{stock}/edit', \App\Http\Livewire\stock\Create::class)->name('stock.edit');

Route::get('issue-notes', \App\Http\Livewire\IssueNote\Index::class)->name('issue-note.index');
Route::get('issue-note/create', \App\Http\Livewire\IssueNote\Create::class)->name('issue-note.create');
Route::get('issue-notes/{issue_note}/edit', \App\Http\Livewire\IssueNote\create::class)->name('issue-note.edit');

Route::get('invoices', \App\Http\Livewire\Invoice\Index::class)->name('invoice.index');
Route::get('invoice/create', \App\Http\Livewire\Invoice\Create::class)->name('invoice.create');
Route::get('invoices/{invoice}/edit', \App\Http\Livewire\Invoice\Create::class)->name('invoice.edit');

Route::get('invoice/payments', \App\Http\Livewire\InvoicePayment\Index::class)->name('invoice-payment.index');
Route::get('invoice/payment/create', \App\Http\Livewire\InvoicePayment\Create::class)->name('invoice-payment.create');
Route::get('invoice/payments/{invoice_payment}/edit', \App\Http\Livewire\InvoicePayment\Create::class)->name('invoice-payment.edit');

Route::get('invoice/returns', \App\Http\Livewire\InvoiceReturn\Index::class)->name('invoice-return.index');
Route::get('invoice/return/create', \App\Http\Livewire\InvoiceReturn\Create::class)->name('invoice-return.create');
Route::get('invoice/returns/{invoice_return}/edit', \App\Http\Livewire\InvoiceReturn\Create::class)->name('invoice-return.edit');

Route::get('issue/returns', \App\Http\Livewire\IssueReturn\Index::class)->name('issue-return.index');
Route::get('issue/return/create', \App\Http\Livewire\IssueReturn\Create::class)->name('issue-return.create');
Route::get('issue/returns/{issue_return}/edit', \App\Http\Livewire\IssueReturn\Create::class)->name('issue-return.edit');

Route::get('discarded/stocks', \App\Http\Livewire\Discardedstock\Index::class)->name('discarded-stock.index');
Route::get('discarded/stock/create', \App\Http\Livewire\Discardedstock\Create::class)->name('discarded-stock.create');
Route::get('discarded/stocks/{discarded_stock}/edit', \App\Http\Livewire\Discardedstock\Create::class)->name('discarded-stock.edit');

Route::get('routes', \App\Http\Livewire\Route\Index::class)->name('route.index');
Route::get('route/create', \App\Http\Livewire\Route\Create::class)->name('route.create');
Route::get('routes/{route}/edit', \App\Http\Livewire\Route\Create::class)->name('route.edit');
