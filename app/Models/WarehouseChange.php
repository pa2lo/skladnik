<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WarehouseChange extends Model
{
    // use HasFactory;

	protected $guarded = [];

	public function warehouseItem() {
		return $this->belongsTo(WarehouseItem::class, 'warehouse_item_id');
	}

	public function author() {
		return $this->belongsTo(User::class, 'user_id');
	}

	public function scopeFilter($query, $filters = []) {
		if(!$filters) return $query;

        $query->when($filters['name'] ?? null, function ($query, $name) {
			$query->whereHas('warehouseItem', function ($q) use ($name) {
				$q->where('name', 'LIKE', "%$name%");
			});
        })->when($filters['by'] ?? null, function ($query, $by) {
			$query->where('user_id', $by);
        })->when($filters['from'] ?? null, function ($query, $from) {
			$query->where('created_at', ">", $from);
		})->when($filters['to'] ?? null, function ($query, $to) {
			$query->where('created_at', "<", $to);
		});
    }
}
