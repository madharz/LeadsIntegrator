<?php

namespace App\Controllers;

use App\Services\ApiClient;
use App\Models\Lead;
use App\Validators\LeadValidator;

class LeadController
{
    private ApiClient $client;

    public function __construct()
    {
        $this->client = new ApiClient();
    }

    public function handleFormSubmit(array $data): void
    {
        try {
            $validator = new LeadValidator();
            $validator->validate($data);

            $payload = Lead::buildPayload($data);

            $response = $this->client->post('addlead', $payload);
            if ($response['status']) {
                echo "<p>Lead added successfully! <a href='{$response['autologin']}'>Autologin Link</a></p>";
            } else {
                echo "<p>Error: {$response['error']}</p>";
            }
        } catch (\Exception $e) {
            echo "<p>Validation Error: {$e->getMessage()}</p>";
        }
    }

    public function showLeads(): void
    {
        $response = $this->client->post('getstatuses', [
            'date_from' => date('Y-m-d 00:00:00', strtotime('-30 days')),
            'date_to' => date('Y-m-d 23:59:59'),
        ]);

        $leads = Lead::parseLeadsResponse($response);

        if (!empty($leads)) {
            echo '<table border="1"><tr><th>ID</th><th>Email</th><th>Status</th><th>FTD</th></tr>';
            foreach ($leads as $lead) {
                echo "<tr><td>{$lead['id']}</td><td>{$lead['email']}</td><td>{$lead['status']}</td><td>{$lead['ftd']}</td></tr>";
            }
            echo '</table>';
        } else {
            echo '<p>No leads found or failed to parse response.</p>';
        }
    }
}