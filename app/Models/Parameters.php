<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

class Parameters extends Model
{
    use HasFactory;
    protected $table = "parameters";
    protected $primaryKey = "id";
    protected $fillable = ['description','company_id','parameter','value','comment','type_secret'];

    public function setValueAttribute($value)
    {
        if (isset($this->attributes['type_secret']) && $this->attributes['type_secret'] == 'Y' && !empty($value)) {
            $this->attributes['value'] = Crypt::encrypt($value);
        } else {
            $this->attributes['value'] = $value;
        }
    }

    // Accessor para descriptografar a senha do e-mail ao acessá-la
    public function getValueAttribute($value)
    {

        if ($this->attributes['type_secret']  == 'Y') {
            try{
                return Crypt::decrypt($value);
            }catch(\Exception $e){
                return $value;
            }

        } else {
            return $value;
        }
    }

}
