<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\Log;


class ImportTest extends TestCase
{

    use RefreshDatabase;

    /**
     * Test CSV file upload with invalid rows.
     *
     * @return void
     */
     
    // public function testCsvUploadInvalid()
    // {
    //     $file = new UploadedFile(
    //         public_path() . '/examples/data.csv',
    //         'data.csv',
    //         'csv/txt',
    //         filesize(public_path() . '/examples/data.csv'),
    //         null,
    //         true
    //     );

    //     $response = $this->call('POST', '/import_parse', [], [], ['csv_file' => $file], []);

    //     $this->assertResponseOk();
    //     // Storage::fake('data_files');

    //     // $response = $this->json('POST', '/import_parse', [
    //     //     'csv_file' => UploadedFile::fake()->csv('data.csv')
    //     // ]);

    //     // Storage::disk('data_files')->assertExists('data.csv');
    // }

    /**
     * Test CSV file upload with valid rows.
     *
     * @return void
     */
     
     public function testCsvUploadValid()
     {
         $file = new UploadedFile(
             public_path() . '/examples/data_valid.csv',
             'data_valid.csv',
             'csv/txt',
             filesize(public_path() . '/examples/data_valid.csv'),
             null,
             true
         );
 
         $response = $this->call('POST', '/import_parse', [], [], ['csv_file' => $file], []);
 
         $response->assertStatus(302);

         $response->assertRedirect('/orders/1');
     }
}
