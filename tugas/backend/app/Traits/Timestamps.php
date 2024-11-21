<?php
namespace app\Traits;

trait Timestamps {
    public $created_at;
    public $updated_at;

    public function setTimestamps() {
        $this->created_at = date('Y-m-d H:i:s');
        $this->updated_at = date('Y-m-d H:i:s');
    }

    public function updateTimestamp() {
        $this->updated_at = date('Y-m-d H:i:s');
    }
}
?>
