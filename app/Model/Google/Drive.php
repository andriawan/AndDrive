<?php

namespace App\Model\Google;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Illuminate\Support\Facades\DB;

class Drive extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'drive_user';
    protected $primaryKey = 'id_user';

    // instance drive
    public $drive;

    public function __construct()
    {
        
        // instance new Google api client
        $this->drive = new \Google_Client();

        // set stuff
        $this->drive->setApplicationName(config('app.name'));
        $this->drive->setClientId(config('services.drive.client_id'));
        $this->drive->setClientSecret(config('services.drive.client_secret'));
        $this->drive->setRedirectUri(route('glogin'));
        $this->drive->setAccessType("offline");
        $this->drive->setApprovalPrompt('force');
        $this->drive->setDeveloperKey(config('services.drive.api_key'));
        $this->drive->setScopes(array(
            'https://www.googleapis.com/auth/drive.file',
            'https://www.googleapis.com/auth/drive',
            'profile',
            'email'
        ));
    }

    public function auth(Request $request)
    {
        $auth = new \Google_Service_Oauth2($this->drive);

        if ($request->get('code'))
        {
            $this->drive->authenticate($request->get('code'));
            $request->session()->put('token', $this->drive->getAccessToken());
        }
        
        if ($request->session()->get('token'))
        {
            $this->drive->setAccessToken($request->session()->get('token'));
        }
        
        if ($this->drive->getAccessToken())
        {
            //For logged in user, get details from google using access token
            $guser = $auth->userinfo->get();
            $check = $this->is_user_exist($guser['email'],$guser['id']);

            // jika user tidak ada dalam database
            if($check == false)
            {
                // save user ke db
                $this->save_user($guser);
            }
            
            // simpan di session
            $request->session()->put('drive', $guser);
            return redirect()->to('');
         
        } else
        {
            // If user is not authenticated
            // get google login url
            $authUrl = $this->drive->createAuthUrl();
            return redirect()->to($authUrl);
        }
    }

    public function list_files(Request $request)
    {
        return  DB::table('drive_file_info')
            ->where(['owner' => session('id_user')])
            ->orderBy('created_at', 'asc')
            ->get();
    }

    public function upload_file(Request $request)
    {
        $this->prepare_token($request);
        $file = $request->file('local');
        $drive = new \Google_Service_Drive($this->drive);
        $fileMetadata = new \Google_Service_Drive_DriveFile(array(
            'name' => 'and_drive_' . $file->getClientOriginalName()));
        $content = file_get_contents($file);
        $upload = $drive->files->create($fileMetadata, array(
            'data' => $content,
            'mimeType' => $file->getClientMimeType(),
            'uploadType' => 'multipart',
            'fields' => 'id'));
        $this->save_file_info(array(
            'file_id' => $upload->id,
            'file_name' => 'and_drive_' . $file->getClientOriginalName(),
            'owner' => session('id_user')
        ));

        $request->session()->flash('status', 'File berhasil dibuat. Silahkan cek di drive folder anda atau pada menu list files');
    }

    public function save_user($user = array())
    {
        $drive_user = new Drive();
        $drive_user->email = $user['email'];
        $drive_user->gid = $user['id'];
        $drive_user->name = $user['name'];
        $drive_user->family_name = $user['familyName'];
        $drive_user->given_name = $user['givenName'];
        $drive_user->locale = $user['locale'];
        $drive_user->gender = $user['gender'];
        $drive_user->avatar_url = $user['picture'];

        $drive_user->save();
        session(['id_user' => $drive_user->id_user]);
    }

    public function save_file_info($arr = array())
    {
        DB::table('drive_file_info')->insert([
            'file_id' => $arr['file_id'], 
            'file_name' => $arr['file_name'],
            'owner' => $arr['owner'],
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ]);
    }

    public function download_file($id = null, Request $request)
    {
        $this->prepare_token($request);
        $drive = new \Google_Service_Drive($this->drive);
        $fileId = $id;
        $file = $drive->files->get($fileId, array(
                    'alt' => 'media'));

        return response($file->getBody()->getContents())
            ->header('Content-Type', $file->getHeader('Content-Type'));
    }
    
    public function prepare_token(Request $request)
    {
        if ($request->session()->get('token'))
        {
            $this->drive->setAccessToken($request->session()->get('token'));
        }

        if($this->drive->isAccessTokenExpired()){  // if token expired
    
            // refresh the token
            $this->drive->refreshToken($request->session()->get('token')['refresh_token']);
        }

    }

    public function is_user_exist($email = null, $id = null)
    {
        $user = Drive::where('email', $email)->where('gid', $id)->first();

        if(is_null($user))
        {
            return false;
        }else
        {
            session(['id_user' => $user->attributes['id_user']]);
            return true;
        }
    }

}