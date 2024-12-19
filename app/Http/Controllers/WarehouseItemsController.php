<?php

namespace App\Http\Controllers;

use App\Models\WarehouseItem;
use App\Models\WarehouseChange;
use App\Models\User;
use Illuminate\Http\Request;
use Rap2hpoutre\FastExcel\FastExcel;
use Rap2hpoutre\FastExcel\SheetCollection;

class WarehouseItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return inertia('Warehouse/Index', [
			'items' => WarehouseItem::all()
		]);
    }

	/**
	 * Display a list of warehouse changes
	 */
	public function changes(Request $request)
	{
		$changes = WarehouseChange::with(['warehouseItem:id,name,unit', 'author:id,name'])->filter($request->only('name', 'by', 'from', 'to'))->orderBy('time', 'desc')->paginate(25);
		$users = User::get(['name', 'id']);

		return inertia('Changes', [
			'filters' => $request->all('name', 'by', 'from', 'to'),
			'changes' => $changes,
			'users' => $users
		]);
	}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
		$request->validate([
			'name' => 'required|min:3',
			'quantity' => 'required'
		]);

        $storedItem = WarehouseItem::create([
			'name' => $request->name,
			'code' => $request->code,
			'unit' => $request->unit,
			'quantity' => $request->quantity,
			'note' => $request->note
		]);

		$storedItem->warehouseChanges()->create([
			'user_id' => auth()->user()->id,
			'change' => $request->quantity,
			'note' => env('APP_LANG') == 'sk' ? 'Položka vytvorená' : 'Item created',
			'time' => time()
		]);

		return back()->with('flash', $storedItem);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(WarehouseItem $warehouseItem)
    {
		$whChanges = WarehouseChange::where('warehouse_item_id', $warehouseItem->id)->with('author:id,name')->orderBy('time', 'asc')->get();

        return inertia('Warehouse/Edit', [
			'item' => $warehouseItem,
			'history' => $whChanges
		]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, WarehouseItem $warehouseItem)
    {
        $request->validate([
			'name' => 'required|min:3'
		]);

		$warehouseItem->update([
			'name' => $request->name,
			'code' => $request->code,
			'note' => $request->note
		]);

		return back()->with(['success' => true]);
    }

	/**
	 * Add change to WarehouseItems quantity
	 */
	public function change(Request $request, WarehouseItem $warehouseItem)
	{
		$request->validate([
			'quantity' => 'required',
			'time' => 'required|numeric|digits:10'
		]);

		$warehouseItem->update([
			'quantity' => $warehouseItem->quantity + $request->quantity,
		]);

		$warehouseItem->warehouseChanges()->create([
			'user_id' => auth()->user()->id,
			'change' => $request->quantity,
			'note' => $request->note,
			'time' => $request->time
		]);

		return back()->with(['success' => true]);
	}

	/**
	 * Create XLSX export
	 */
	private function getWarehouseItemRows(WarehouseItem $warehouseItem) {
		$whChanges = WarehouseChange::where('warehouse_item_id', $warehouseItem->id)->with('author:id,name')->orderBy('time', 'asc')->get();

		$rows = [];
		foreach ($whChanges as $change) {
			$rows[] = [
				'datum' => date("d/m/Y H:i:s", $change->time),
				'zmena' => $change->change,
				'poznamka' => $change->note,
				'zmenil' => $change->author->name ?? ''
			];
		}
		$rows[] = [
			'datum' => date("d/m/Y H:i:s"),
			'zmena' => $warehouseItem->quantity,
			'poznamka' => 'SPOLU',
			'zmenil' => ''
		];

		return $rows;
	}
	public function export(Request $request, WarehouseItem $warehouseItem) {
		$sheets = new SheetCollection([
			$warehouseItem->name => $this->getWarehouseItemRows($warehouseItem)
		]);

		$nameDate = date("Y-m-d--H-i");
		$name = "{$warehouseItem->name} {$nameDate}.xlsx";

		$excel = new FastExcel($sheets);
		return $excel->download($name);
	}
	public function exportAll(Request $request) {
		$wh = WarehouseItem::get(['id', 'name', 'quantity', 'note', 'unit', 'updated_at']);
		$rows = [];
		foreach ($wh as $item) {
			$rows[] = [
				'nazov' => $item->name,
				'stav' => $item->quantity,
				'jednotka' => $item->unit,
				'poznamka' => $item->note,
				'aktualizovane' => $item->updated_at->format("d/m/Y H:i:s")
			];
		}

		$sheets = new SheetCollection([
			'Sklad' => $rows
		]);

		if ($request->items == 1) {
			foreach ($wh as $item) {
				$sheets[$item->name] = $this->getWarehouseItemRows($item);
			}
		}

		$nameDate = date("Y-m-d--H-i");
		$name = "Sklad {$nameDate}.xlsx";

		$excel = new FastExcel($sheets);
		return $excel->download($name);
	}

	/**
	 * Change note of WarehouseCHange
	 */
	public function changeNote(Request $request, WarehouseChange $warehouseChange)
	{
		$warehouseChange->update([
			'note' => $request->note
		]);

		return back()->with(['success' => true]);
	}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(WarehouseItem $warehouseItem)
    {
        $warehouseItem->delete();

		return response(['success' => true]);
    }
}