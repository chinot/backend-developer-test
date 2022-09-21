<?php
namespace App\Models\Query\Supply;  
  
use Illuminate\Database\Eloquent\Model;  
use Illuminate\Database\Eloquent\Factories\HasFactory;  

class Supply extends Model
{
    use HasFactory;

    public const CREATED_AT = 'createdOn';
    public const UPDATED_AT = 'updatedOn';
    public const TABLE_NAME = 'supplies';
    public const PRIMARY_KEY = 'recordNumber';

    protected $fillable = ['id', 'supply', 'points'];
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
     * Find Supply by ID
     * @param $id string
     * @return Supply
     */
    public static function getSupply(string $id)
    {
        return self::where('id', '=', $id)->firstOrFail();
    }

    /**
     * Lists all supplies
     * @return Supply
     */
    public static function listSupplies()
    {
        return self::where('belongsTo', 'CompanyA')->paginate(10);
    }

    /**
     * Create a new supply
     * @param $supplyDetails
     * @return Supply
     */
    public static function createSupply(array $supplyDetails)
    {
        return self::create($supplyDetails);
    }

    /**
     * Updates supply
     * @param $supplyId string
     * @param $supplyDetails array
     * @return Supply
     */
    public static function updateSupply(string $supplyId, array $supplyDetails)
    {
        $supply = self::where('id', '=', $supplyId)->firstOrFail();
        $supply->update($supplyDetails);

        return $supply;
    }
}
