<?php

namespace Traits;

trait ResponseFormatter {
    public function formatResponse($data) {
        return json_encode(['status' => 'success', 'data' => $data]);
    }
}

?>
