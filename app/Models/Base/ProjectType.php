<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Base;

use App\Models\Formset;
use App\Models\Propose;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ProjectType
 * 
 * @property int $id
 * @property string $name
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Formset[] $formsets
 * @property Collection|Propose[] $proposes
 *
 * @package App\Models\Base
 */
class ProjectType extends Model
{
	protected $table = 'project_type';

	public function formsets()
	{
		return $this->hasMany(Formset::class);
	}

	public function proposes()
	{
		return $this->hasMany(Propose::class, 'type_id');
	}
}
