<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Config;

class BaseController extends Controller
{
    protected $apiBaseUrl;
    protected $apiToken;
    
    public function __construct()
    {
        // Get API base URL from config or environment variable
        $this->apiBaseUrl = Config::get('services.api.base_url', env('API_BASE_URL', 'http://localhost:8002/api'));
        
        // Get API token from config or environment variable
        $this->apiToken = Config::get('services.api.token', env('API_TOKEN', ''));
    }
    
    /**
     * Make a GET request to the CRUD API
     *
     * @param string $endpoint Endpoint path (e.g., '/dashboard/statistics')
     * @param array $params Optional query parameters
     * @return array Response data or error message
     */
    public function crudApiGet($endpoint, $params = [])
    {
        try {
            $url = $this->apiBaseUrl . $endpoint;
            
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->apiToken,
                'Accept' => 'application/json'
            ])->get($url, $params);
            
            if ($response->successful()) {
                return $response->json();
            } else {
                Log::error('API Error: ' . $response->body());
                return [
                    'success' => false,
                    'message' => 'API request failed: ' . $response->status(),
                    'details' => $response->json() ?? $response->body()
                ];
            }
        } catch (\Exception $e) {
            Log::error('API Exception: ' . $e->getMessage());
            return [
                'success' => false,
                'message' => 'API request error: ' . $e->getMessage()
            ];
        }
    }
    
    /**
     * Make a POST request to the CRUD API
     *
     * @param string $endpoint Endpoint path
     * @param array $data Data to send
     * @return array Response data or error message
     */
    protected function crudApiPost($endpoint, $data = [])
    {
        try {
            $url = $this->apiBaseUrl . $endpoint;
            
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->apiToken,
                'Accept' => 'application/json'
            ])->post($url, $data);
            
            if ($response->successful()) {
                return $response->json();
            } else {
                Log::error('API Error: ' . $response->body());
                return [
                    'success' => false,
                    'message' => 'API request failed: ' . $response->status(),
                    'details' => $response->json() ?? $response->body()
                ];
            }
        } catch (\Exception $e) {
            Log::error('API Exception: ' . $e->getMessage());
            return [
                'success' => false,
                'message' => 'API request error: ' . $e->getMessage()
            ];
        }
    }
    
    /**
     * Make a PUT request to the CRUD API
     *
     * @param string $endpoint Endpoint path
     * @param array $data Data to send
     * @return array Response data or error message
     */
    protected function crudApiPut($endpoint, $data = [])
    {
        try {
            $url = $this->apiBaseUrl . $endpoint;
            
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->apiToken,
                'Accept' => 'application/json'
            ])->put($url, $data);
            
            if ($response->successful()) {
                return $response->json();
            } else {
                Log::error('API Error: ' . $response->body());
                return [
                    'success' => false,
                    'message' => 'API request failed: ' . $response->status(),
                    'details' => $response->json() ?? $response->body()
                ];
            }
        } catch (\Exception $e) {
            Log::error('API Exception: ' . $e->getMessage());
            return [
                'success' => false,
                'message' => 'API request error: ' . $e->getMessage()
            ];
        }
    }
    
    /**
     * Make a DELETE request to the CRUD API
     *
     * @param string $endpoint Endpoint path
     * @return array Response data or error message
     */
    protected function crudApiDelete($endpoint)
    {
        try {
            $url = $this->apiBaseUrl . $endpoint;
            
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->apiToken,
                'Accept' => 'application/json'
            ])->delete($url);
            
            if ($response->successful()) {
                return $response->json();
            } else {
                Log::error('API Error: ' . $response->body());
                return [
                    'success' => false,
                    'message' => 'API request failed: ' . $response->status(),
                    'details' => $response->json() ?? $response->body()
                ];
            }
        } catch (\Exception $e) {
            Log::error('API Exception: ' . $e->getMessage());
            return [
                'success' => false,
                'message' => 'API request error: ' . $e->getMessage()
            ];
        }
    }
}