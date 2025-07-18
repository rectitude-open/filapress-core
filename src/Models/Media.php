<?php

declare(strict_types=1);

namespace RectitudeOpen\FilaPressCore\Models;

use Awcodes\Curator\Models\Media as CuratorMedia;
use Illuminate\Support\Str;
use League\Glide\Urls\UrlBuilderFactory;

class Media extends CuratorMedia
{
    public function getSignedUrl(array $params = [], bool $force = false): string
    {
        if (! $force) {
            if (
                ! $this->resizable ||
                in_array($this->disk, config('curator.cloud_disks')) ||
                ! \Storage::disk($this->disk)->exists($this->path)
            ) {
                return $this->url;
            }
        }

        // Step 1: Generate the correctly signed URL based on the original path.
        $originalBasePath = Str::of(config('curator.glide.route_path', 'curator'))
            ->trim('/')
            ->start('/')
            ->finish('/')
            ->toString();
        $urlBuilder = UrlBuilderFactory::create($originalBasePath, config('app.key'));
        $signedUrl = $urlBuilder->getUrl($this->path, $params);

        // Step 2: Build the final path.
        $appPathPrefix = trim(parse_url(config('app.url', ''), PHP_URL_PATH) ?? '', '/');
        $finalPath = collect([$appPathPrefix, ltrim($signedUrl, '/')])
            ->filter() // This removes any empty parts, like an empty $appPathPrefix.
            ->implode('/'); // This joins the parts with a single slash.

        return Str::start($finalPath, '/');
    }
}
