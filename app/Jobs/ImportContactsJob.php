<?php
namespace App\Jobs;
use App\Models\Contact;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class ImportContactsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Absolute path of the uploaded XML file to be processed.
     */
    public string $absolutePath;

    /**
     * Create a new job instance.
     *
     * @param string $absolutePath Absolute file path to the uploaded XML
     */
    public function __construct(string $absolutePath)
    {
        $this->absolutePath = $absolutePath;
    }

    /**
     * Execute the job.
     * This method reads an XML file and imports each contact into the database.
     */
    public function handle()
    {
        try {
            Log::info("Reading XML from: {$this->absolutePath}");

            // Check if file actually exists
            if (!file_exists($this->absolutePath)) {
                Log::error("File not found at: {$this->absolutePath}");
                return;
            }

            // Read and parse the XML content
            $xmlContent = file_get_contents($this->absolutePath);
            $xml = simplexml_load_string($xmlContent);

            // Handle invalid XML structure
            if (!$xml) {
                Log::error("Failed to parse XML from: {$this->absolutePath}");
                return;
            }

            // Loop through each <contact> node and save to DB
            foreach ($xml->contact as $contact) {
                Contact::create([
                    'name'  => (string) $contact->name,
                    'phone' => (string) $contact->phone,
                ]);
            }

            Log::info("XML import completed successfully from: {$this->absolutePath}");

        } catch (\Exception $e) {
            // Log any unexpected errors during import
            Log::error("ImportContactsJob failed: " . $e->getMessage());
        }
    }
}
