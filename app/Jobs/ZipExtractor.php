<?php

namespace App\Jobs;

use App\Models\User;
use App\Notifications\ZipFileDone;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use ZipArchive;

class ZipExtractor implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */

    public $albumId;
    public $gClient;

    public function __construct($album_Id, $gClient)
    {
        $this->albumId = $album_Id;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        ini_set('memory_limit', '-1');
        ini_set('max_execution_time', 300000);
        ini_set('post_max_size', '100000M'); // Adjust to your file size
        ini_set('upload_max_filesize', '100000M');


        $google_redirect_url = route('glogin');
        $this->gClient = new \Google_Client();
        $this->gClient->setApplicationName(env('GOOGLE_APP_NAME'));
        $this->gClient->setClientId(env('GOOGLE_CLIENT_ID'));
        $this->gClient->setClientSecret(env('GOOGLE_CLIENT_SECRET'));
        $this->gClient->setRedirectUri(env('GOOGLE_REDIRECT_URL'));
        $this->gClient->setDeveloperKey(env('GOOGLE_CLIENT_ID'));
        $this->gClient->setScopes(array(
            'https://www.googleapis.com/auth/drive.file',
            'https://www.googleapis.com/auth/drive'
        ));
        $this->gClient->setAccessType("offline");
        $this->gClient->setApprovalPrompt("force");

        $service = new \Google_Service_Drive($this->gClient);
        $user = \App\Models\User::find(1);
        $this->gClient->setAccessToken(json_decode($user->access_token, true));
        if ($this->gClient->isAccessTokenExpired()) {

            // save refresh token to some variable
            $refreshTokenSaved = $this->gClient->getRefreshToken();
            // update access token
            $this->gClient->fetchAccessTokenWithRefreshToken($refreshTokenSaved);
            // // pass access token to some variable
            $updatedAccessToken = $this->gClient->getAccessToken();
            // // append refresh token
            $updatedAccessToken['refresh_token'] = $refreshTokenSaved;
            //Set the new acces token
            $this->gClient->setAccessToken($updatedAccessToken);

            $user->access_token = $updatedAccessToken;
            $user->save();
        }


        $album = \App\Models\Album::findOrFail($this->albumId);
        //$folder = json_decode($album->folder);

        // Set the folder ID
        $folderId =  $album->folder;

        // Set the query to search for files in the folder
        $query = "parents='$folderId' and trashed=false";

        // Get the files in the folder
        $files = $service->files->listFiles([
            'q' => $query
        ]);

        $zip = new ZipArchive();
        $zipFileName = $album->name . '.zip';
        $zip->open(public_path($zipFileName), ZipArchive::CREATE | ZipArchive::OVERWRITE);
        // Loop through the files and download each one
        foreach ($files as $file) {
            // Download the file contents
            $fileContents = $service->files->get($file->getId(), [
                'alt' => 'media'
            ])->getBody()->getContents();

            $zip->addFromString(rand(1, 100) . '.jpeg', $fileContents);
        }

        $zip->close();

        Storage::put( 'zips/myZip.zip' , public_path($zipFileName));
        
           
        $user = User::where('id',$album->user_id)->first();
        $user->notify(new ZipFileDone( $zipFileName));
    }
}
