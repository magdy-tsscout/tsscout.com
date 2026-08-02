<?php

$file = __DIR__ . '/../resources/views/landing-pages/reengage2.blade.php';
$content = file_get_contents($file);

if ($content === false) {
    fwrite(STDERR, "Failed to read file\n");
    exit(1);
}

$assetDir = __DIR__ . '/../public/assets/reengage2';
if (!is_dir($assetDir) && !mkdir($assetDir, 0775, true)) {
    fwrite(STDERR, "Failed to create asset dir\n");
    exit(1);
}

$mimeToExt = [
    'font/otf' => 'otf',
    'image/png' => 'png',
    'image/jpeg' => 'jpg',
    'image/jpg' => 'jpg',
    'image/webp' => 'webp',
    'image/gif' => 'gif',
    'image/svg+xml' => 'svg',
];

$counterByMime = [];
$replacements = 0;
$pattern = '/data:([a-zA-Z0-9_+\-\.\/]+);base64,([A-Za-z0-9+\/=\r\n]+)/';

$newContent = preg_replace_callback(
    $pattern,
    function ($m) use (&$counterByMime, $mimeToExt, $assetDir, &$replacements) {
        $mime = strtolower($m[1]);
        $raw = preg_replace('/\s+/', '', $m[2]);
        $bin = base64_decode($raw, true);

        if ($bin === false) {
            return $m[0];
        }

        $counterByMime[$mime] = ($counterByMime[$mime] ?? 0) + 1;
        $idx = $counterByMime[$mime];
        $ext = $mimeToExt[$mime] ?? 'bin';
        $kind = str_starts_with($mime, 'font/') ? 'font' : 'image';
        $filename = "reengage2-{$kind}-{$idx}.{$ext}";
        $path = $assetDir . '/' . $filename;

        file_put_contents($path, $bin);
        $replacements++;

        return '/assets/reengage2/' . $filename;
    },
    $content,
    -1,
    $count,
);

if ($newContent === null) {
    fwrite(STDERR, "Regex replacement failed\n");
    exit(1);
}

if (file_put_contents($file, $newContent) === false) {
    fwrite(STDERR, "Failed to write updated Blade file\n");
    exit(1);
}

echo "Extracted/replaced: {$replacements}\n";
foreach ($counterByMime as $mime => $n) {
    echo "{$mime}: {$n}\n";
}
