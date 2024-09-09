<?php

namespace PhpOptimizer;
//by ArgoDev

class AdvancedOptimizer
{
    protected $code;
    public function __construct($code)
    {
        $this->code = $code;
    }

    protected function optimizeConditionals()
    {
        $this->code = preg_replace('/if\s*\((true|1)\)\s*\{(.*?)\}/is', '$2', $this->code);
        $this->code = preg_replace('/if\s*\((false|0)\)\s*\{.*?\}/is', '', $this->code);
    }
    
    protected function optimizeVariables()
    {
        $matches = [];
        preg_match_all('/\$[a-zA-Z_]\w*/', $this->code, $matches);
        $unusedVars = array_filter(array_count_values($matches[0]), function($count) {
            return $count === 1;
        });
        
        foreach ($unusedVars as $var => $count) {
            $this->code = preg_replace('/' . preg_quote($var) . '\s*=.*?;/', '', $this->code);
        }
    }

    protected function optimizeLoops()
    {
        $this->code = preg_replace('/for\s*\(.*?;.*?;.*?\)\s*{}/', '', $this->code);
    }

    public function optimize()
    {
        $this->optimizeConditionals();
        $this->optimizeVariables();
        $this->optimizeLoops();
        return $this->code;
    }
}