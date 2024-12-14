<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Flasher\Laravel\Facade\Flasher;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;
use App\Models\User;
use App\Models\LoveNote;
use Carbon\Carbon;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
//use Intervention\Image\Drivers\Imagick\Driver;
use Intervention\Image\Typography\FontFactory;


class AdminController extends Controller
{
    public function dashboard(){
        $pageTitle = 'Admin Dashboard';
        return view('admin.dashboard', compact('pageTitle'));
    }

    public function profile(){
        $admin = Auth::user();
        $pageTitle = 'My Profile';
        return view('admin.profile', compact('admin', 'pageTitle'));
    }

    public function updateProfile(Request $request)
    {
        $admin = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $admin->id,
            'phone' => 'required|string|max:20',
            'address' => 'nullable|string|max:255',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
        ]);

        $admin->name = $request->input('name');
        $admin->email = $request->input('email');
        $admin->phone = $request->input('phone');
        $admin->address = $request->input('address');

        if ($request->hasFile('profile_picture')) {
            if ($admin->profile_picture) {
                Storage::disk('public')->delete($admin->profile_picture);
            }

            $profilePicturePath = $request->file('profile_picture')->store('profile_pictures', 'public');
            $admin->profile_picture = $profilePicturePath;
        }

        $admin->save();

        return back()->with('success', 'Profile updated successfully.');
    }

    public function updatePassword(Request $request)
    {
        // Validate the form data
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Get the current authenticated user
        $admin = Auth::user();

        // Check if the current password matches
        if (!Hash::check($request->input('current_password'), $admin->password)) {
            throw ValidationException::withMessages([
                'current_password' => ['The current password is incorrect.'],
            ]);
        }

        // Update the password
        $admin->password = Hash::make($request->input('password'));
        $admin->save();

        // Redirect back with a success message
        return back()->with('success', 'Password updated successfully.');
    }

    public function showLoveNote($id)
    {
        $lovenote = LoveNote::findOrFail($id);
        return view('admin.lovenotes.index', compact('lovenote'));
    }

    public function destroyLoveNote($id)
    {
        $lovenote = LoveNote::findOrFail($id);
        $lovenote->delete();
        return redirect()->route('admin.dashboard')->with('success', 'Love note deleted successfully.');
    }

    public function exportAsImage($id)
    {
        try {
            // Find the love note
            $loveNote = LoveNote::findOrFail($id);

            // get the background image
            $manager = new ImageManager(new Driver());
            $img = $manager->read(public_path('assets/img/lovenotesbg.png'));
            $img->resize(1080, 1080);

            // Font settings
            $fontPath = public_path('fonts/Poppins-Medium.ttf');
            $fontSize = 22;
            $lineHeight = 2;
            $textWidth = 850 - 40;

            // Calculate lines needed
            $wrappedText = wordwrap($loveNote->message, $textWidth / ($fontSize * 0.6), "\n", true);
            $lines = explode("\n", $wrappedText);
            $numLines = count($lines);

            // Calculate text box height with a minimum of 200
            $textBoxHeight = max(200, ($fontSize * $lineHeight) * $numLines + 20);

            // Create white box for text
            $textBox = $manager->create(850, $textBoxHeight)->fill('fff');

            // Calculate position to place the white box
            $boxX = (int)(($img->width() - $textBox->width()) / 2);
            $boxY = (int)(($img->height() - $textBox->height()) / 2);

            // Add the white box to main image
            $img->place($textBox, 'top-left', $boxX, $boxY);

            // Add author name
            $img->text($loveNote->author, $boxX + 20, $boxY + 30, function($font) {
                $font->file(public_path('fonts/Poppins-Bold.ttf'));
                $font->size(24);
                $font->color('#000000');
            });

            // Add main text with word wrap
            $img->text($loveNote->message, $boxX + 20, $boxY + 60, function (FontFactory $font) use ($fontPath, $fontSize, $textWidth) {
                $font->filename($fontPath);
                $font->size($fontSize);
                $font->color('333');
                $font->align('left');
                $font->valign('top');
                $font->lineHeight(2);
                $font->wrap($textWidth);
            });

            // Add heart icon
            $heart = $manager->read(public_path('assets/img/heart.png'));
            $heart->resize(60, 60);
            $img->place($heart, 'top-right', $boxX-30, $boxY-30);

            return response($img->toPng(), 200)
            ->header('Content-Type', 'image/png')
            ->header('Content-Disposition', 'attachment; filename="love-note-' . $id . '.png"');
        } catch (\Exception $e) {
            \Log::error('Love note image generation failed: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to generate image');
        }
    }

}
