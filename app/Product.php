<?php

namespace App;

use App\Category;
use App\Currency;
use App\Unit;
use App\User;
// use App\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{

    use SoftDeletes;

    public $fillable = ['name', 'meta_title', 'meta_keywords', 'video_link', 'meta_description', 'MOQ', 'quantity', 'description', 'user_id', 'price_from', 'price_to', 'price_show', 'price_fixed', 'category_id', 'currency_id', 'unit', 'image_url', 'slug', 'sign_date', 'username', 'status'];

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function path()
    {
        return "/product/{$this->slug}";
    }

    public function images()
    {
        return $this->hasMany('App\Image');
    }

    public function categories()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function getunit($unit_id)
    {
        if (@$unit_id) {
            $results = Unit::where('id', $unit_id)->get();
            if (@$results) {
                $result = $results[0]->name;
            } else {
                $result = "None";
            }
        } else {
            $result = "None";
        }

        return $result;
    }

    public function getcountry($prodid)
    {
        if (@$prodid) {
            $product = Product::where('id', $prodid)->first();
            if (@$product) {
                $sellerid = $product->user_id;
                if (@$sellerid) {
                    $seller = User::where('id', $sellerid)->first();
                    $country = Country::where('id', $seller->country)->first();
                    if (@$country) {
                        $sellerName = $country->name;
                    }
                }
            }
        } else {
            $sellerName = "None";
        }

        return $sellerName;
    }

    public function getcurrency($currency_id)
    {
        if (@$currency_id) {
            $results = Currency::where('id', $currency_id)->get();
            if (@$results) {
                $result = $results[0]->name;
            } else {
                $result = "None";
            }
        } else {
            $result = "None";
        }

        return $result;
    }

    public function getUsername($userid)
    {
        $record = User::where('id', $userid)->get();
        if (@$record) {
            $result = $record[0]->name;
        } else {
            $result = "None";
        }

        return $result;
    }

    /**
     * @param product id
     * @author Nemanja
     * @since 2020-12-11
     * @return seller name
     */
    public static function getsellerNameByProdcut($prodid)
    {
        if (@$prodid) {
            $product = Product::where('id', $prodid)->first();
            if (@$product) {
                $sellerid = $product->user_id;
                if (@$sellerid) {
                    $seller = User::where('id', $sellerid)->first();
                    if (@$seller) {
                        $sellerName = $seller->name;
                    }
                }
            }
        } else {
            $sellerName = "None";
        }

        return $sellerName;
    }

    /**
     * @param product id
     * @author Nemanja
     * @since 2020-12-11
     * @return seller id
     */
    public static function getsellerIdByProdcut($prodid)
    {
        if (@$prodid) {
            $product = Product::where('id', $prodid)->first();
            if (@$product) {
                $sellerid = $product->user_id;
                if (@$sellerid) {
                    $seller = User::where('id', $sellerid)->first();
                    if (@$seller) {
                        $sellerName = $seller->id;
                    }
                }
            }
        } else {
            $sellerName = "None";
        }

        return $sellerName;
    }

    public static function getCurrencyNameByProductId($prodid)
    {
        // echo '<pre>';
        // print_r($prodid);exit;

        $product = Product::where('id', $prodid)->first();
        if ($product != '') {
            $currency_id = $product->currency_id;
            $seller = Currency::where('id', $currency_id)->first();
            $currency_name = $seller->name;
            return $currency_name;
        } else {
            return 'none';

        }
    }

    /**
     * @param product id
     * @author Nemanja
     * @since 2020-12-11
     * @return seller company name
     */
    public static function getcompanyNameByProdcut($prodid)
    {

        if (@$prodid) {
            $product = Product::where('id', $prodid)->first();

            if (@$product) {
                $sellerid = $product->user_id;
                if (@$sellerid) {
                    $seller = User::where('id', $sellerid)->first();

                    if (@$seller->company_name) {
                        $sellerName = $seller->company_name;
                    } else {
                        $sellerName = "";
                    }
                } else {
                    $sellerName = "";
                }
            } else {
                $sellerName = "";
            }
        } else {
            $sellerName = "";
        }

        return $sellerName;
    }

    public static function getcompanyAboutByProdcut($prodid)
    {
        $sellerAbout = "";
        if (@$prodid) {
            $product = Product::where('id', $prodid)->first();
            if (@$product) {
                $sellerid = $product->user_id;
                if (@$sellerid) {
                    $seller = User::where('id', $sellerid)->first();
                    if (@$seller) {
                        $sellerAbout = $seller->company_about;
                    }
                }
            }
        }

        return $sellerAbout;
    }

    public static function getcompanyCountryByProdcut($prodid)
    {
        $sellerCountry = "";
        if (@$prodid) {
            $product = Product::where('id', $prodid)->first();
            if (@$product) {
                $sellerid = $product->user_id;
                if (@$sellerid) {
                    $seller = User::where('id', $sellerid)->first();
                    if (@$seller) {
                        $sellerCountry = $seller->country;
                    }
                }
            }
        }

        return $sellerCountry;
    }

    public function getcompanyName($userid)
    {
        $record = User::where('id', $userid)->get();
        if (@$record) {
            $result = $record[0]->company_name;
        } else {
            $result = "None";
        }

        return $result;
    }

    public static function getcompanyEstablishedByProdcut($prodid)
    {
        $sellerEstablished = "";
        if (@$prodid) {
            $product = Product::where('id', $prodid)->first();
            if (@$product) {
                $sellerid = $product->user_id;
                if (@$sellerid) {
                    $seller = User::where('id', $sellerid)->first();
                    if (@$seller) {
                        $establishedDate = $seller->year_of_establishment;

                        $establishedDate = explode('-', $establishedDate);
                        $sellerEstablished = $establishedDate[0];
                    }
                }
            }
        }

        return $sellerEstablished;
    }

    public static function getcompanyFunctionByProdcut($prodid)
    {
        $sellerFunction = "";
        if (@$prodid) {
            $product = Product::where('id', $prodid)->first();
            if (@$product) {
                $sellerid = $product->user_id;
                if (@$sellerid) {
                    $seller = User::where('id', $sellerid)->first();
                    if (@$seller) {
                        $sellerFunction = $seller->company_function;
                    }
                }
            }
        }

        return $sellerFunction;
    }

    public function getcompanyLogo($userid)
    {
        $record = User::where('id', $userid)->get();
        if (@$record) {
            $result = $record[0]->company_logo;
        } else {
            $result = "None";
        }

        return $result;
    }

    public function getCategoryname($cateid)
    {
        $record = Category::where('id', $cateid)->get();
        if (@$record[0]->name) {
            $result = $record[0]->name;
        } else {
            $result = "";
        }

        return $result;
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function thumbnailUrl()
    {
        $first_image = $this->images->first();
        return $first_image ? $first_image->url : '';
    }

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function getstatuesname($id)
    {
        if (@$id) {
            if ($id == 1) {
                $name = "Pending";
            } else if ($id == 2) {
                $name = "Approved";
            } else {
                $name = "Canceled";
            }
        } else {
            $name = "Pending";
        }

        return $name;
    }

    public function vendor()
    {
        // $shop_name = $this->user->shop->name;
        // $vendor    = $shop_name ? $shop_name : $this->user->name;
        // return $vendor;
    }

    public function vendor_url()
    {
        $shop_id = $this->user->shop->id;
        $url = $shop_id ? route('shop.show', $shop_id) : null;

        return $url;
    }

    public function scopeFilter($query, $filters)
    {
        return $filters->apply($query);
    }

    public function scopeGetUserId($query, $product_id)
    {
        return $query->select('user_id')
            ->where('id', $product_id)
            ->first()
            ->user_id;
    }

}