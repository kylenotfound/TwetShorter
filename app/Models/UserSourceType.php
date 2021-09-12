<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Models\User;

class UserSourceType extends Model {

  protected $table = 'user_source_type';

  const SOURCE_TYPE_NAME = 'source_type_id';

  protected $fillable = [
    'source_type_name',
  ];

  public function getSourceTypeId() {
    return $this->id;
  }

  public function getSourceTypeName() {
    return $this->source_type_name;
  }

  public function getProvderId() {
    return $this->provider_id;
  }

}