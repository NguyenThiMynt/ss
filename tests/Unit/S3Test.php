<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class S3Test extends TestCase
{
    /**
     * vendor/bin/phpunit --filter testPushFileToLocal Tests/Unit/S3Test.php
     */
    public function testPushFileToLocal()
    {
        //
    	$path = base_path('tests/data/artist_images');
    	$file_path = $path. '/Marter.png';
    	printf("\n" . $file_path);
    	$resource = file_get_contents($file_path);
    	$relativePath = Storage::disk('local')->put('artist/artist.png', $resource, 'public');
    	printf("\nrelativePath = " . $relativePath);
    }
    
    /**
     * vendor/bin/phpunit --filter testPushFileToS3 Tests/Unit/S3Test.php
     */
    public function testPushFileToS3()
    {
    	$path = base_path('tests/data/artist_images');
    	$file_path = $path. '/Marter.png';
    	printf("\n" . $file_path);
    	$resource = file_get_contents($file_path);
    	$relativePath = Storage::disk('artist_image_s3')->put('artist/artist.png', $resource, 'public');
    	printf("\nrelativePath = " . $relativePath);
    }
}
