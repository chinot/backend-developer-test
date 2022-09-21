<?php
namespace App\Models\Query\Customer;  
  
use Illuminate\Database\Eloquent\Model;  
use Illuminate\Database\Eloquent\Factories\HasFactory;  

class Customer extends Model
{
    use HasFactory;

    public const CREATED_AT = 'createdOn';
    public const UPDATED_AT = 'updatedOn';
    public const TABLE_NAME = 'customers';
    public const PRIMARY_KEY = 'recordNumber';

    protected $fillable = ['id', 'name', 'gender', 'age', 'status'];
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'createdOn',
        'updatedOn'
    ];
    /**
     * @var string
     */
    protected $table = self::TABLE_NAME;

    /**
     * @var string
     */
    protected $primaryKey = self::PRIMARY_KEY;

    /**
     * @return string
     */
    public function getDateFormat(): string
    {
        return 'U';
    }

    /**
     * Find Customer by ID
     * @param $id string
     * @return Customer
     */
    public static function getCustomer(string $id)
    {
        return self::where('id', '=', $id)->firstOrFail();
    }

    /**
     * Customer supply Relation
     */
    public function customerSupply()
    {
       return $this->hasMany(CustomerSupply::class, 'customerId', 'id');
    }


    /**
     * Create a new customer
     * @param $customerDetails
     * @return Customer
     */
    public static function createCustomer(array $customerDetails)
    {
        return self::create($customerDetails);
    }

    /**
     * Updates customer
     * @param $customerId string
     * @param $customerDetails array
     * @return Customer
     */
    public static function updateCustomer(string $customerId, array $customerDetails)
    {
        $customer = self::where('id', '=', $customerId)->firstOrFail();
        $customer->update($customerDetails);

        return $customer;
    }
}
