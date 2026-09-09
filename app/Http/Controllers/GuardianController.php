<?php

namespace App\Http\Controllers;

use App\Models\Guardian;
use App\Models\Branch;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class GuardianController extends Controller
{
    /**
     * Guardian List
     */
    public function index(Request $request)
    {
        $query = Guardian::with('branch')
            ->withCount('students');

        // Search
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('nid', 'like', "%{$search}%");
            });
        }

        // Branch filter
        if ($request->filled('branch_id')) {
            $query->where('branch_id', $request->branch_id);
        }

        // Status filter
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $guardians = $query
            ->latest()
            ->paginate(15)
            ->withQueryString();

        $branches = Branch::orderBy('name')->get();

        return view('admin.guardians.index', compact(
            'guardians',
            'branches'
        ));
    }


    /**
     * Create Guardian Form
     */
    public function create()
    {
        $branches = Branch::orderBy('name')->get();

        $students = Student::orderBy('name')->get();

        return view('admin.guardians.create', compact(
            'branches',
            'students'
        ));
    }


    /**
     * Store Guardian
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'branch_id' => [
                'required',
                'exists:branches,id',
            ],

            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'phone' => [
                'nullable',
                'string',
                'max:30',
            ],

            'email' => [
                'nullable',
                'email',
                'max:255',
            ],

            'nid' => [
                'nullable',
                'string',
                'max:50',
            ],

            'occupation' => [
                'nullable',
                'string',
                'max:255',
            ],

            'address' => [
                'nullable',
                'string',
            ],

            'photo' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],

            'status' => [
                'nullable',
                'boolean',
            ],

            'students' => [
                'nullable',
                'array',
            ],

            'students.*.student_id' => [
                'required',
                'exists:students,id',
            ],

            'students.*.relationship' => [
                'required',
                'string',
                'max:50',
            ],

            'students.*.is_primary' => [
                'nullable',
                'boolean',
            ],
        ]);


        // Upload Photo
        if ($request->hasFile('photo')) {
            $validated['photo'] = $request
                ->file('photo')
                ->store('guardians', 'public');
        }


        $validated['status'] = $request->boolean('status', true);


        // Remove relationship data before creating guardian
        $studentData = $validated['students'] ?? [];

        unset($validated['students']);


        // Create Guardian
        $guardian = Guardian::create($validated);


        // Attach Students
        $this->syncStudents($guardian, $studentData);


        return redirect()
            ->route('admin.guardians.index')
            ->with('success', 'Guardian created successfully.');
    }


    /**
     * Show Guardian
     */
    public function show(Guardian $guardian)
    {
        $guardian->load([
            'branch',
            'students',
        ]);

        return view('admin.guardians.show', compact(
            'guardian'
        ));
    }


    /**
     * Edit Guardian
     */
    public function edit(Guardian $guardian)
    {
        $branches = Branch::orderBy('name')->get();

        $students = Student::orderBy('name')->get();

        $guardian->load('students');

        return view('admin.guardians.edit', compact(
            'guardian',
            'branches',
            'students'
        ));
    }


    /**
     * Update Guardian
     */
    public function update(Request $request, Guardian $guardian)
    {
        $validated = $request->validate([
            'branch_id' => [
                'required',
                'exists:branches,id',
            ],

            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'phone' => [
                'nullable',
                'string',
                'max:30',
            ],

            'email' => [
                'nullable',
                'email',
                'max:255',
            ],

            'nid' => [
                'nullable',
                'string',
                'max:50',
            ],

            'occupation' => [
                'nullable',
                'string',
                'max:255',
            ],

            'address' => [
                'nullable',
                'string',
            ],

            'photo' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],

            'status' => [
                'nullable',
                'boolean',
            ],

            'students' => [
                'nullable',
                'array',
            ],

            'students.*.student_id' => [
                'required',
                'exists:students,id',
            ],

            'students.*.relationship' => [
                'required',
                'string',
                'max:50',
            ],

            'students.*.is_primary' => [
                'nullable',
                'boolean',
            ],
        ]);


        // Replace Photo
        if ($request->hasFile('photo')) {

            if ($guardian->photo) {
                Storage::disk('public')->delete(
                    $guardian->photo
                );
            }

            $validated['photo'] = $request
                ->file('photo')
                ->store('guardians', 'public');
        }


        $validated['status'] = $request->boolean(
            'status',
            false
        );


        $studentData = $validated['students'] ?? [];

        unset($validated['students']);


        // Update Guardian
        $guardian->update($validated);


        // Update Student Relationships
        $this->syncStudents($guardian, $studentData);


        return redirect()
            ->route('admin.guardians.index')
            ->with('success', 'Guardian updated successfully.');
    }


    /**
     * Delete Guardian
     */
    public function destroy(Guardian $guardian)
    {
        // Delete Photo
        if ($guardian->photo) {
            Storage::disk('public')->delete(
                $guardian->photo
            );
        }


        // Remove Student Relationships
        $guardian->students()->detach();


        // Delete Guardian
        $guardian->delete();


        return redirect()
            ->route('admin.guardians.index')
            ->with('success', 'Guardian deleted successfully.');
    }


    /**
     * Sync Guardian Students
     */
    private function syncStudents(
        Guardian $guardian,
        array $studentData
    ): void {

        $syncData = [];

        $primaryFound = false;

        foreach ($studentData as $item) {

            if (
                empty($item['student_id']) ||
                empty($item['relationship'])
            ) {
                continue;
            }


            $isPrimary = !empty($item['is_primary']);


            // Only one primary guardian relationship
            if ($isPrimary) {

                if ($primaryFound) {
                    $isPrimary = false;
                } else {
                    $primaryFound = true;
                }
            }


            $syncData[$item['student_id']] = [
                'relationship' => $item['relationship'],
                'is_primary' => $isPrimary,
            ];
        }


        $guardian->students()->sync($syncData);
    }
}