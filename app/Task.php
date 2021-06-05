<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Task extends Model
{
    protected $fillable = ['title', 'preview', 'text', 'file', 'status'];

    public function removeFile()
    {
        if(isset($this->file))
        {
            Storage::delete('uploads/' . $this->file);
        }
    }

    public function uploadFile($file)
    {
        if(!isset($file)) { return; }

        $this->removeFile();
        $fileName = Str::random(10) . '.' . $file->getClientOriginalName();
        $file->storeAs('uploads', $fileName);
        $this->file = $fileName;
    }
}


