<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\Image;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Models\TemporyImage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    public function post(Request $request) {
        $validator = Validator::make($request->all(), [
            'content' => 'required|string|max:255',
        ]);

        $temporaryImages = TemporyImage::all();

        if ($validator->fails()) {
            foreach ($temporaryImages as $temporaryImage) {
                Storage::deleteDirectory('images/tmp/' . $temporaryImage->folder);
                $temporaryImage->delete();
            }
            return redirect('/')->withErrors($validator)->withInput();
        }

        $post = new Post($validator->validated());
        $post->user_id = Auth::user()->id;
        $post->save();

        foreach ($temporaryImages as $temporaryImage) {
            $sourcePath = 'images/tmp/' . $temporaryImage->folder . '/' . $temporaryImage->file;
            $destinationPath = 'images/' . $temporaryImage->folder . '/' . $temporaryImage->file;

            Storage::copy($sourcePath, $destinationPath);

            File::create([
                'post_id' => $post->id,
                'file_name' => $temporaryImage->file,
                'file_path' => $temporaryImage->folder . '/' . $temporaryImage->file,
            ]);

            Storage::deleteDirectory('images/tmp/' . $temporaryImage->folder);
            $temporaryImage->delete();
        }

        return redirect()->route('resort.profile')->with('success', 'Post created successfully.');
    }

    public function destroy(Request $request, Post $post)
    {
        // Ensure the authenticated user is authorized to delete the post
        if ($post->user_id !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        // Delete associated files from storage
        foreach ($post->files as $file) {
            Storage::delete('images/' . $file->file_path);
            Storage::deleteDirectory('images/' . dirname($file->file_path));
            $file->delete();
        }

        // Delete the post
        $post->delete();

        return response()->json(['success' => 'Post deleted successfully']);
    }

}
