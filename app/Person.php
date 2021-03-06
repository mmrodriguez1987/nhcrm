<?php

namespace newhopecrm;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    //
    protected $table = 'persons';
    
    protected $fillable = [
        'first_name',
        'last_name',
        'marital_status',
        'birthdate',
        'cid',
        'sex',
        'address',
        'street',
        'postal_code',
        'city',
        'state',
        'profession_id',
        'email',
        'phone',
        'cnt_emerg_name',
        'cnt_emerg_phone',
        'cnt_emerg_address',
        'crt_employer_name',
        'crt_employer_phone',
        'crt_employer_address',
        'position_id',
        'person_type_id',
        'active'
    ];

    protected $appends = ['position_name','profession_name','person_type_name'];

    public function persontype() {
        return $this->BelongsTo(Persontype::class, 'person_type_id');
    }

    public function profession() {
        return $this->BelongsTo(Profession::class, 'profession_id');
    }

    public function position() {
        return $this->BelongsTo(Position::class, 'position_id');
    }

    public function scopeSearch($query, $target) {
        if ($target != '') {
            $query->where('first_name', 'like', "%$target%")
            ->orWhere('last_name', 'like', "%$target%")
            ->orWhere('marital_status', 'like', "%$target%")
            ->orWhere('cid', 'like', "%$target%")
            ->orWhere('sex', 'like', "%$target%")
            ->orWhere('address', 'like', "%$target%")
            ->orWhere('postal_code', 'like', "%$target%")
            ->orWhere('state', 'like', "%$target%")
            ->orWhere('street', 'like', "%$target%")
            ->orWhere('email', 'like', "%$target%")
            ->orWhere('phone', 'like', "%$target%")
            ->orWhere('city', 'like', "%$target%")
            ->orWhere('cnt_emerg_name', 'like', "%$target%")
            ->orWhere('cnt_emerg_phone', 'like', "%$target%")
            ->orWhere('cnt_emerg_address', 'like', "%$target%")
            ->orWhere('crt_employer_name', 'like', "%$target%")
            ->orWhere('crt_employer_address', 'like', "%$target%")
            ->orWhere('crt_employer_phone', 'like', "%$target%")
            ->orWhere('position_id', 'like', "%$target%")
            ->orWhere('person_type_id', 'like', "%$target%")
            ->orWhere('profession_id', 'like', "%$target%")
            ->orWhere('birthdate', 'like', "%$target%");
            
        }
        return $query;
    }

  
    public function scopeProfession($query, $profession_id) {
        if ($profession_id != '') {
            return $query->where('profession_id', $profession_id);
        }        
    }

 
    public function scopePersontype($query, $person_type_id) {
        if ($person_type_id != '') {
            return $query->where('person_type_id', $person_type_id);
        }        
    }

  
    public function scopePosition($query, $position_id) {
        if ($position_id != '') {
            return $query->where('position_id', $position_id);
        }        
    }


    //Attributes
    public function getProfessionNameAttribute() {
        return $this->profession->name;
    }

    public function getPersonTypeNameAttribute() {
        return $this->persontype->name;
    }
    public function getPositionNameAttribute() {
        return $this->position->name;
    }


}
