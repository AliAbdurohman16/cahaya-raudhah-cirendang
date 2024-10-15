<?php

namespace App\Helpers;

class Huffman
{
    protected $frequency;
    protected $codes = [];
    protected $reverseCodes = [];

    public function buildHuffmanTree($data)
    {
        $this->frequency = array_count_values(str_split($data));

        $heap = new \SplPriorityQueue();
        foreach ($this->frequency as $char => $freq) {
            $heap->insert([$char], -$freq);
        }

        while ($heap->count() > 1) {
            $left = $heap->extract();
            $right = $heap->extract();
            $combinedFreq = array_sum(array_map(function($item) {
                return $this->frequency[$item];
            }, array_merge($left, $right)));

            $heap->insert(array_merge($left, $right), -$combinedFreq);

            foreach ($left as $char) {
                $this->codes[$char] = (isset($this->codes[$char]) ? '0' . $this->codes[$char] : '0');
            }

            foreach ($right as $char) {
                $this->codes[$char] = (isset($this->codes[$char]) ? '1' . $this->codes[$char] : '1');
            }
        }

        $this->reverseCodes = array_flip($this->codes);
    }

    public function encode($data)
    {
        $encoded = '';
        foreach (str_split($data) as $char) {
            $encoded .= $this->codes[$char];
        }
        return $encoded;
    }

    public function decode($encoded)
    {
        $decoded = '';
        $currentCode = '';

        foreach (str_split($encoded) as $bit) {
            $currentCode .= $bit;
            if (isset($this->reverseCodes[$currentCode])) {
                $decoded .= $this->reverseCodes[$currentCode];
                $currentCode = '';
            }
        }

        return $decoded;
    }

    public function getCodes()
    {
        return $this->codes;
    }
}
