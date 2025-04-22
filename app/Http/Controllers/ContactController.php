<?php
namespace App\Http\Controllers;
use App\Jobs\ImportContactsJob;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class ContactController extends Controller
{
    /**
     * Display a paginated list of contacts.
     * Cached by page number for performance optimization.
     */
    public function index(Request $request)
    {
        $page = $request->get('page', 1); // Get current page from request
        $perPage = 10; // Set per-page limit

        // Generate a unique cache key for this page
        $cacheKey = "contacts_page_{$page}";

        // Cache contacts for 60 minutes per page
        $contacts = Cache::remember($cacheKey, 60, function () use ($perPage) {
            return Contact::latest()->paginate($perPage);
        });

        return view('contacts.index', compact('contacts'));
    }

    /**
     * Show the form to create a new contact.
     */
    public function create()
    {
        return view('contacts.create');
    }

    /**
     * Store a newly created contact in the database.
     * Also clears relevant cache for freshness.
     */
    public function store(Request $request)
    {
        // Validate incoming request
        $request->validate([
            'name'  => 'required|string|max:255',
            'phone' => 'required|string|max:20',
        ]);

        // Create contact using mass-assignment
        Contact::create($request->only('name', 'phone'));

        // Invalidate cache after data change
        Cache::flush();

        return redirect()->route('contacts.index')->with('success', 'Contact added!');
    }

    /**
     * Show the form to edit a specific contact.
     */
    public function edit(Contact $contact)
    {
        return view('contacts.edit', compact('contact'));
    }

    /**
     * Update a specific contact's information.
     */
    public function update(Request $request, Contact $contact)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'phone' => 'required|string|max:20',
        ]);

        $contact->update($request->only('name', 'phone'));

        Cache::flush();

        return redirect()->route('contacts.index')->with('success', 'Contact updated!');
    }

    /**
     * Delete a contact from the database.
     */
    public function destroy(Contact $contact)
    {
        $contact->delete();

        Cache::flush();

        return redirect()->route('contacts.index')->with('success', 'Contact deleted!');
    }

    /**
     * Show the form for importing contacts via XML.
     */
    public function importForm()
    {
        return view('contacts.import');
    }

    /**
     * Handle XML file upload and dispatch background import job.
     */
    public function import(Request $request)
    {
        $request->validate([
            'xml_file' => 'required|file|mimes:xml,txt',
        ]);

        // Generate a unique filename
        $filename = 'xml_file_' . uniqid() . '.xml';

        // Define full storage paths
        $relativePath = 'private/imports/' . $filename;
        $absolutePath = storage_path('app/' . $relativePath);

        // Move uploaded file manually to secure folder
        $request->file('xml_file')->move(dirname($absolutePath), $filename);

        // Log file path for debugging (optional)
        Log::info("File  moved to: {$absolutePath}");

        // Dispatch the background job with absolute path
        ImportContactsJob::dispatch($absolutePath);

        return redirect()->route('contacts.index')->with('success', 'Import started in background!');
    }
}
