
Note: Not in README format


Build Knit API docker images.

docker-compose build



Install Knit API PHP library dependencies.

docker-compose run composer install


Install Knit API NodeJS optional dependencies.

docker-compose run npm install



Start laravel api containers as a daemons. It will automatically start once your computer fully boots.

docker-compose up -d laravel-api



Create database and seed it with initial records.

docker-compose run php artisan migrate:fresh  




list supplies
Route::get('/supplies', [SupplyController::class, 'index']);

save supply for trading
Route::post('/supplies', [SupplyController::class, 'store']);
params:
supply # string name 
points # number 

get supply values
Route::get('/supplies/{supplyId}', [SupplyController::class, 'show']);

update supply values
Route::put('/supplies/{supplyId}', [SupplyController::class, 'update']);
params:
supply # string name 
points # number 

Route::get('/customers', [CustomerController::class, 'index']);

Route::post('/customers', [CustomerController::class, 'store']);
params:
name # string name 
gender # string 
age # nubmber
status # 0/1 

Route::get('/customers/{customerId}', [CustomerController::class, 'show']);
Route::put('/customers/{customerId}', [CustomerController::class, 'update']);
params:
name # string name 
gender # string 
age # nubmber
status # 0/1 


Route::get('/customer-supplies/{customerId}', [CustomerSupplyController::class, 'show']);
Route::post('/customer-supplies', [CustomerSupplyController::class, 'store']);
params:
supplyId # id column from supplies table
customerId # id column from customers table
quantiry # nubmber of avaible supply
 
Route::put('/supplies/{customerSupplyId}', [CustomerSupplyController::class, 'update']);
params:
quantiry # nubmber of avaible supply

Route::post('/trade-supplies', [SupplyTradeController::class, 'trade']);
params:
totalSupplyToTrade #number
traderSupplyId # id colunm of table customer_supplies
buyerSupplyId # id colunm of table customer_supplies
