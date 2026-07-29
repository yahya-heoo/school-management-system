<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Traits\HandlingAttachmentsTrait;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class SettingController extends Controller
{
   use HandlingAttachmentsTrait;
   public function index()
   {

      $settings = Setting::pluck('value', 'key');
      return view('pages.settings', compact('settings'));
   }

   public function update(Request $request)
   {
      
      $req = $request->except('_token', '_method', 'logo');

      // Update all regular settings
      foreach ($req as $key => $value) {
         Setting::updateOrCreate(
            ['key' => $key],
            ['value' => $value]
         );
      }

      // Handle logo using attachment system
      if ($request->hasFile('logo')) {
         $this->handleLogoAsAttachment($request->file('logo'));
      }

      return redirect()->back()->with('error', 'Settings updated successfully');
   }

   protected function handleLogoAsAttachment(UploadedFile $file)
   {
      // Find or create logo setting record
      $logoSetting = Setting::firstOrCreate(
         ['key' => 'logo'],
         ['value' => ''] // Keep this empty we storing in public storage
      );

      // Delete existing logo attachments
      $this->deleteModelAttachments($logoSetting);

      // Upload new logo using your trait
      $directory = $this->getDirectory($logoSetting);
      $attachments = $this->uploadAttachments($file, $logoSetting, $directory);

      return $attachments;
   }
}