<?php

namespace App\Helpers;

class BadWordsFilter
{
    protected static $badWords = [
        // Kata-kata kasar dalam bahasa Indonesia
        'anjing', 'asu', 'bangsat', 'babi', 'kontol', 'memek', 'pepek', 
        'jancok', 'jembut', 'kimak', 'ngentot', 'ngentod', 'pantek', 'pukimak',
        'bajingan', 'bangke', 'tai', 'taik', 'tolol', 'goblok', 'goblog',
        'bodoh', 'idiot', 'kampret', 'brengsek', 'monyet', 'kunyuk',
        'pecun', 'perek', 'pelacur', 'sundal', 'lonte', 'jablay',
        
        // Variasi kata kasar
        'anjir', 'anying', 'asyu', 'bacot', 'bego', 'bengek', 'brengsek',
        'cukimai', 'edan', 'gblk', 'jancuk', 'jembud', 'kimat', 'kontl',
        'mmk', 'ngtd', 'ngtot', 'pntek', 'plcr', 'pret', 'silit', 'tai','asu','turuk','peli','peler','ah ah',
        
        // Kata kasar bahasa Inggris (opsional)
        'fuck', 'shit', 'bitch', 'asshole', 'bastard', 'damn',
        'dick', 'pussy', 'cock', 'cunt', 'whore', 'slut','hell','nawh',
    ];

    /**
     * Check if text contains bad words
     */
    public static function containsBadWords(string $text): bool
    {
        $text = strtolower($text);
        
        foreach (self::$badWords as $badWord) {
            // Cek kata utuh dengan word boundary
            if (preg_match('/\b' . preg_quote($badWord, '/') . '\b/i', $text)) {
                return true;
            }
            
            // Cek variasi dengan angka/simbol (contoh: k0nt0l, k@nt@l)
            $pattern = self::createPattern($badWord);
            if (preg_match('/' . $pattern . '/i', $text)) {
                return true;
            }
        }
        
        return false;
    }

    /**
     * Filter bad words with asterisks
     */
    public static function filter(string $text): string
    {
        $text = strtolower($text);
        
        foreach (self::$badWords as $badWord) {
            $replacement = str_repeat('*', strlen($badWord));
            
            // Replace kata utuh
            $text = preg_replace('/\b' . preg_quote($badWord, '/') . '\b/i', $replacement, $text);
            
            // Replace variasi dengan simbol
            $pattern = self::createPattern($badWord);
            $text = preg_replace('/' . $pattern . '/i', $replacement, $text);
        }
        
        return $text;
    }

    /**
     * Create pattern for variations (with numbers/symbols)
     */
    protected static function createPattern(string $word): string
    {
        $pattern = '';
        $substitutions = [
            'a' => '[a@4]',
            'e' => '[e3]',
            'i' => '[i1!]',
            'o' => '[o0]',
            'u' => '[u]',
            's' => '[s$5]',
            't' => '[t7]',
        ];
        
        foreach (str_split($word) as $char) {
            $pattern .= $substitutions[$char] ?? $char;
        }
        
        return '\b' . $pattern . '\b';
    }

    /**
     * Get list of bad words (untuk testing)
     */
    public static function getBadWords(): array
    {
        return self::$badWords;
    }
}