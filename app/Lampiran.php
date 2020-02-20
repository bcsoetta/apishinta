<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Lampiran extends Model
{
    // setup tables and default relations
    protected $table = 'lampiran';

    protected $guarded = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    // METHODS
    public function existsOnDisk() {
        return Storage::disk('public')->exists($this->diskfilename);
    }

    public function instantiateOnDisk() {
        // force to instantiate on disk
        $filename   = $this->diskfilename;

        // if file exists on disk, just say it's ok
        if ($this->existsOnDisk()) {
            return true;
        }

        // write it nao...
        return Storage::disk('public')->put($filename, base64_decode($this->blob));
    }

    // Polymorphic relations
    public function Attachable() {
        return $this->morphTo();
    }

    // COMPUTED PROPS
    public function getUrlAttribute() {
        return asset(Storage::url($this->diskfilename));
    }

    public function getBlobSizeAttribute() {
        return strlen($this->blob);
    }

    public function getOwnerTypeAttribute() {
        return strtolower(class_basename(get_class($this->attachable)));
    }
}