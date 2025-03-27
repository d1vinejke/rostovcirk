<?php
if (!function_exists('content')) {
    function content($key, $default = null)
    {
        $block = App\Models\ContentBlock::where('key', $key)->first();

        if($block && $block->type === 'image') {
            return $block->value ? asset('storage/'.$block->value) : $default;
        }

        return $block->value ?? $default;
    }
}
