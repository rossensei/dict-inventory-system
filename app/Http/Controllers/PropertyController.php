<?php

namespace App\Http\Controllers;

use App\Models\Office;
use App\Models\Category;
use App\Models\Employee;
use App\Models\Property;
use App\Models\Acquisition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\PropertyResource;
use App\Http\Requests\StorePropertyRequest;
use App\Http\Requests\UpdatePropertyRequest;
use File;

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $properties = Property::with([
            'acquisition', 
            'category', 
            'subcategory', 
            'receivingEmployee', 
            'assignedEmployee', 
            'office'
        ])->get();
        
        // return response()->json(PropertyResource::collection($properties));
        return inertia('Property/Index', [
            'properties' => PropertyResource::collection($properties),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::select('id', 'code', 'catname')
            ->with('subcategories:id,category_id,code,subcatname')
            ->get();

        $offices = Office::select('id', 'office_name')->orderBy('office_name', 'asc')->get();

        $acquisitions = Acquisition::select('id', 'name')->orderBy('name', 'asc')->get();

        $employees = Employee::select('id', 'fname', 'lname')
            ->orderBy('fname', 'asc')
            ->orderBy('lname', 'asc')
            ->get();


        return inertia('Property/Create', [
            'categories' => $categories,
            'offices' => $offices,
            'acquisitions' => $acquisitions,
            'employees' => $employees,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePropertyRequest $request)
    {
        $fields = $request->validated();

        if($request->photo) {
            $destination_path = 'public/uploads/photos';
            $photo_name = $request->photo->getClientOriginalName();
            $request->photo->storeAs($destination_path, $photo_name);
            $fields['photo'] = $photo_name;
        }

        if($request->document) {
            $destination_path = 'public/uploads/documents';
            $document_name = $request->document->getClientOriginalName();
            $request->document->storeAs($destination_path, $document_name);
            $fields['document'] = $document_name;
        }

        // $doc_path = $request->document->store('uploads/files');
        // $photo_path = $request->photo->store('uploads/images');

        Property::create($fields);

        return redirect()->route('property.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Property $property)
    {
        $property->load(['category', 'subcategory', 'acquisition', 'office', 'receivingEmployee', 'assignedEmployee']);

        // dd(PropertyResource::make($property));
        return inertia('Property/Show', [ 
            'property' => $property
            // 'property' => PropertyResource::make($property)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Property $property)
    {
        $categories = Category::select('id', 'code', 'catname')
            ->with('subcategories:id,category_id,code,subcatname')
            ->get();

        $offices = Office::select('id', 'office_name')->orderBy('office_name', 'asc')->get();

        $acquisitions = Acquisition::select('id', 'name')->orderBy('name', 'asc')->get();

        $employees = Employee::select('id', 'fname', 'lname')
            ->orderBy('fname', 'asc')
            ->orderBy('lname', 'asc')
            ->get();

        return inertia('Property/Edit', [
            'property' => $property,
            'categories' => $categories,
            'offices' => $offices,
            'acquisitions' => $acquisitions,
            'employees' => $employees,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePropertyRequest $request, Property $property)
    {
        $fields = $request->validated();

        // process the photo
        if($request->photo) {
            // delete the old photo from the storage
            File::delete(storage_path('app/public/uploads/photos/'.$property->photo));

            $destination_path = 'public/uploads/photos';
            $photo_name = $request->photo->getClientOriginalName();
            $request->photo->storeAs($destination_path, $photo_name);
            $fields['photo'] = $photo_name;
        } else {
            unset($fields['photo']);
        }

        // process the document
        if($request->document) {
            // delete the old pdf document from the storage
            File::delete(storage_path('app/public/uploads/documents/'.$property->document));
            
            $destination_path = 'public/uploads/documents';
            $document_name = $request->document->getClientOriginalName();
            $request->document->storeAs($destination_path, $document_name);
            $fields['document'] = $document_name;
        } else {
            unset($fields['document']);
        }

        $property->update($fields);

        return redirect(route('property.show', $property->id))->with('message', 'Property has been updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Property $property)
    {
        /**
         * // Not Working
         * Storage::delete('uploads/photos/' . $property->photo);
         * Storage::delete('uploads/documents/' . $property->document);
         */

        File::delete(storage_path('app/public/uploads/photos/'.$property->photo));
        File::delete(storage_path('app/public/uploads/documents/'.$property->document));
        
        $property->delete();

        return back()->with('success', 'Property has been deleted!');
    }

    public function viewPdf($filename)
    {
        $path = Storage::path('public/uploads/documents/' . $filename);

        return response()->file($path);
    }
}
