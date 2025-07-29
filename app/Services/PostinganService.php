<?php

namespace App\Services;

use App\Models\postingan;
use App\Models\Setting;
use Carbon\Carbon;
use Http;

class PostinganService
{
    public function getallPostingan()
    {
        $postingans = postingan::orderBy('timestamps','asc')->get();
        return $postingans;
    }
    public function getwhereidpostingan($id){
        $postingans = postingan::where('id_postingan',$id);
        return $postingans;
    }
    public function storepostingan($data){
        if (!$data) {
            return false;
        }
        $datas = postingan::create([
            'id_postingan' => $data['id'],
            'media_type' => $data['media_type'],
            'media_url' => $data['media_url'],
            'permalink' => $data['permalink'],
            'timestamps' => $this->formattime($data['timestamp']),
            'thumbnail_url' => isset($data['thumbnail_url']) ? $data['thumbnail_url'] : null,
        ]);

        return true;
    }
    public function updatepostingan($data, $id){
        $datas = postingan::find($id);
        if (!$datas) {
            return false;
        }

        $datas->update([
            'media_type' => $data['media_type'],
            'media_url' => $data['media_url'],
            'timestamps' => $this->formattime($data['timestamp']),
            'permalink' => $data['permalink'],
            'thumbnail_url' => isset($data['thumbnail_url']) ? $data['thumbnail_url'] : null,
        ]);

        return true;
    }
    public function deletepostingan($id){
        $datas = postingan::find($id);
        if (!$datas) {
            return false;
        }
        $datas->delete();
        return true;
    }
    public function synchronizePosts()
    {
        $response = Http::get('https://graph.instagram.com/me/media', [
            'fields' => 'id,media_type,media_url,permalink,thumbnail_url,timestamp',
            'access_token' => env('INSTAGRAM_API_AOM'),
        ]);

        $setting = Setting::findOrFail(1);

        if ($response->successful()) {
            $data = $response->json();
            // Filter posts based on opening date
            $filteredPosts = array_filter($data['data'], function ($post) use ($setting) {
                return $this->formatTime($post['timestamp']) >= $setting->opening_date;
            });

            $existingPostIds = $this->getExistingPostIds(); // Function to get existing post IDs from database

            foreach ($filteredPosts as $post) {
                $postId = $post['id'];

                if (!in_array($postId, $existingPostIds)) {
                    // Post doesn't exist in database, add it
                    $this->storePostingan($post);
                } else {
                    // Post exists in database, update it
                    $this->updatePostingan($post, $postId);
                }
            }

            // Check for posts in database that are not in the API response (for deletion)
            $postsToDelete = array_diff($existingPostIds, array_column($filteredPosts, 'id'));
            foreach ($postsToDelete as $postId) {
                $this->deletePostingan($postId); // Function to delete post from database
            }

            return true;
        }

        return false;
    }

    public function getExistingPostIds()
    {
        return Postingan::pluck('id_postingan')->toArray();
    }
    public function formattime($time){
        return Carbon::parse($time);
    }

}
