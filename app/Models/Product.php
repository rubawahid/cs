<?php

namespace App\Models;
use Attribute;
use Illuminate\Contracts\Database\Query\Builder as QueryBuilder;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Query\Builder as DatabaseQueryBuilder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use NumberFormatter;
use PhpParser\Node\Stmt\Static_;

class category extends Model
{
    use HasFactory, SoftDeletes;

    const STATUS_ACTIVE  = 'active';
    const STATUS_DRAFT  = 'draft';
    const STATUS_ARCHIVED  = 'archived';

    protected $fillable = [
        'name', 'slug', 'category_id', 'description', 'short_description',
        'price', 'compare_price', 'image_url', 'status', 'user_id',
    ];

        //protected $guarded = [];

        protected static function booted()
        {
        // static::addGlobalScope('owner', function(Builder $query){
         // $query->where('user_id', '=', Auth::id());
         //});
        }

        public function category()
        {
            return $this->belongsTo(category::class, 'category_id')->withDefault([
                'name' => 'Uncategorized',
                
            ]);
        }

        public function gallery()
        {
            return $this->hasMany(ProductImage::class);
        }

        public function cart()
      {
         return $this->belongsToMany(
            User::class,     // Related model (User)
            'carts',            // Pivot table (default=product_user)
            'product_id',          // FK current model in Pivot table
            'user_id',       // FK realted model in Pivot table
            'id',               // PK current model 
            'id',               // PK related model
        )
        ->withPivot(['quantity'])
        ->withTimestamps()
        ->using(Cart::class);
      }

        public function scopeActive (Builder $query)
        {
            $query->where('status', '=', 'active');
        }

        public function scopeStatus (Builder $query, $status)
        {
            $query->where('status', '=', '$status');
        }

        public function scopefilter(Builder $query, $filters)
        {
            $query->where($filters['search'] ?? false , function($query, $value){
                $query->where(function($query) use ($value) {
                    $query->where('products.name', 'LIKE', "%{$value}%")
                    ->orwhere('products.description', 'LIKE', "%{$value}%");
                });
            })
            ->when($filters['status'], function($query, $value) {
                $query->where('products.status', '=', $value);
            })
            ->when($filters['category_id'] ?? false , function($query, $value) {
                $query->where('products.category_id', '=', $value);
            })
            ->when($filters['price_min'] ?? false , function($query, $value) {
                $query->where('products.price', '>=', $value);
            })
            ->when($filters['price_max'] ?? false , function($query, $value) {
                $query->where('products.price', '<=', $value);
            });
            
        }


    public static function statusOptions()
    {
        return  [
           self::STATUS_ACTIVE   => 'Active',
            self::STATUS_DRAFT   => 'Draft',
            self::STATUS_ARCHIVED  => 'Archived',
        ];
    }

    // Attribute Accessors: Image_Url | $category->Image_Url
    public function getImagetlinkAttribute($value)
    {
         if($this->image_url) {
            return Storage::disk('public')->url($this->image_url);
         }
         return 'https://placehold.co/600x600';
    }
    public function getNameAttribute($value)
    {
      return ucwords($value);
    }

    public function getPriceFormattedAttribute()
    {
        $foramtter = new NumberFormatter(config('app.lacale'), NumberFormatter::CURRENCY);
       return $foramtter->formatCurrency($this->price, 'USD');
    }

    public function getComparePriceFormattedAttribute()
    {
        $foramtter = new NumberFormatter(config('app.lacale'), NumberFormatter::CURRENCY);
       return $foramtter->formatCurrency($this->compare_price, 'USD');
    }
    
}
