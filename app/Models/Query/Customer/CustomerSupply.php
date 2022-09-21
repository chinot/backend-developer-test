<?php
namespace App\Models\Query\Customer;  
  
use Illuminate\Database\Eloquent\Model;  
use Illuminate\Database\Eloquent\Factories\HasFactory;  
use App\Models\Query\Customer\Customer;
use App\Models\Query\Supply\Supply;

class CustomerSupply extends Model
{
    use HasFactory;

    public const CREATED_AT = 'createdOn';
    public const UPDATED_AT = 'updatedOn';
    public const TABLE_NAME = 'customer_supplies';
    public const PRIMARY_KEY = 'recordNumber';

    protected $fillable = ['id', 'customerId', 'supplyId', 'quantity'];
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
     * Find CustomerSupply by ID
     * @param $id string
     * @return CustomerSupply
     */
    public static function getCustomerSupply(string $id)
    {
        return self::where('id', '=', $id)->firstOrFail();
    }


    /**
     * Create a new customer
     * @param $customerDetails
     * @return CustomerSupply
     */
    public static function createCustomerSupply(array $customerDetails)
    {
        return self::create($customerDetails);
    }

    /**
     * Updates customer
     * @param $customerId string
     * @param $customerDetails array
     * @return CustomerSupply
     */
    public static function updateCustomerSupply(string $customerSupplyId, array $customerSupplyDetails)
    {
        $customerSupply = self::where('id', '=', $customerSupplyId)->firstOrFail();
        $customerSupply->update($customerSupplyDetails);

        return $customerSupply;
    }

    public function customers()
    {
        return $this->belongsTo(Customer::class, 'customerId', 'id');
    }

    public function supplies()
    {
        return $this->belongsTo(Supply::class, 'supplyId', 'id');
    }
}
