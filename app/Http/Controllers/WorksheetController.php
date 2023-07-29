<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\WorkshhetRequest;
use App\Models\Worksheet;

class WorksheetController extends Controller
{
    public function index() {
        $worksheet_data = Worksheet::all();
        return view('admin.worksheet.list', [
            'worksheet_data' => $worksheet_data,
        ]);
    }

    public function create() {
        return view('admin.worksheet.create');
    }

    public function store(WorkshhetRequest $request) {
        $data = [
            'name' => $request->name,
            'description' => $request->description,
        ];

        if (isset($request->file)) {
            $extension = $request->file->extension();
            if ($extension == 'txt') {
                $extension = 'csv';
            }
            $name = time() . '.' . $extension;
            $request->file->move(public_path('uploads/worksheet'), $name);
            $data['sheet_name'] = $name;
        }

        $create = Worksheet::create($data);
        if ($create) {
            return redirect()->route('admin.worksheet-management.index')->with('success', 'Worksheet created successfully');
        } else {
            return redirect()->route('admin.worksheet-management.index')->with('error', 'Something went wrong');
        }
    }

    public function edit($id) {
        $worksheet = Worksheet::find($id);
        return view('admin.worksheet.edit', [
            'worksheet' => $worksheet,
        ]);
    }

    public function update(WorkshhetRequest $request) {
        $worksheet = Worksheet::where('id', $request->id)->first();
        if (!$worksheet) {
            return redirect()->route('admin.worksheet-management.index')->with('error', 'Worksheet not found');
        }
        $data = [
            'name' => $request->name,
            'description' => $request->description,
        ];
        if (gettype($request->file) == 'object') {
            unlink(public_path('uploads/worksheet/' . $worksheet->sheet_name));
            $extension = $request->file->extension();
            if ($extension == 'txt') {
                $extension = 'csv';
            }
            $name = time() . '.' . $extension;
            $request->file->move(public_path('uploads/worksheet'), $name);
            $data['sheet_name'] = $name;
        } else {
            $data['sheet_name'] = $worksheet->sheet_name;
        }

        $update = Worksheet::where('id', $request->id)->update($data);
        if ($update) {
            return redirect()->route('admin.worksheet-management.index')->with('success', 'Worksheet updated successfully');
        } else {
            return redirect()->route('admin.worksheet-management.index')->with('error', 'Something went wrong');
        }
    }

    public function delete($id) {
        $worksheet = Worksheet::find($id);
        unlink(public_path('uploads/worksheet/' . $worksheet->sheet_name));
        $worksheet->delete();
        return "success";
    }
}
    